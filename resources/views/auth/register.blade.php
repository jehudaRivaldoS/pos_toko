<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
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
        .register-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .register-title {
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
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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
        .invalid-feedback {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2 class="register-title">Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn">Register</button>
    </form>
</div>

</body>
</html>
