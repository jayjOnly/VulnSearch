<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerability Details</title>
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
                    <span class="severity-badge high">{{ $vulnerability->severity }}</span>
                </div>
                <button class="bookmark-btn" title="Bookmark this vulnerability">
                    <i class="far fa-bookmark"></i>
                </button>
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
                    <span class="cvss-score">{{ $vulnerability->cvss_score }}</span> (Critical)
                </div>
            </div>

            <div class="details-section">
                <h2 class="section-title">Source</h2>
                <div class="section-content">
                    <a href="#" class="source-link" target="_blank">https://nvd.nist.gov/vuln/detail/CVE-2023-XXXX</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple bookmark toggle functionality
        document.querySelector('.bookmark-btn').addEventListener('click', function() {
            const icon = this.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                this.classList.add('active');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                this.classList.remove('active');
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

    .cve-name {
        font-size: 1.1rem;
        color: #b3b3b3;
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

    /* Back button */
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
