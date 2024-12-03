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

            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="button" onclick="confirmLogout()" class="logout-button">Log Out</button>
            </form>
        </div>
    </div>
</header>

<!-- Modal HTML -->
<div id="logoutModal" class="modal">
    <div class="modal-content">
        <h2 class="logout-confirmation-title">Logout Confirmation</h2>
        <p>Are you sure you want to logout?</p>
        <div class="modal-buttons">
            <button onclick="submitLogout()" class="confirm-button">Yes</button>
            <button onclick="closeModal()" class="cancel-button">No</button>
        </div>
    </div>
</div>


<script>
    function confirmLogout() {
        document.getElementById('logoutModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('logoutModal').style.display = 'none';
    }

    function submitLogout() {
        document.getElementById('logoutForm').submit();
    }

    // Close modal if user clicks outside
    window.onclick = function(event) {
        let modal = document.getElementById('logoutModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
</script>

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

    .modal {
        font-family: 'GeistMono-reg', sans-serif;
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
        background-color: rgb(156, 156, 156); /* Grey with 50% transparency */
        margin: 15% auto;
        padding: 20px;
        border-radius: 8px;
        width: 500px;
        text-align: center;
        margin-top: 20rem;
    }

    .logout-confirmation-title {
        font-family: 'GeistMono-Bold', sans-serif;
        font-size: 20px;
    }

    .modal-buttons {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        gap: 30px;
        font-size: 20px;
    }

    .confirm-button, .cancel-button {
        padding: 8px 20px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .confirm-button {
        background-color: #cc0000;
        color: white;
    }

    .confirm-button:hover {
        background-color: #db2b2b;
        color: black;
    }

    .cancel-button {
        background-color: #495057;
        color: white;
    }

    .cancel-button:hover {
        background-color: #6c757d;
        color: black;
    }
</style>