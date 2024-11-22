<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>Vuln Search</title>
</head>
<body>
    <header>
        <h1>VulnSearch</h1>
        <div class="header-buttons">
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    </header>

    <div class="container">
        <div class="content">
            <div class="text-content">
                <h2>Welcome to VulnSearch!</h2>
                <p>VulnSearch is an advanced vulnerability search platform designed to help cybersecurity professionals, researchers, and software developers discover the latest security vulnerabilities in the software and systems they use. With a simple and intuitive interface, VulnSearch provides up-to-date information on vulnerabilities, CVSS scores, severity levels, and reliable sources, all in one place.</p>
                <a href="#" class="try-now-button">Try Now!</a>
            </div>
            <div class="image-placeholder">
                <img src="{{ asset('images/gambar.png') }}" alt="image" class="resize-image">
            </div>
        </div>
    </div>
</body>
</html>
<style>
    /* Reset CSS */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Global styles */
    body {
        background-color: #1a1a1a;
        color: #f5f5f5;
    }

    /* Header styles */
    header {
        width: 100%;
        padding: 1.25rem 1.5rem;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-family: 'GeistMono-Bold', sans-serif;
    }

    header h1 {
        font-size: 1.5rem;
    }

    .header-buttons a {
        text-decoration: none;
        color: #fff;
        background-color: #1a73e8;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        margin-left: 0.5rem;
        transition: background-color 0.3s ease;
        border-radius: 1rem;
    }

    .header-buttons a:hover {
        background-color: #005bb5;
    }

    /* Container styles */
    .container {
        max-width: 1475px;
        margin: 0rem auto;
        padding: 0.5rem;
    }

    /* Main content styles */
    .content {
        display: flex;
        justify-content: space-between;
        gap: 2rem;
        padding: 2rem;
        background: linear-gradient(145deg, #2a2a2a, #1a1a1a);
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.4);
        border-radius: 8px;
        font-family: 'GeistMono-reg', sans-serif;
    }

    /* Text content styles */
    .text-content {
        width: 55%;
        align-content: center;
        text-align: center;
    }

    .text-content h2 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .text-content p {
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .try-now-button {
        display: inline-block;
        margin-top: 1rem;
        text-decoration: none;
        color: #fff;
        background-color: #28a745;
        padding: 0.75rem 1.5rem;
        border-radius: 4px;
        box-shadow: 0px 4px 10px rgba(0, 128, 0, 0.3);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        width: 60%;
        font-family: 'GeistMono-med', sans-serif;
    }

    .try-now-button:hover {
        background-color: #218838;
        box-shadow: 0px 6px 15px rgba(0, 128, 0, 0.5);
    }

    /* Image placeholder styles */
    .image-placeholder {
        width: 45%;
        height: 500px;
        background-color: #333;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #888;
        font-size: 1.5rem;
        border: 2px solid #555;
        border-radius: 8px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.4);
    }

    .resize-image {
        width: 95%; /* Menyesuaikan dengan lebar kontainer */
        height: 95%;
    }
</style>
