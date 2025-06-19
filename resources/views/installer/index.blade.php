<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Instalasi Aplikasi Madin App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 2rem 2.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            max-width: 450px;
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #4a4a4a;
        }
        .alert {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 16px;
            font-size: 0.9rem;
            text-align: center;
        }
        label {
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
        }
        input {
            width: 100%;
            box-sizing: border-box;
            padding: 10px 14px;
            margin-bottom: 16px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }
        .btn-group {
            display: flex;
            gap: 0.8rem;
        }
        button {
            padding: 12px;
            background-color: #667eea;
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        a.install {
            background-color: #38a169;
            padding: 9px;
            text-decoration: none;
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        a.install:hover {
            background-color: #2f855a;
        }

        button:hover {
            background-color: #5a67d8;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24; 
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 16px;
            font-size: 0.9rem;
            text-align: center;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Instalasi Madin App</h2>

        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session()->has('success'))
            <div class="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('install.store') }}">
            @csrf

            <label for="db_host">Database Host</label>
            <input type="text" name="db_host" id="db_host" value="127.0.0.1" required>

            <label for="db_port">Database Port</label>
            <input type="text" name="db_port" id="db_port" value="3306" required>

            <label for="db_name">Nama Database</label>
            <input type="text" name="db_name" id="db_name" required>

            <label for="db_user">User Database</label>
            <input type="text" name="db_user" id="db_user" required>

            <label for="db_pass">Password Database</label>
            <input type="password" name="db_pass" id="db_pass">
            <div class="btn-group">
                <button type="submit">Test koneksi database</button>
                @if(session()->has('success'))
                    <a href="{{ route('install.migrate') }}" class="install">Install dan Migrasi</a>
                @endif
            </div>
        </form>
    </div>
</body>
</html>
