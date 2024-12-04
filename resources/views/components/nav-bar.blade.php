<header class="header">
    <div class="header-content">
        <a href="{{ url('/search') }}" class="logo">VulnSearch</a>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <div class="header-buttons">
            <a 
                href="{{ route('bookmarks.index') }}" 
                class="bookmark-button" 
                id="bookmarkButton">
                <i class="fas fa-bookmark" id="bookmarkIcon"></i>
                Bookmarks
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
                <button type="button" onclick="confirmLogout()" class="logout-button" id="logout-btn">Log Out</button>
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
        document.getElementById('logout-btn').classList.add('active');
        document.getElementById('logoutModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('logout-btn').classList.remove('active');
        document.getElementById('logoutModal').style.display = 'none';
    }

    function submitLogout() {
        document.getElementById('logout-btn').classList.remove('active');
        document.getElementById('logoutForm').submit();
    }

    // Close modal if user clicks outside
    window.onclick = function(event) {
        let modal = document.getElementById('logoutModal');
        if (event.target == modal) {
            modal.style.display = 'none';
            document.getElementById('logout-btn').classList.remove('active');
        }
    }


</script>

<style>
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.25rem 1.5rem;
        padding-botton: 2rem;
        background-color: rgb(26, 26, 26);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 100;
        width: 100%;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.895);
        /* box-shadow: 0px 2px 10px rgba(208, 208, 208, 0.135); */
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
        background-color:#68686895;
        transform: scale(1.05);
        text-decoration: none;
    }

    .bookmark-button.active {
        background-color:#68686895;
        color: #f1f1f1;
        font-weight: bold;
    }

    .bookmark-button.active:hover {
        border: 1px solid rgb(255, 255, 255);/*awaiting approval*/
        background-color:#68686895;
        color: #f1f1f1;
        font-weight: bold;
    }

    .bookmark-button i {
        font-size: 1.2rem;
        color: inherit;
    }

    .logout-button {
        display: inline-block;
        background-color:transparent;
        border:none;
        color: #ffffff;
        text-decoration: none;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        cursor: pointer;
        text-align: center;
        font-size: 1rem;
        font-family: 'GeistMono-Bold', sans-serif;
    }

    .logout-button:hover {
        background-color: #f23f42;
        /* border: 1.5px solid #6e070a; */
        transform: scale(1.05);
        text-decoration: none;
    }

    .logout-button.active {
        background-color: #F23F43;
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
        background-color: rgb(24, 24, 24); 
        box-shadow: -4px 6px 8px  rgba(0, 0, 0, 0.884);
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
        font-family: 'GeistMono-Bold', sans-serif;
        padding: 8px 20px;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .confirm-button {
        background-color:#f23f42;
        color: white;
    }

    .confirm-button:hover {
        /* background-color: #f69f08b4; */
        transform: scale(1.05);
        background-color:#f4484bf6;
        box-shadow: 0px 3px 5px rgba(252, 22, 22, 0.5);
    }

    .cancel-button {
        border:2px solid #5d646a;
        background-color: transparent;
        /* background-color: #495057; */
        color: white;s
    }

    .cancel-button:hover {
        background-color: #5d646a;
        transform: scale(1.05);
        /* border:None; */
        box-shadow: 0px 3px 5px rgba(112, 112, 112, 0.411);

    }
</style>