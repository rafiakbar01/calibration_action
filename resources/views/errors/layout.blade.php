<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('error_title', 'Error') - PT PAS Calibration</title>
    <link rel="icon" type="image/png" href="https://welcometo.pascalibration.com/icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
        html,body{height:100%;font-family:'Inter',sans-serif}
        body{min-height:100vh;background:#f0f6ff;display:flex;align-items:center;justify-content:center;overflow:hidden;position:relative}
        .blob{position:fixed;border-radius:50%;filter:blur(90px);opacity:.38;animation:fblob 8s ease-in-out infinite alternate;pointer-events:none;z-index:0}
        .b1{width:560px;height:560px;background:#bfdbfe;top:-170px;left:-160px}
        .b2{width:430px;height:430px;background:#e0f2fe;bottom:-130px;right:-120px;animation-delay:2s}
        .b3{width:330px;height:330px;background:#dbeafe;top:45%;left:52%;animation-delay:4s}
        @keyframes fblob{from{transform:translate(0,0) scale(1)}to{transform:translate(25px,18px) scale(1.07)}}
        .grid{position:fixed;inset:0;z-index:0;pointer-events:none;background-image:linear-gradient(rgba(37,99,235,.04) 1px,transparent 1px),linear-gradient(90deg,rgba(37,99,235,.04) 1px,transparent 1px);background-size:48px 48px}
        .card{position:relative;z-index:10;background:#ffffff;border:1px solid #dbeafe;border-radius:24px;padding:3rem 3.5rem;max-width:560px;width:90%;text-align:center;box-shadow:0 8px 40px rgba(37,99,235,.10),0 1px 4px rgba(37,99,235,.06);animation:cin .55s cubic-bezier(.22,1,.36,1) both}
        @keyframes cin{from{opacity:0;transform:translateY(36px) scale(.96)}to{opacity:1;transform:translateY(0) scale(1)}}
        .badge{display:inline-flex;align-items:center;gap:.45rem;background:#eff6ff;border:1px solid #bfdbfe;border-radius:100px;padding:.3rem .95rem;font-size:.72rem;font-weight:600;color:#2563eb;letter-spacing:1.4px;text-transform:uppercase;margin-bottom:1.5rem}
        .dot{width:6px;height:6px;border-radius:50%;animation:blink 1.8s ease-in-out infinite}
        @keyframes blink{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(.65)}}
        .ecode{font-size:clamp(5rem,18vw,8rem);font-weight:800;line-height:1;letter-spacing:-3px;background:linear-gradient(135deg,#1d4ed8 0%,#60a5fa 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:.4rem;animation:glow 3.5s ease-in-out infinite alternate}
        @keyframes glow{from{filter:drop-shadow(0 0 8px rgba(96,165,250,.2))}to{filter:drop-shadow(0 0 24px rgba(96,165,250,.5))}}
        .eicon{font-size:2.4rem;margin-bottom:.9rem;display:block;animation:bounce 2.5s ease-in-out infinite}
        @keyframes bounce{0%,100%{transform:translateY(0)}50%{transform:translateY(-8px)}}
        .etitle{font-size:1.45rem;font-weight:700;color:#1e3a8a;margin-bottom:.65rem;line-height:1.3}
        .edesc{font-size:.92rem;color:#64748b;line-height:1.75;margin-bottom:2rem}
        .divider{height:1px;background:linear-gradient(90deg,transparent,#bfdbfe,transparent);margin:1.4rem 0}
        .btns{display:flex;gap:.8rem;justify-content:center;flex-wrap:wrap}
        .btn{display:inline-flex;align-items:center;gap:.5rem;padding:.7rem 1.65rem;border-radius:10px;font-size:.875rem;font-weight:600;text-decoration:none;cursor:pointer;border:none;transition:all .22s cubic-bezier(.22,1,.36,1)}
        .btn-p{background:linear-gradient(135deg,#2563eb,#3b82f6);color:#fff;box-shadow:0 3px 14px rgba(37,99,235,.35)}
        .btn-p:hover{background:linear-gradient(135deg,#1d4ed8,#2563eb);box-shadow:0 6px 22px rgba(37,99,235,.45);transform:translateY(-2px)}
        .btn-g{background:#f0f6ff;color:#2563eb;border:1px solid #bfdbfe}
        .btn-g:hover{background:#dbeafe;border-color:#93c5fd;transform:translateY(-2px)}
        .brand{margin-top:2.25rem;display:flex;align-items:center;justify-content:center;gap:.55rem;padding-top:1.5rem;border-top:1px solid #e0f2fe}
        .brand img{width:26px;height:26px;border-radius:6px;opacity:.9}
        .brand span{font-size:.76rem;color:#94a3b8;font-weight:500;letter-spacing:.4px}
        @media(max-width:480px){.card{padding:2rem 1.4rem}.btns{flex-direction:column;align-items:stretch}}
    </style>
    @stack('error_styles')
</head>
<body>
    <div class="blob b1"></div>
    <div class="blob b2"></div>
    <div class="blob b3"></div>
    <div class="grid"></div>
    <div class="card">
        @yield('error_content')
        <div class="brand">
            <img src="https://welcometo.pascalibration.com/icon.png" alt="PAS">
            <span>PT PAS Calibration System</span>
        </div>
    </div>
    @stack('error_scripts')
</body>
</html>
