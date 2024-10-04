<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
        body {
            background-color: #f7f8fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .login-title {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-check-label {
            margin-left: 5px;
            font-size: 14px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .forgot-password {
            display: block;
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }
        .register-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2 class="login-title">Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <span style="color: red; font-size: 14px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <span style="color: red; font-size: 14px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group form-check">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>

        <button type="submit" class="btn">Login</button>

        @if (Route::has('password.request'))
            <a class="forgot-password" href="{{ route('password.request') }}">Forgot Your Password?</a>
        @endif

        <!-- Tambahan tombol Register -->
        @if (Route::has('register'))
            <a class="register-link" href="{{ route('register') }}">Don't have an account? Register</a>
        @endif
    </form>
</div>

</body>
</html>
