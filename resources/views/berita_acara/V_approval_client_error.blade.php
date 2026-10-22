<!DOCTYPE html>
<html>
<head>
    <title>Link Tidak Valid</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f44336, #d32f2f);
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
            color: #d32f2f;
            margin-bottom: 15px;
        }
        p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        .btn {
            background: #f44336;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 50px;
            display: inline-block;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">🔒</div>
        <h1>Link Tidak Valid</h1>
        <p>{{ $message }}</p>
        <a href="/" class="btn">Kembali ke Beranda</a>
    </div>
</body>
</html>