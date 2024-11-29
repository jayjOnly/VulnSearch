<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerability Details</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <a href="javascript:history.back()" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Results
        </a>

        <div class="vuln-details-card">
            <div class="card-header">
                <div class="header-left">
                    <h1 class="cve-id">{{ $vulnerability->cve_id }}</h1>
                    @php
                    switch($vulnerability->severity) {
                        case 'LOW':
                            $css = 'low';
                            $severityClass = 'LOW';
                            break;
                        case 'MEDIUM':
                            $css = 'medium';
                            $severityClass = 'MEDIUM';
                            break;
                        case 'HIGH':
                            $css = 'high';
                            $severityClass = 'HIGH';
                            break;
                        default:
                            $css = 'na';
                            $severityClass = 'N/A';
                            break;
                    }        
                    @endphp
                    <span class="severity-badge {{ $css }}">{{ $severityClass }}</span>
                </div>
                @auth
                    <button id="bookmarkBtn" class="bookmark-btn" data-vulnerability-id="{{ $vulnerability->id }}">
                        <i class="{{ $isBookmarked ? 'fas' : 'far' }} fa-bookmark"></i>
                    </button>
                @endauth
            </div>

            <div class="details-section">
                <h2 class="section-title">Description</h2>
                <div class="section-content">
                    {{ $vulnerability->description }}
                </div>
            </div>

            <div class="details-section">
                <h2 class="section-title">CVSS Score</h2>
                <div class="section-content">
                    <span class="cvss-score">{{ $vulnerability->cvss_score }}</span>
                </div>
            </div>

            <div class="details-section">
                <h2 class="section-title">Source</h2>
                <div class="section-content">
                    <a href="https://nvd.nist.gov/vuln/detail/{{ $vulnerability->cve_id }}" class="source-link" target="_blank">https://nvd.nist.gov/vuln/detail/{{ $vulnerability->cve_id }}</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookmarkBtn = document.getElementById('bookmarkBtn');
            
            if (bookmarkBtn) {
                bookmarkBtn.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    const vulnerabilityId = this.dataset.vulnerabilityId;
    
                    // Menggunakan metode fetch dengan konfigurasi yang lebih lengkap
                    fetch(`/bookmark/${vulnerabilityId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'  // Penting untuk mengirim cookie
                    })
                    .then(response => {
                        // Cek apakah respons OK
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Debug: Log respon dari server
                        console.log('Bookmark response:', data);
    
                        if (data.status === 'added') {
                            icon.classList.remove('far');
                            icon.classList.add('fas');
                        } else if (data.status === 'removed') {
                            icon.classList.remove('fas');
                            icon.classList.add('far');
                        }
                    })
                    .catch(error => {
                        // Tangani error
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memproses bookmark');
                    });
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

    .container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .vuln-details-card {
        background: rgba(30, 30, 30, 0.9);
        border-radius: 0.5rem;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(5px);
    }

 .card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .header-left {
        flex-grow: 1;
    }

    .cve-id {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #4dabf7;
    }

    .bookmark-btn {
        background: none;
        border: none;
        color: #888;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0.5rem;
        transition: color 0.2s;
    }

    .bookmark-btn:hover {
        color: #4dabf7;
    }

    .bookmark-btn.active {
        color: #4dabf7;
    }

    .severity-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 0.5rem;
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

    .details-section {
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1rem;
        color: #888;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .section-content {
        color: #fff;
        line-height: 1.6;
        background: rgba(40, 40, 40, 0.5);
        padding: 1rem;
        border-radius: 0.375rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .cvss-score {
        font-size: 1.1rem;
        color: #00C851;
        font-weight: bold;
    }

    .source-link {
        color: #4dabf7;
        text-decoration: none;
        transition: color 0.2s;
    }

    .source-link:hover {
        color: #74c0fc;
        text-decoration: underline;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        color: #888;
        text-decoration: none;
        margin-bottom: 1rem;
        transition: color 0.2s;
    }

    .back-btn:hover {
        color: #4dabf7;
    }

    .back-btn i {
        margin-right: 0.5rem;
    }

    @media (max-width: 640px) {
        .container {
            padding: 1rem;
        }

        .vuln-details-card {
            padding: 1.5rem;
        }

        .card-header {
            flex-direction: column;
        }

        .bookmark-btn {
            position: absolute;
            right: 2rem;
            top: 2rem;
        }
    }
</style>