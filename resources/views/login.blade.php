<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/styleLogin.css'])
</head>

<body>
    @if (session('error') !== null)
        <h1>{{ session('error') }}</h1>
    @endif
    <div id="outerFrame">
        <div>
            <h1 id="loginTitle">Login</h1>
        </div>
        <div id="loginDiv">
            <form action="/login" method="POST">
                @csrf
                <h6 class="login_form_h6">
                    USERNAME
                </h6>
                <input type="text" placeholder="type your username" name="username" class="inputLogin" required>
                <h6 class='login_form_h6'>
                    PASSWORD
                </h6>
                <input type="password" placeholder="type your password" name="password" class="inputLogin" required>
                <button type="submit" id="loginButton">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
