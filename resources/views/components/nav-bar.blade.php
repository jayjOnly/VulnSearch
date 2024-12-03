<header class="header">
    <div class="header-content">
        <a href="{{ url('/search') }}" class="logo">VulnSearch</a>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <div class="header-buttons">
            <a 
                href="{{ route('bookmarks.index') }}" 
                class="bookmark-button" 
                id="bookmarkButton">
                Bookmarks <i class="fas fa-bookmark" id="bookmarkIcon"></i>
            </a>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const bookmarkButton = document.getElementById('bookmarkButton');
                    const bookmarkIcon = document.getElementById('bookmarkIcon');
                    const currentUrl = window.location.href;
                    const bookmarksUrl = '{{ route("bookmarks.index") }}';

                    if (currentUrl.includes(bookmarksUrl)) {
                        bookmarkButton.classList.add('active');
                        bookmarkIcon.classList.remove('far');
                        bookmarkIcon.classList.add('fas');
                    } else {
                        bookmarkButton.classList.remove('active');
                        bookmarkIcon.classList.remove('fas');
                        bookmarkIcon.classList.add('far');

                        // Add hover effects
                        bookmarkButton.addEventListener('mouseenter', () => {
                            if (!currentUrl.includes(bookmarksUrl)) {
                                bookmarkIcon.classList.remove('far');
                                bookmarkIcon.classList.add('fas');
                            }
                        });

                        bookmarkButton.addEventListener('mouseleave', () => {
                            if (!currentUrl.includes(bookmarksUrl)) {
                                bookmarkIcon.classList.remove('fas');
                                bookmarkIcon.classList.add('far');
                            }
                        });
                    }
                });

            </script>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">Log Out</button>
            </form>
        </div>
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
        text-decoration: none;
        color: #ffffff;
    }

    .header-buttons {
        display: flex;
        gap: 1.75rem;
    }

    .bookmark-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(45deg, #0d3c5b, #1a4e7b, #0d3c5b);
        color: #ffffff;
        text-decoration: none;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 50px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        text-align: center;
        font-size: 1rem;
    }

    .bookmark-button:hover {
        background: linear-gradient(45deg, #4c97f0, #1a73e8, #4c97f0);
        transform: scale(1.05);
        text-decoration: none;
    }

    .bookmark-button.active {
        background: linear-gradient(45deg, #006b8f, #0086a1, #006b8f);
        color: #f1f1f1;
        font-weight: bold;
    }

    .bookmark-button.active:hover {
        background: linear-gradient(45deg, #0083b0, #00b4db, #0083b0);
        color: #f1f1f1;
        font-weight: bold;
    }

    .bookmark-button i {
        font-size: 1.2rem;
        color: inherit;
    }

    .logout-button {
        display: inline-block;
        background-color: #ff4d4d;
        color: #ffffff;
        text-decoration: none;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 50px;
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