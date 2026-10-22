<!DOCTYPE html>
<html>
<head>
    <title>Sudah Disetujui</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #2196F3, #1976D2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }
        .card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            text-align: center;
            max-width: 400px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        .icon {
            font-size: 60px;
            margin-bottom: 20px;
        }
        h1 {
            color: #1976D2;
            margin-bottom: 15px;
        }
        .no-ba {
            background: #e3f2fd;
            padding: 10px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            margin: 20px 0;
        }
        p {
            color: #666;
            margin-bottom: 25px;
        }
        .btn {
            background: #2196F3;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 50px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">✓</div>
        <h1>Sudah Disetujui</h1>
        <div class="no-ba">{{ $no_ba }}</div>
        <p>Berita Acara ini sudah disetujui pada {{ $approved_at ? \Carbon\Carbon::parse($approved_at)->format('d/m/Y H:i') : '-' }}</p>
        <a href="/" class="btn">Kembali ke Beranda</a>
    </div>
</body>
</html>