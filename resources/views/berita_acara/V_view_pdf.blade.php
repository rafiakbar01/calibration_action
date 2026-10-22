<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
       
    <!-- Favicon - Logo PT PAS -->
    <link rel="icon" type="image/png" href="{{ asset('logo/logo_pas_basic.png') }}">
    <link rel="shortcut icon" href="{{ asset('logo/logo_pas_basic.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo/logo_pas_basic.png') }}">
    <title>Berita Acara - {{ $no_ba }}</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            font-family: Arial, sans-serif;
        }
        
        .pdf-container {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .pdf-viewer {
            flex: 1;
            width: 100%;
            border: none;
        }
        
        .toolbar {
            background: #f5f5f5;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }
        
        .toolbar h3 {
            margin: 0;
            color: #333;
        }
        
        .btn {
            display: inline-block;
            padding: 8px 20px;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: transform 0.2s;
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
        
        .btn-back {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
    </style>
</head>
<body>
    <div class="pdf-container">
        <div class="toolbar">
            <h3>Berita Acara: {{ $no_ba }}</h3>
            <div>
                <a href="{{ $pdf_url }}" download class="btn" style="margin-right: 10px;">⬇️ Download PDF</a>
                <a href="javascript:history.back()" class="btn btn-back">← Kembali</a>
            </div>
        </div>
        <iframe src="{{ $pdf_url }}" class="pdf-viewer"></iframe>
    </div>
</body>
</html>