<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerability Search Results</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Search Box -->
        <div class="search-container">
            <form action="{{ route('search.results') }}" method="POST">
                @csrf
                <div class="search-content">
                    <textarea
                        class="search-box"
                        placeholder="Search for any vulnerability"
                        rows="1"
                        name="query"
                        oninput="this.style.height = '';this.style.height = this.scrollHeight + 'px'"
                    ></textarea>
                    <button class="search-button">
                        <div class="search-icon"></div>
                    </button>
                </div>
            </form>
        </div>

        <h1>Search Results for "{{ $query }}":</h1>

        <div class="results-container">

            @if($results->isEmpty())
                <p>No vulnerabilities found.</p>
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
                                <span class="cvss-score">CVSS Score: {{ $vulnerability->cvss_score }}</span>
                                <a href={{ route('vulnerabilities.show', ['id' => $vulnerability->id ]) }} class="details-link">View Details</a>
                            </div>
                        </div>
                    @endforeach

                    {{-- {{ $results->appends(['query' => $query])->links('vendor.pagination.tailwind') }} --}}
                    
                </ul>
            @endif

            {{$results->appends(['query' => $query])->links('pagination::tailwind')}}

        </div>
    </div>
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
    }

    /* Container styles */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
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
        transform: translateY(-2px);
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
    
    /* Responsive adjustments */
    @media (max-width: 640px) {
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }
</style>
