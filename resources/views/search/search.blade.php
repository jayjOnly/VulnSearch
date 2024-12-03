<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vuln Search</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo">VulnSearch</div>
            <a href="{{ route('bookmarks.index') }}" class="bookmark-button">Bookmarks</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">Log Out</button>
            </form>
        </div>
    </header>

    <div class="container">
        <!-- Main Content -->
        <main class="main-content">
            <!-- Welcome Section -->
            <div class="welcome">
                <h1>Hi, {{ Auth::user()->name }}</h1>
            </div>

            <!-- Search Box -->
            <div class="search-container">
                <form action="{{ route('search.results') }}" method="POST" autocomplete="off">
                    @csrf
                    <div class="search-content">
                        <input
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
        </main>
    </div>

    <script>
        // Auto-resize textarea as content grows
        document.querySelector('.search-box').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    </script>
</body>
</html>

<style>
    /* Reset CSS */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Base Styles */
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

    /* Container */
    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* Header */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.20rem 1.5rem;
        background-color: rgba(26, 26, 26, 0.95);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 100;
    }

    .header-content {
        font-family: 'GeistMono-Bold', sans-serif;
        width: 100%;
        max-width: 1475px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        font-size: 1.5rem;
        /* font-weight: bold; */
        color: #ffffff;
    }

    .icon {
        width: 32px;
        height: 32px;
        border: 2px solid #ffffff;
        border-radius: 50%;
        padding: 5px;
    }

    /* Main Content */
    .main-content {
        font-family: 'GeistMono-reg', sans-serif;
        max-width: 768px;
        width: 100%;
        margin: auto;
        padding: 0 2rem;
    }

    /* Welcome Section */
    .welcome {
        margin-bottom: 2rem;
    }

    .welcome h1 {
        font-size: 3.5rem;
        margin-bottom: 0.5rem;
        color: #ffffff;
        border-right: 3px solid #ffffff;
        white-space: nowrap;
        overflow: hidden;
        animation:
            typing 2s steps(8),
            cursor .4s step-end infinite alternate;
        width: 0;
        animation-fill-mode: forwards;
    }

    @keyframes typing {
        from {
            width: 0;
            border-right-color: #ffffff;
        }
        to {
            width: 8ch;
            border-right-color: transparent;
        }
    }

    @keyframes cursor {
        50% { border-color: transparent }
    }

    /* Setelah animasi selesai, hilangkan border */
    .welcome h1 {
        animation:
            typing 2s steps(8) forwards,
            cursor .4s step-end infinite alternate;
        animation-iteration-count: 1, 5; /* Kursor akan berkedip 5 kali saja */
    }

    .search-container {
        background: rgba(26, 26, 26, 0.95);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        padding: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
        font-family: monospace;
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

    /* Hover Effects */
    .search-container:hover {
        border-color: rgba(255, 255, 255, 0.2);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
    }

    .search-button:hover .search-icon {
        border-color: rgba(255, 255, 255, 0.8);
    }

    .search-button:hover .search-icon::after {
        background: rgba(255, 255, 255, 0.8);
    }

    /* Scrollbar Styling */
    .search-box::-webkit-scrollbar {
        width: 6px;
    }

    .search-box::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
    }

    .search-box::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
    }

    .search-box::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .header {
            padding: 1rem;
        }

        .main-content {
            padding: 0 1rem;
        }

        .welcome h1 {
            font-size: 2rem;
        }

        .search-box {
            font-size: 1rem;
        }

        .bookmark-button {
            text-align: center;
        }
    }

    .bookmark-button {
        display: inline-block;
        background-color: #1a73e8;
        color: #ffffff;
        text-decoration: none;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 4px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        text-align: center;
        font-size: 1rem;
    }

    .bookmark-button:hover {
        background-color: #005bb5;
        transform: scale(1.05);
        text-decoration: none;
    }

    .bookmark-button:active {
        background-color: #004494;
        transform: scale(1);
    }

    .logout-button {
        display: inline-block;
        background-color: #ff4d4d;
        color: #ffffff;
        text-decoration: none;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 4px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        cursor: pointer;
        text-align: center;
        font-size: 1rem;
        font-family: 'GeistMono-Bold', sans-serif;
    }

    .logout-button:hover {
        background-color: #ff1a1a;
        transform: scale(1.05);
        text-decoration: none;
    }

    .logout-button:active {
        background-color: #cc0000;
        transform: scale(1);
    }
</style>
