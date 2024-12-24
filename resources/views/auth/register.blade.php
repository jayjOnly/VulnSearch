<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>PoolSafe - Register Form</title>
</head>

<body>
    <div class="background-animation"></div>
    <div class="register-box">
        <a class="logo" href="{{ route('home') }}">VulnSearch</a>
        <h2>Register</h2>
        @error('error')
            <div class="message error" id="message">{{ $message }}</div>
        @enderror
        <form id="registerForm" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-group">
                <input type="text" name="name" id="name" value="{{ old('name') }}" required onfocus="checkInput(this)" onblur="checkInput(this)">
                <label for="name">Name</label>
            </div>
            <div class="input-group">
                <input type="email" name="email" id="email" value="{{ old('email') }}" required onfocus="checkInput(this)" onblur="checkInput(this)">
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" required onfocus="checkInput(this)" onblur="checkInput(this)">
                <label for="password">Password</label>
            </div>
            <div class="input-group">
                <input type="password" name="password_confirmation" id="confirmPassword" required onfocus="checkInput(this)" onblur="checkInput(this)">
                <label for="confirmPassword">Confirm Password</label>
            </div>
            <button type="submit">Register</button>
        </form>
        <div class="login-link">
            Already have an account? <a href="{{ route('login') }}">Login here</a>
        </div>
    </div>

    <script>
        function checkInput(input) {
            if (input.value) {
                input.classList.add('filled');
            } else {
                input.classList.remove('filled');
            }
        }

        // check if repopulated with old()
        checkInput(document.getElementById('name'));
        checkInput(document.getElementById('email'));
    </script>
</body>
</html>

<style>
    * {
        font-family: 'GeistMono-reg', sans-serif;   
    }

    /* Background Animation */
    .background-animation {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(270deg, #0d0d0d, #1a1a1a, #333333, #2b2b2b, #0d0d0d);
        background-size: 800% 800%;
        animation: gradientAnimation 25s ease infinite;
        z-index: -1;
    }

    @keyframes gradientAnimation {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #1a1a1a;
        color: #f5f5f5;
        font-family: 'GeistMono-med', sans-serif;
        overflow-y: auto;
    }

    .register-box {
        background: #2e2e2e;
        padding: 30px;
        margin: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        width: 300px;
        text-align: center;
    }

    .logo {
        font-size: 32px;
        font-weight: bold;
        color: #f5f5f5;
        cursor: pointer;
        text-decoration: none;
        margin-bottom: 20px;
    }

    h2 {
        color: #f5f5f5;
        font-size: 20px;
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .input-group {
        margin-bottom: 30px;
        position: relative;
    }

    label {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        transition: 0.2s ease all;
        color: #aaa;
        pointer-events: none;
        background: #f0f0f0;
        padding: 0 5px;
        z-index: 1;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        background: #f0f0f0;
        transition: background 0.3s, border 0.3s;
        z-index: 0;
        font-size: 16px;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus,
    input[type="text"].filled,
    input[type="email"].filled,
    input[type="password"].filled {
        background: white;
        outline: none;
        border: 1px solid #1a73e8
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        box-shadow: 0 4px 5px #f5f5f5;
    }

    .filled + label,
    input[type="text"]:focus + label,
    input[type="email"]:focus + label,
    input[type="password"]:focus + label {
        top: 0;
        left: 10px;
        font-size: 12px;
        color: #1a73e8;
        background: white;
        border-radius: 1rem;
    }

    button {
        width: 100%;
        padding: 10px;
        background: #1a73e8;
        color: white;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        font-size: 16px;
        transition: background 0.3s;
    }

    button:hover {
        background: #1953a0;
    }

    .login-link {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
        color: #777;
    }

    .login-link a {
        color: #12e640;
        text-decoration: none;
    }

    .message {
        text-align: center;
        margin-bottom: 20px;
        padding: 10px;
        border-radius: 5px;
    }

    .error {
        background-color: #ffcccc;
        color: red;
    }

    .success {
        background-color: #c8e6c9;
        color: green;
    }
</style>