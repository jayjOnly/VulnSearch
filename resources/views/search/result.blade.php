<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerability Search Results</title>
    <style>
        /* Reset and base styles */
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
</head>
<body>
    <div class="container">
        <!-- Results Section -->
        <div class="results-container">
            <!-- High Severity -->
            <div class="vulnerability-card high">
                <div class="card-header">
                    <h3 class="cve-id">CVE-2023-XXXX</h3>
                    <span class="severity-badge high">High</span>
                </div>
                <p class="description">Lorem Ipsum Alatu Ipsum Karema</p>
                <div class="card-footer">
                    <span class="cvss-score">CVSS Score: 9.8</span>
                    <a href="#" class="details-link">View Details</a>
                </div>
            </div>

            <!-- Medium Severity -->
            <div class="vulnerability-card medium">
                <div class="card-header">
                    <h3 class="cve-id">CVE-2023-YYYY</h3>
                    <span class="severity-badge medium">Medium</span>
                </div>
                <p class="description">Lorem Ipsum Alatu Ipsum Karema</p>
                <div class="card-footer">
                    <span class="cvss-score">CVSS Score: 6.5</span>
                    <a href="#" class="details-link">View Details</a>
                </div>
            </div>

            <!-- Low Severity -->
            <div class="vulnerability-card low">
                <div class="card-header">
                    <h3 class="cve-id">CVE-2023-ZZZZ</h3>
                    <span class="severity-badge low">Low</span>
                </div>
                <p class="description">Lorem Ipsum Alatu Ipsum Karema</p>
                <div class="card-footer">
                    <span class="cvss-score">CVSS Score: 3.2</span>
                    <a href="#" class="details-link">View Details</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
