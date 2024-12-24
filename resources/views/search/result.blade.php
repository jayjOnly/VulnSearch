<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>Vulnerability Search Results</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <x-nav-bar />
    <div class="container">
        <!-- Search Box -->
        <div class="search-container">
            <form action="{{ route('search.results') }}" method="POST" autocomplete="off">
                @csrf
                <div class="search-content">
                    <input
                        class="search-box"
                        placeholder="Search for any vulnerability"
                        type="text"
                        value="{{ $query }}"
                        name="query"
                    >
                    <input type="hidden" name="severity" id="severityFilter" value="{{ $severity }}">
                    <button class="search-button">
                        <div class="search-icon"></div>
                    </button>
                </div>
            </form>
        </div>

        {{-- <h1>Search Results for "{{ $query }}":</h1> --}}

        <!-- Results Summary -->
        <div class="results-summary">
            <h1>Search Results for "{{ $query }}"</h1>
            <p>Found {{ $results->total() }} vulnerabilities</p>
        </div>

        <!-- Filter Buttons -->
        <div class="filter-container">
            <span class="filter-label">Filter by severity:</span>
            <form action="{{ route('search.results') }}" method="POST" id="filterForm">
                @csrf
                <input type="hidden" name="query" value="{{ $query }}">
                <input type="hidden" name="severity" id="severityFilter" value="{{ "HIGH" }}">
                <div class="filter-buttons">
                    <button type="button" class="filter-btn high {{ $severity === 'HIGH' ? 'active' : '' }}" 
                            data-severity="HIGH">High ({{ $counts['HIGH'] }})</button>
                    <button type="button" class="filter-btn medium {{ $severity === 'MEDIUM' ? 'active' : '' }}" 
                            data-severity="MEDIUM">Medium ({{ $counts['MEDIUM'] }})</button>
                    <button type="button" class="filter-btn low {{ $severity === 'LOW' ? 'active' : '' }}" 
                            data-severity="LOW">Low ({{ $counts['LOW'] }})</button>
                    <button type="button" class="filter-btn na {{ $severity === 'N/A' ? 'active' : '' }}" 
                            data-severity="N/A">N/A ({{ $counts['N/A'] }})</button>
                </div>
            </form>
        </div>

        <div class="results-container">
            @if($results->isEmpty())
                <p class="not-found">No vulnerabilities found.</p>
            @else
                <ul>
                    @foreach($results as $vulnerability)
                        @php
                            $severityClass = '';
                            switch ($vulnerability->severity) {
                                case 'LOW':
                                    $severityClass = 'low';
                                    $css = 'low';
                                    break;
                                case 'MEDIUM':
                                    $severityClass = 'medium';
                                    $css = 'medium';
                                    break;
                                case 'HIGH':
                                    $severityClass = 'high';
                                    $css = 'high';
                                    break;
                                default:
                                    $severityClass = 'n/a';
                                    $css = 'na';
                                    break;
                            }
                        @endphp
                        <div class="vulnerability-card {{ $css }}">
                            <div class="card-header">
                                <h3 class="cve-id">{{ $vulnerability->cve_id }}</h3>
                                <span class="severity-badge {{ $css }}">{{ $severityClass }}</span>
                            </div>
                            <p class="description">{{ Str::limit($vulnerability->description, 150) }}</p>
                            <div class="card-footer">
                                @if($vulnerability->cvss_score == 0)
                                    <span class="cvss-score">CVSS Score: {{ "N/A" }}</span>
                                @else
                                    <span class="cvss-score">CVSS Score: {{ $vulnerability->cvss_score }}</span>
                                @endif
                                <a href={{ route('vulnerabilities.show', ['id' => $vulnerability->id ]) }} class="details-link">View Details</a>
                            </div>
                        </div>
                    @endforeach
                </ul>
                {{ $results->appends(['query' => $query, 'severity' => $severity])->links() }}
            @endif
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('.filter-btn').click(function() {
                const $this = $(this);
                const severity = $this.data('severity');
                const query = $('input[name="query"]').val();
                let activeSeverity = null;
                
                // Toggle active state
                if ($this.hasClass('active')) {
                    $this.removeClass('active');
                    $('#severityFilter').val('');
                } else {
                    $('.filter-btn').removeClass('active');
                    $this.addClass('active');
                    activeSeverity = severity;
                    $('#severityFilter').val(severity);
                }
                
                // Perform AJAX request
                $.ajax({
                    url: '/search/results',
                    method: 'POST',
                    data: {
                        query: query,
                        severity: activeSeverity
                    },
                    success: function(response) {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(response, 'text/html');
                        $('.results-container').html($(doc).find('.results-container').html());
                        
                        const newUrl = new URL(window.location);
                        if (activeSeverity) {
                            newUrl.searchParams.set('severity', activeSeverity);
                        } else {
                            newUrl.searchParams.delete('severity');
                        }
                        window.history.pushState({}, '', newUrl);
                        
                        updatePaginationLinks(activeSeverity);
                    },
                    error: function(xhr) {
                        console.error('Error filtering results:', xhr.responseText);
                    }
                });
            });
            
            function updatePaginationLinks(severity) {
                $('.pagination a').each(function() {
                    let url = new URL($(this).attr('href'), window.location.origin);
                    if (severity) {
                        url.searchParams.set('severity', severity);
                    } else {
                        url.searchParams.delete('severity');
                    }
                    $(this).attr('href', url.toString());
                });
            }
        });
    </script>
        
