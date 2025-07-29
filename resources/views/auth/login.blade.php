<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | FileShare</title>
    <link rel="stylesheet" href="{{ asset('css/auth.style.css') }}">
</head>
<body>



<div class="login-wrapper">
    <div class="login-box">
        <h3>FILESHARE</h3>
        <p><h1>Login in to your account</h1></p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" required placeholder="example@email.com">
            </div>

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>

            <button type="submit">Login</button>
            <div class="login-links">
                 <a href="{{ route('register') }}">Register</a>
                 <a href="">Forgot password? </a>
            </div>
        </form>
    </div>
</div>

</body>
</html>

