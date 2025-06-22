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
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #4a4a4a;
        }

        .tabs {
            display: flex;
            margin-bottom: 1.5rem;
            justify-content: center;
            gap: 0.5rem;
        }

        .tab-button {
            flex: 1;
            padding: 10px 16px;
            text-align: center;
            cursor: pointer;
            font-weight: 600;
            background: #edf2f7;
            color: #4a5568;
            border: none;
            border-radius: 9999px;
            transition: all 0.3s ease;
            box-shadow: inset 0 0 0 2px transparent;
        }

        .tab-button:hover {
            background: #e2e8f0;
        }

        .tab-button.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            box-shadow: inset 0 0 0 2px #4c51bf;
        }

        .tab-button.disabled {
            pointer-events: none;
            opacity: 0.6;
            cursor: not-allowed;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background: white;
            border: 1px solid #e5e7eb;
            font-size: 0.85rem;
        }

        th,
        td {
            padding: 0.45rem 0.6rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background-color: #f3f4f6;
        }

        .tab-content table {
            overflow-x: auto;
        }

        .status-ok {
            color: green;
            font-weight: bold;
        }

        .status-missing {
            color: red;
            font-weight: bold;
        }

        .note {
            font-style: italic;
            color: #6b7280;
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

<body data-extensions='@json($extensionsStatus)'>
    <div class="container">
        <div class="tabs">
            <button class="tab-button active" id="tab-php-check" onclick="switchTab('php-check')">Cek Ekstensi PHP</button>
            <button class="tab-button" id="tab-install" onclick="trySwitchToInstall()">Instalasi</button>
        </div>

        <!-- PHP Check -->
        <div id="php-check" class="tab-content active">
            <h2>Cek Ekstensi PHP</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Ekstensi</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($extensionsStatus as $ext)
                            <tr>
                                <td>{{ $ext['name'] }}</td>
                                <td class="{{ $ext['loaded'] ? 'status-ok' : 'status-missing' }}">
                                    {{ $ext['loaded'] ? 'Aktif' : 'Tidak Aktif' }}
                                </td>
                                <td class="note">{{ $ext['note'] ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Install -->
        <div id="install" class="tab-content">
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

            @if (session()->has('success'))
                <div class="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('install.store') }}">
                @csrf

                <label for="db_host">Database Host</label>
                <input type="text" name="db_host" id="db_host" value="{{ old('db_host', '127.0.0.1') }}" required>

                <label for="db_port">Database Port</label>
                <input type="text" name="db_port" id="db_port" value="{{ old('db_port', '3306') }}" required>

                <label for="db_name">Nama Database</label>
                <input type="text" name="db_name" id="db_name" value="{{ old('db_name') }}" required>

                <label for="db_user">User Database</label>
                <input type="text" name="db_user" id="db_user" value="{{ old('db_user') }}" required>

                <label for="db_pass">Password Database</label>
                <input type="password" name="db_pass" id="db_pass" value="{{ old('db_pass') }}">


                <div class="btn-group">
                    <button type="submit" id="test-connection-btn">Test koneksi database</button>
                    @if (session()->has('success'))
                        <a href="{{ route('install.migrate') }}" class="install" id="migrate-btn" onclick="startMigration(event)">Install dan Migrasi</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <script>
        function switchTab(id) {
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            document.querySelector(`[onclick="switchTab('${id}')"]`).classList.add('active');
            document.getElementById(id).classList.add('active');
        }
    </script>

    <script>
        function switchTab(id) {
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            document.getElementById(`tab-${id}`)?.classList.add('active');
            document.getElementById(id).classList.add('active');
        }

        function trySwitchToInstall() {
            const extData = JSON.parse(document.body.dataset.extensions);
            let allExtensionsReady = true;

            extData.forEach(ext => {
                if (ext.name === "gd / imagick") {
                    if (!ext.loaded) {
                        allExtensionsReady = false;
                    }
                } else {
                    if (!ext.loaded) {
                        allExtensionsReady = false;
                    }
                }
            });

            if (allExtensionsReady) {
                switchTab('install');
            } else {
                alert('Beberapa ekstensi PHP belum aktif. Harap aktifkan semuanya sebelum melanjutkan instalasi.');
            }
        }
    </script>

    <script>
        const form = document.querySelector('form');
        const submitBtn = document.getElementById('test-connection-btn');

        form.addEventListener('submit', function() {
            // Ganti teks tombol dan nonaktifkan
            submitBtn.innerText = '⏳ Menguji koneksi...';
            submitBtn.disabled = true;

            // Optional: tambahkan efek visual
            submitBtn.style.opacity = '0.7';
            submitBtn.style.cursor = 'not-allowed';
        });
    </script>

    <script>
        @if (session()->has('success'))
            window.addEventListener('DOMContentLoaded', () => {
                switchTab('install');
                document.getElementById('install').scrollIntoView({ behavior: 'smooth' });
            });
        @endif
    </script>

    <script>
        function startMigration(e) {
            const migrateBtn = document.getElementById('migrate-btn');

            // Mencegah klik ganda dan langsung menuju halaman
            e.preventDefault();

            // Tampilkan loading dan disable tombol
            migrateBtn.innerText = '⏳ Menginstal...';
            migrateBtn.style.opacity = '0.7';
            migrateBtn.style.cursor = 'not-allowed';
            migrateBtn.removeAttribute('onclick');
            migrateBtn.style.pointerEvents = 'none';

            // Redirect secara manual setelah UX tampil
            setTimeout(() => {
                window.location.href = migrateBtn.href;
            }, 300); // sedikit delay agar UX terlihat
        }
    </script>

</body>

</html>