</body>
</html>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    h1{
        margin-bottom: 1rem;
        font-size: 2rem;
        font-weight:bold;
    }
    .not-found{
        font-size:1.17rem;
    }
    body {
        font-family: monospace;
        background-color: #1a1a1a;
        color: #fff;
        min-height: 100vh;
        background-image:
            linear-gradient(rgba(40, 40, 40, 0.2) 1px, transparent 1px),
            linear-gradient(90deg, rgba(40, 40, 40, 0.2) 1px, transparent 1px);
        background-size: 40px 40px;
        padding-bottom: 2.5rem;
    }

    /* Container styles */
    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Results styles */
    .results-container {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .vulnerability-card {
        background: rgba(30, 30, 30, 0.9);
        border-radius: 0.5rem;
        padding: 1.25rem;
        margin-bottom: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(5px);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .vulnerability-card:hover {
        transform: translateY(-4px);
        transform: scale(1.02);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.4);
    }

    /* Severity-specific styles */
    .vulnerability-card.high {
        border-left: 4px solid #ff4444;
    }

    .vulnerability-card.medium {
        border-left: 4px solid #ffbb33;
    }

    .vulnerability-card.low {
        border-left: 4px solid #00C851;
    }

    .vulnerability-card.na {
        border-left: 4px solid #fefefe;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    .cve-id {
        font-size: 1.125rem;
        font-weight: 600;
        color: #fff;
    }

    .severity-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .severity-badge.high {
        background-color: rgba(255, 68, 68, 0.2);
        color: #ff4444;
        border: 1px solid rgba(255, 68, 68, 0.3);
    }

    .severity-badge.medium {
        background-color: rgba(255, 187, 51, 0.2);
        color: #ffbb33;
        border: 1px solid rgba(255, 187, 51, 0.3);
    }

    .severity-badge.low {
        background-color: rgba(0, 200, 81, 0.2);
        color: #00C851;
        border: 1px solid rgba(0, 200, 81, 0.3);
    }

    .severity-badge.na {
        background-color: rgba(133, 133, 133, 0.2);
        color: #fefefe;
        border: 1px solid rgba(251, 252, 251, 0.3);
    }

    .description {
        color: #b3b3b3;
        margin-bottom: 1rem;
        font-size: 0.9375rem;
    }

    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.875rem;
    }

    .cvss-score {
        color: #888;
    }

    .details-link {
        color: #4dabf7;
        text-decoration: none;
        transition: color 0.2s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .details-link:hover {
        color: #74c0fc;
    }

    .details-link::after {
        content: '→';
        transition: transform 0.2s;
    }

    .details-link:hover::after {
        transform: translateX(4px);
    }

    /* Search Box */
    .search-container {
        background: rgba(26, 26, 26, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 1rem;
        margin-top: 8rem;
    }
    .search-content {
        display: flex;
        align-items: flex-start;
    }

    .search-box {
        flex: 1;
        background: transparent;
        border: none;
        color: #ffffff;
        font-size: 1.2rem;
        outline: none;
        padding-right: 1rem;
        min-height: 24px;
        max-height: 150px;
        resize: none; /* Prevents manual resizing */
        overflow-y: auto; /* Adds scrollbar when needed */
        word-wrap: break-word; /* Ensures words wrap */
        white-space: pre-wrap; /* Preserves whitespace and wrapping */
        line-height: 1.5;
    }

    .search-box::placeholder {
        color: #808080;
    }

    .search-button {
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 5px;
        margin-top: 2px; /* Aligns with first line of text */
    }

    .search-icon {
        width: 24px;
        height: 24px;
        border: 2px solid #ffffff;
        border-radius: 50%;
        position: relative;
        flex-shrink: 0;
    }

    .search-icon::after {
        content: '';
        position: absolute;
        width: 10px;
        height: 2px;
        background: #ffffff;
        transform: rotate(45deg);
        bottom: -5px;
        right: -5px;
    }

    .results-summary {
        margin: 2rem 0 1rem;
    }

    .results-summary h1 {
        font-size: 1.8rem;
        margin-bottom: 0.5rem;
    }

    .results-summary p {
        color: #b3b3b3;
    }

    .no-results {
        text-align: center;
        padding: 3rem;
        background: rgba(30, 30, 30, 0.9);
        border-radius: 8px;
        margin: 2rem 0;
    }

    .no-results p {
        font-size: 1.1rem;
        color: #b3b3b3;
        margin-bottom: 1rem;
    }

    .back-link {
        color: #4dabf7;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: #74c0fc;
    }

    .pagination-container {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    /* Filter Button Container */
    .filter-container {
        margin: 2rem 0;
        text-align: center;
    }

    .filter-label {
        font-size: 1rem;
        color: #b3b3b3;
        margin-right: 0.5rem;
    }

    /* Filter Buttons */
    .filter-buttons {
        display: inline-flex;
        gap: 1rem;
    }

    .filter-btn {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
        color: #fff;
        cursor: pointer;
        transition: all 0.2s ease;
        text-transform: uppercase;
    }

    .filter-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }

    .filter-btn.active {
        border: 2px solid #fff;
        background: rgba(255, 255, 255, 0.1);
    }

    /* Severity-specific Styles */
    .filter-btn.high {
        background-color: rgba(255, 68, 68, 0.2);
    }

    .filter-btn.high:hover,
    .filter-btn.high.active {
        background-color: #ff4444;
        color: #fff;
    }

    .filter-btn.medium {
        background-color: rgba(255, 187, 51, 0.2);
    }

    .filter-btn.medium:hover,
    .filter-btn.medium.active {
        background-color: #ffbb33;
        color: #fff;
    }

    .filter-btn.low {
        background-color: rgba(0, 200, 81, 0.2);
    }

    .filter-btn.low:hover,
    .filter-btn.low.active {
        background-color: #00C851;
        color: #fff;
    }

    .filter-btn.na {
        background-color: rgba(133, 133, 133, 0.2);
    }

    .filter-btn.na:hover,
    .filter-btn.na.active {
        background-color: #858585;
        color: #fff;
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }
</style>
