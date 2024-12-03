<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>Vulnerability Search Results</title>
</head>
<body>
    <x-nav-bar />
    <div class="container">
        <h1>Bookmarks: </h1>
        <div class="results-container">
            @if($bookmarks->isEmpty())
                <p>No Bookmark found.</p>
            @else
                <ul>
                    @foreach($bookmarks as $bookmark)
                        @php
                            $severityClass = '';
                            switch ($bookmark->vulnerability->severity) {
                                case 'LOW':
                                    $severityClass = 'low';
                                    break;
                                case 'MEDIUM':
                                    $severityClass = 'medium';
                                    break;
                                case 'HIGH':
                                    $severityClass = 'high';
                                    break;
                                case '0':
                                    $severityClass = 'na';
                                    break;
                            }
                        @endphp
                        <div class="vulnerability-card {{ $severityClass }}">
                            <div class="card-header">
                                <h3 class="cve-id">{{ $bookmark->vulnerability->cve_id }}</h3>
                                <span class="severity-badge {{ $severityClass }}">{{ $bookmark->vulnerability->severity==0? 'N/A': $bookmark->vulnerability->severity }}</span>
                            </div>
                            <p class="description">{{ Str::limit($bookmark->vulnerability->description, 150) }}</p>
                            <div class="card-footer">
                                <span class="cvss-score">CVSS Score: {{ $bookmark->vulnerability->cvss_score }}</span>
                                <a href={{ route('vulnerabilities.show', $bookmark->vulnerability->id) }} class="details-link">View Details</a>
                            </div>
                        </div>
                    @endforeach
                </ul>
                {{ $bookmarks->links() }}

            @endif    
        </div>
    </div>

    <script>
        window.onload = function() {
            // Cek jika dataUpdated ada di sessionStorage
            if (sessionStorage.getItem('dataUpdated') === 'true') {
                // Perbarui data di halaman ini (misalnya, melakukan fetch atau memuat ulang data)
                location.reload(); // Refresh halaman untuk mendapatkan data terbaru
                sessionStorage.removeItem('dataUpdated'); // Hapus status setelah halaman ter-update
            }
        };
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
        font-size: 2.5rem;
        font-weight: bold;
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
        margin-top: 4rem;
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
    
    /* Responsive adjustments */
    @media (max-width: 640px) {
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }
</style>