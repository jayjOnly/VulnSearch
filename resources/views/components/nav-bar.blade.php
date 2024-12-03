<header class="header">
    <div class="header-content">
        <a href="{{ url('/search') }}" class="logo">VulnSearch</a>
        <a href="{{ route('bookmarks.index') }}" class="bookmark-button">Bookmarks</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button">Log Out</button>
        </form>
    </div>
</header>

<style>
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.25rem 1.5rem;
        background-color: rgba(26, 26, 26, 0.95);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 100;
        width: 100%;
    }

    .header-content {
        font-family: 'GeistMono-Bold', sans-serif;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        flex-wrap: wrap;
    }

    .logo {
        font-size: 1.75rem;
        font-weight: bold;
        text-decoration: none; /* Remove underline */
        color: #ffffff;
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