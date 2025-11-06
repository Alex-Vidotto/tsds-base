<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Seven</title>

    <style>
        body {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .welcome-box {
            text-align: center;
            background: white;
            padding: 40px 60px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 400px;
        }

        .welcome-box img {
            display: block;
            margin: 0 auto 20px auto; /* Centra el logo */
            width: 120px;
            height: auto;
        }

        h1 {
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: #1e293b;
        }

        p {
            color: #475569;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #2563eb;
            color: white;
            text-decoration: none;
            padding: 10px 25px;
            border-radius: 8px;
            margin: 5px;
            display: inline-block;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: #1d4ed8;
        }
    </style>
</head>
<body>

    <div class="welcome-box">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Seven">
        <h1>Bienvenido a Seven y-Eleven</h1>
        <a href="{{ route('login') }}" class="btn">Iniciar Sesión</a>
        <a href="{{ route('register') }}" class="btn">Registrarse</a>
    </div>

</body>
</html>
