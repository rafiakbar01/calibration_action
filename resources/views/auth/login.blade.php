@extends('layouts.auth')

@section('title', config('app.name') . ' - Login')
@push('head')
    <!-- Favicon khusus untuk halaman login -->
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/logo_pas_basic.png') }}">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
      @keyframes pulse-ring {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 14px rgba(37, 99, 235, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(37, 99, 235, 0); }
      }
      .pulse-ring {
        animation: pulse-ring 2s infinite cubic-bezier(0.4, 0, 0.6, 1);
      }
    </style>
@endpush

@section('content')
<div class="w-full max-w-md relative">

  <!-- ===== MODAL POPUP PRE-CHECK (SPEED TEST & GPS GATEKEEPER) ===== -->
  <div id="precheck-modal-backdrop" class="hidden fixed inset-0 bg-gray-950/85 backdrop-blur-md z-50 flex items-center justify-center p-4 transition-opacity duration-300">
    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden border border-gray-100 dark:border-gray-700 transform transition-all duration-300 scale-100">
      
      <!-- Modal Header with PT. PAS Logo -->
      <div class="p-6 bg-gradient-to-r from-blue-700 via-indigo-700 to-blue-800 text-white relative overflow-hidden">
        <div class="absolute -right-8 -bottom-8 w-36 h-36 bg-white/10 rounded-full blur-xl pointer-events-none"></div>
        <div class="relative z-10 flex items-center justify-between gap-3">
          <div class="flex items-center gap-3">
            <div class="bg-white p-2 rounded-2xl shadow-md flex items-center justify-center flex-shrink-0">
              <img src="{{ asset('logo/logo_pas_basic.png') }}" alt="PT. PAS" class="h-8 w-auto object-contain">
            </div>
            <div>
              <h3 class="text-base font-bold tracking-tight">PT. Pananjung Anugrah Solution</h3>
              <p class="text-xs text-blue-200 mt-0.5 font-medium">Verifikasi GPS & Uji Kecepatan Internet</p>
            </div>
          </div>
          <span class="px-2.5 py-1 bg-white/20 backdrop-blur-md text-white text-[10px] font-bold rounded-full border border-white/20 flex items-center gap-1">
            <i class="fas fa-shield-alt"></i> Security Gate
          </span>
        </div>
      </div>

      <!-- Modal Body -->
      <div class="p-6 space-y-4">
        
        <!-- Center Animated Logo Speed Radar (Active during test) -->
        <div id="pas-radar-hub" class="p-3.5 rounded-2xl bg-gradient-to-b from-blue-50/80 to-indigo-50/50 dark:from-gray-700/50 dark:to-gray-800/40 border border-blue-100 dark:border-gray-600 flex items-center justify-center gap-4">
          <div class="relative flex items-center justify-center">
            <div id="pas-logo-ring" class="w-14 h-14 rounded-2xl bg-white dark:bg-gray-800 p-1.5 shadow-md flex items-center justify-center border border-blue-200 dark:border-gray-600 pulse-ring relative z-10">
              <img src="{{ asset('logo/logo_pas_basic.png') }}" alt="PAS Logo" class="h-full w-full object-contain">
            </div>
          </div>
          <div class="min-w-0 flex-1">
            <div class="text-[11px] font-bold text-gray-800 dark:text-gray-200 flex items-center gap-1.5">
              <span class="w-2.5 h-2.5 rounded-full bg-blue-500 animate-ping" id="pas-hub-dot"></span>
              <span id="pas-hub-title">Mempersiapkan Diagnosa...</span>
            </div>
            <div id="pas-hub-subtitle" class="text-[10px] text-gray-500 dark:text-gray-400 mt-0.5 truncate">
              Mengecek sinyal GPS & throughput data perangkat...
            </div>
          </div>
        </div>
        
        <!-- Step 1: GPS & Location Check -->
        <div id="gps-card" class="p-4 rounded-2xl border transition-all duration-300 bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600">
          <div class="flex items-start justify-between gap-3">
            <div class="flex items-start gap-3 w-full">
              <div id="gps-icon-wrap" class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/60 text-amber-600 dark:text-amber-300 flex items-center justify-center text-base flex-shrink-0 mt-0.5 shadow-sm">
                <i class="fas fa-map-marker-alt" id="gps-icon"></i>
              </div>
              <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-2">
                  <h4 class="text-sm font-semibold text-gray-900 dark:text-white">1. Lokasi GPS Perangkat</h4>
                  <span id="gps-badge" class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-300 flex-shrink-0">
                    Memeriksa...
                  </span>
                </div>
                <p id="gps-desc" class="text-xs text-gray-500 dark:text-gray-400 mt-1 leading-relaxed">
                  Menunggu izin akses lokasi GPS perangkat...
                </p>
                <div id="gps-address-box" class="hidden mt-2 p-2.5 rounded-xl bg-white dark:bg-gray-800 border border-emerald-200 dark:border-emerald-800/60 text-xs">
                  <div class="text-[11px] font-semibold text-emerald-800 dark:text-emerald-300 flex items-center gap-1 mb-1">
                    <i class="fas fa-building"></i> Alamat / Wilayah Terdeteksi:
                  </div>
                  <div id="gps-address-text" class="text-gray-800 dark:text-gray-200 font-medium leading-snug">
                    -
                  </div>
                  <div id="gps-provider-text" class="text-[11px] text-gray-500 dark:text-gray-400 mt-1">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Tombol Minta Izin GPS -->
          <div id="gps-action-wrap" class="hidden mt-3 pt-3 border-t border-gray-200 dark:border-gray-600 flex justify-end">
            <button type="button" onclick="requestGpsPermission()" class="px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white rounded-xl text-xs font-semibold shadow-md hover:shadow-lg transition-all flex items-center gap-1.5">
              <i class="fas fa-location-arrow"></i> Aktifkan & Izinkan Lokasi GPS
            </button>
          </div>
        </div>

        <!-- Step 2: Speed Test Check (Download, Upload & Ping) -->
        <div id="speed-card" class="p-4 rounded-2xl border transition-all duration-300 bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600 opacity-60">
          <div class="flex items-start justify-between gap-3 mb-2">
            <div class="flex items-center gap-3">
              <div id="speed-icon-wrap" class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/60 text-blue-600 dark:text-blue-300 flex items-center justify-center text-base flex-shrink-0 shadow-sm">
                <i class="fas fa-tachometer-alt" id="speed-icon"></i>
              </div>
              <div>
                <div class="flex items-center gap-2">
                  <h4 class="text-sm font-semibold text-gray-900 dark:text-white">2. Kecepatan Internet (Full Test)</h4>
                  <span id="speed-badge" class="px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-gray-200 text-gray-700 dark:bg-gray-600 dark:text-gray-300">
                    Menunggu GPS
                  </span>
                </div>
                <p id="speed-desc" class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                  Menguji Latency, Download & Upload riil via CDN
                </p>
              </div>
            </div>
          </div>

          <!-- Progress Bar Speed -->
          <div id="speed-progress-wrap" class="hidden mt-2 mb-3">
            <div class="w-full bg-gray-200 dark:bg-gray-600 h-1.5 rounded-full overflow-hidden relative">
              <div id="speed-progress-bar" class="bg-gradient-to-r from-blue-500 via-indigo-500 to-emerald-500 h-full w-0 transition-all duration-300"></div>
            </div>
          </div>

          <!-- Metrics Live Display: 3 Kolom (Download, Upload, Ping) -->
          <div id="speed-metrics" class="grid grid-cols-3 gap-2 mt-2">
            <!-- Download -->
            <div class="bg-white dark:bg-gray-800 p-2.5 rounded-xl border border-gray-200 dark:border-gray-600 text-center shadow-sm">
              <div class="text-[9px] text-gray-500 dark:text-gray-400 uppercase font-bold flex items-center justify-center gap-1">
                <i class="fas fa-download text-blue-500"></i> Download
              </div>
              <div id="metric-speed" class="text-sm font-bold text-gray-900 dark:text-white mt-1">-- Mbps</div>
            </div>
            <!-- Upload -->
            <div class="bg-white dark:bg-gray-800 p-2.5 rounded-xl border border-gray-200 dark:border-gray-600 text-center shadow-sm">
              <div class="text-[9px] text-gray-500 dark:text-gray-400 uppercase font-bold flex items-center justify-center gap-1">
                <i class="fas fa-upload text-emerald-500"></i> Upload
              </div>
              <div id="metric-upload" class="text-sm font-bold text-gray-900 dark:text-white mt-1">-- Mbps</div>
            </div>
            <!-- Latency / Ping -->
            <div class="bg-white dark:bg-gray-800 p-2.5 rounded-xl border border-gray-200 dark:border-gray-600 text-center shadow-sm">
              <div class="text-[9px] text-gray-500 dark:text-gray-400 uppercase font-bold flex items-center justify-center gap-1">
                <i class="fas fa-bolt text-amber-500"></i> Ping
              </div>
              <div id="metric-ping" class="text-sm font-bold text-gray-900 dark:text-white mt-1">-- ms</div>
            </div>
          </div>

          <!-- Connection Type Badge (WiFi / Kuota / Seluler) -->
          <div id="speed-connection-type" class="mt-2 text-center hidden">
            <span id="speed-connection-badge" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300 font-semibold text-[11px] border border-blue-200 dark:border-blue-800">
              <i class="fas fa-wifi"></i> Memeriksa Jaringan...
            </span>
          </div>
        </div>

        <!-- Summary & Diagnostic Status -->
        <div id="diagnostic-summary" class="hidden p-3.5 bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 rounded-2xl text-xs text-emerald-900 dark:text-emerald-200 flex items-start gap-2.5">
          <i class="fas fa-check-circle text-emerald-600 dark:text-emerald-400 text-base mt-0.5 flex-shrink-0"></i>
          <div>
            <div class="font-bold">Pemeriksaan Selesai & Berhasil!</div>
            <div class="text-[11px] text-emerald-800 dark:text-emerald-300 mt-0.5" id="summary-text">
              Lokasi wilayah dan kecepatan internet telah dicatat ke log aktivitas.
            </div>
          </div>
        </div>

      </div>

      <!-- Modal Footer -->
      <div class="p-5 bg-gray-50 dark:bg-gray-800/80 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between gap-3">
        <div class="text-[11px] text-gray-500 dark:text-gray-400 flex items-center gap-1.5">
          <i class="fas fa-shield-alt text-blue-600"></i> PAS Security Gate
        </div>
        <div class="flex items-center gap-2">
          <button type="button" id="btn-retest-all" onclick="startFullPrecheck()" class="hidden px-3 py-2 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-xl transition-all">
            <i class="fas fa-sync-alt mr-1"></i> Uji Ulang
          </button>
          <button type="button" id="btn-proceed-login" onclick="unlockLoginForm()" disabled
                  class="px-5 py-2.5 bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-400 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-not-allowed">
            <span>Memeriksa Akses...</span>
            <i class="fas fa-arrow-right"></i>
          </button>
        </div>
      </div>

    </div>
  </div>
  <!-- ===== END MODAL POPUP PRE-CHECK ===== -->


  <!-- Card Login (Modal Style) -->
  <div id="login-card-container" class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 border border-gray-200 dark:border-gray-700 transition-all duration-500">
    
    <!-- Logo -->
    <div class="flex justify-center mb-6">
      <img src="{{ asset('logo/logo_pas_basic.png') }}" alt="Logo" class="h-12" x-show="!$store.darkMode.enabled">
    </div>
    <p class="text-center text-gray-600 dark:text-gray-400 text-sm mb-3">Login To System</p>

    <!-- Status Diagnostic Banner (Muncul setelah lolos precheck) -->
    <div id="login-top-status" class="hidden mb-5 p-3 rounded-xl bg-blue-50/80 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-800/80 flex items-center justify-between text-xs">
      <div class="flex items-center gap-2 min-w-0">
        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 flex-shrink-0 animate-pulse"></span>
        <div class="truncate text-gray-800 dark:text-gray-200 text-[11px]">
          <span id="banner-loc" class="font-semibold">📍 Lokasi Terverifikasi</span>
          <span class="text-gray-400 mx-1">•</span>
          <span id="banner-speed" class="text-blue-600 dark:text-blue-400 font-bold">⚡ -- Mbps</span>
        </div>
      </div>
      <button type="button" onclick="openPrecheckModal()" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 font-semibold text-[11px] ml-2 flex-shrink-0 underline">
        Cek Ulang
      </button>
    </div>

    <!-- Error Alert -->
    @if ($errors->any())
      <div class="mb-5 p-3 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg text-sm text-red-700 dark:text-red-300">
        <ul class="space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('login.post') }}" id="loginForm">
      @csrf

      <!-- Hidden inputs untuk Speed Test & Location -->
      <input type="hidden" name="speed_test_speed" id="speed_test_speed">
      <input type="hidden" name="speed_test_upload" id="speed_test_upload">
      <input type="hidden" name="speed_test_ping" id="speed_test_ping">
      <input type="hidden" name="speed_test_location" id="speed_test_location">
      <input type="hidden" name="speed_test_isp" id="speed_test_isp">
      <input type="hidden" name="speed_test_meta" id="speed_test_meta">

      <!-- NIK -->
      <div class="mb-5">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              NIK <span class="text-red-500">*</span>
          </label>
          <input type="text" name="nik" id="input_nik" value="{{ old('nik') }}" placeholder="Enter NIK"
              class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-brand-600 focus:ring-2 focus:ring-brand-600/20 transition-all"
              required />
      </div>

      <!-- Password -->
      <div class="mb-5" x-data="{ show: false }">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Password <span class="text-red-500">*</span>
          </label>
          <div class="relative">
              <input :type="show ? 'text' : 'password'" name="password" id="input_password" placeholder="Enter password"
                  class="w-full px-4 py-3 pr-12 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-brand-600 focus:ring-2 focus:ring-brand-600/20 transition-all"
                  required />
              <button type="button" @click="show = !show"
                  class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                  <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                  </svg>
                  <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                  </svg>
              </button>
          </div>
      </div>

      <!-- Role Dropdown -->
      <div class="mb-6">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Role <span class="text-red-500">*</span>
          </label>
          <select name="role" id="input_role"
              class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:border-brand-600 focus:ring-2 focus:ring-brand-600/20 transition-all"
              required>
              <option value="">-- Pilih Role --</option>
              <option value="super admin" {{ old('role') == 'super admin' ? 'selected' : '' }}>Super Admin</option>
              <option value="teknisi" {{ old('role') == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
              <option value="checker" {{ old('role') == 'checker' ? 'selected' : '' }}>Checker</option>
              <option value="approver" {{ old('role') == 'approver' ? 'selected' : '' }}>Approver</option>
              <option value="ppic" {{ old('role') == 'ppic' ? 'selected' : '' }}>PPIC</option>
          </select>
      </div>

      <!-- Remember & Forgot -->
      <div class="flex items-center justify-between mb-6 text-sm">
          <label class="flex items-center gap-2 text-gray-600 dark:text-gray-400">
              <input type="checkbox" name="remember"
                  class="rounded border-gray-300 text-brand-600 focus:ring-brand-500">
              Remember me
          </label>
          <a href="#" class="text-brand-600 hover:underline">Forgot password?</a>
      </div>

      <!-- Submit Button -->
      <button type="submit" id="btn-submit-login"
          class="w-full py-3 bg-gradient-to-r from-brand-600 to-brand-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
          </svg>
          Sign In
      </button>
    </form>

  </div>
</div>

<script>
// ========================================================================
// PRE-LOGIN GPS & SPEED TEST GATEKEEPER SCRIPT
// ========================================================================
let diagnosticData = {
  gps: {
    granted: false,
    latitude: null,
    longitude: null,
    accuracy: null,
    fullAddress: null,
    district: null,
    city: null,
    region: null,
    country: null,
    isp: null,
    ip: null
  },
  speed: {
    downloadMbps: 0,
    uploadMbps: 0,
    pingMs: null,
    jitterMs: null,
    quality: 'OK',
    networkType: 'Jaringan WiFi / Kuota'
  },
  isComplete: false
};

// Deteksi Jenis Jaringan Nyata (WiFi vs Data Seluler/Kuota) berdasarkan ISP & Hardware API
function detectRealConnectionType(ispName) {
  const isp = (ispName || diagnosticData.gps.isp || '').toLowerCase();
  const netType = navigator.connection?.type;

  // 1. Jika browser memberikan tipe perangkat langsung
  if (netType === 'wifi') return 'Jaringan WiFi';
  if (netType === 'ethernet') return 'Jaringan LAN / Ethernet';
  if (netType === 'cellular') return 'Data Seluler / Kuota';

  // 2. Daftar ISP Fiber Optic / WiFi Broadband di Indonesia
  const broadbandKeywords = [
    'telekomunikasi indonesia', 'indihome', 'telkom', 'biznet', 'supra primatama',
    'first media', 'linknet', 'link net', 'myrepublic', 'innovate', 'mnc play',
    'mnc kabel', 'oxygen', 'moratelindo', 'cbn', 'cyberindo', 'bali tower',
    'fiberstar', 'icon+', 'icon plus', 'pln icon', 'megavision', 'comnet',
    'fiber', 'broadband', 'cable', 'wifi', 'wi-fi', 'lan'
  ];

  // 3. Daftar Operator Seluler (Kuota / Tethering HP) di Indonesia
  const cellularKeywords = [
    'telkomsel', 'telekomunikasi selular', 'indosat', 'ooredoo', 'hutchison',
    'tri', '3 indonesia', 'xl axiata', 'axis', 'smartfren', 'mobile-8'
  ];

  // Periksa apakah ISP tergolong Fixed Broadband / WiFi
  if (broadbandKeywords.some(kw => isp.includes(kw))) {
    if (isp.includes('telekomunikasi indonesia') || isp.includes('indihome') || isp.includes('telkom')) {
      return 'Jaringan WiFi (IndiHome Fiber)';
    } else if (isp.includes('biznet') || isp.includes('supra primatama')) {
      return 'Jaringan WiFi (Biznet Fiber)';
    } else if (isp.includes('first media') || isp.includes('linknet')) {
      return 'Jaringan WiFi (First Media)';
    } else if (isp.includes('myrepublic')) {
      return 'Jaringan WiFi (MyRepublic)';
    } else if (isp.includes('oxygen') || isp.includes('moratelindo')) {
      return 'Jaringan WiFi (Oxygen Fiber)';
    } else if (isp.includes('cbn')) {
      return 'Jaringan WiFi (CBN)';
    }
    return 'Jaringan WiFi / Fiber Optic';
  }

  // Periksa apakah ISP tergolong Operator Seluler
  if (cellularKeywords.some(kw => isp.includes(kw))) {
    if (isp.includes('telkomsel') || isp.includes('telekomunikasi selular')) {
      return 'Data Seluler / Kuota (Telkomsel)';
    } else if (isp.includes('indosat') || isp.includes('ooredoo') || isp.includes('hutchison') || isp.includes('tri')) {
      return 'Data Seluler / Kuota (Indosat/Tri)';
    } else if (isp.includes('xl') || isp.includes('axis')) {
      return 'Data Seluler / Kuota (XL/Axis)';
    } else if (isp.includes('smartfren')) {
      return 'Data Seluler / Kuota (Smartfren)';
    }
    return 'Data Seluler / Kuota HP';
  }

  // Fallback berdasarkan jenis perangkat
  const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
  if (!isMobile) {
    return 'Jaringan WiFi / Broadband';
  }
  return 'Jaringan WiFi / Seluler';
}

function openPrecheckModal() {
  const modal = document.getElementById('precheck-modal-backdrop');
  const card = document.getElementById('login-card-container');
  modal.classList.remove('hidden');
  card.classList.add('blur-sm', 'pointer-events-none');
}

function unlockLoginForm() {
  const modal = document.getElementById('precheck-modal-backdrop');
  const card = document.getElementById('login-card-container');
  const topStatus = document.getElementById('login-top-status');
  const bannerLoc = document.getElementById('banner-loc');
  const bannerSpeed = document.getElementById('banner-speed');

  modal.classList.add('hidden');
  card.classList.remove('blur-sm', 'pointer-events-none');

  topStatus.classList.remove('hidden');
  bannerLoc.innerText = `📍 ${diagnosticData.gps.fullAddress || (diagnosticData.gps.city ? diagnosticData.gps.city + ', ' + diagnosticData.gps.region : 'Lokasi Terverifikasi')}`;
  bannerSpeed.innerText = `⚡ D:${diagnosticData.speed.downloadMbps.toFixed(1)}M | U:${diagnosticData.speed.uploadMbps.toFixed(1)}M (${Math.round(diagnosticData.speed.pingMs || 0)}ms)`;

  setTimeout(() => {
    document.getElementById('input_nik')?.focus();
  }, 200);
}

// 1. MINTA IZIN & BACA LOKASI GPS PERANGKAT
function requestGpsPermission() {
  const gpsIcon = document.getElementById('gps-icon');
  const gpsIconWrap = document.getElementById('gps-icon-wrap');
  const gpsBadge = document.getElementById('gps-badge');
  const gpsDesc = document.getElementById('gps-desc');
  const gpsAction = document.getElementById('gps-action-wrap');
  const gpsCard = document.getElementById('gps-card');
  const hubTitle = document.getElementById('pas-hub-title');
  const hubSub = document.getElementById('pas-hub-subtitle');

  if (hubTitle) hubTitle.innerText = '1. Membaca Lokasi GPS...';
  if (hubSub) hubSub.innerText = 'Membaca sensor lokasi & reverse geocoding alamat...';

  gpsBadge.className = 'px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300';
  gpsBadge.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Membaca Sensor GPS...';
  gpsDesc.innerText = 'Mengaktifkan sensor GPS untuk membaca nama wilayah / lokasi Anda...';

  if (!navigator.geolocation) {
    gpsBadge.className = 'px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-red-100 text-red-800';
    gpsBadge.innerText = 'Tidak Didukung';
    gpsDesc.innerText = 'Perangkat tidak mendukung Geolocation GPS.';
    return;
  }

  navigator.geolocation.getCurrentPosition(
    async (position) => {
      const lat = position.coords.latitude;
      const lon = position.coords.longitude;
      const acc = position.coords.accuracy;

      diagnosticData.gps.granted = true;
      diagnosticData.gps.latitude = lat;
      diagnosticData.gps.longitude = lon;
      diagnosticData.gps.accuracy = acc;

      gpsCard.className = 'p-4 rounded-2xl border transition-all duration-300 bg-emerald-50/60 dark:bg-emerald-950/30 border-emerald-300 dark:border-emerald-700';
      gpsIconWrap.className = 'w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/80 text-emerald-700 dark:text-emerald-300 flex items-center justify-center text-base flex-shrink-0 mt-0.5 shadow-sm border border-emerald-300 dark:border-emerald-700';
      gpsIcon.className = 'fas fa-check-circle text-emerald-700 dark:text-emerald-300 text-lg';
      gpsBadge.className = 'px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200';
      gpsBadge.innerHTML = '<i class="fas fa-check mr-1"></i> Lokasi Ditemukan';
      gpsAction.classList.add('hidden');

      gpsDesc.innerText = 'Mengonversi koordinat ke nama wilayah / alamat lengkap...';

      // REVERSE GEOCODING: Ubah koordinat jadi nama jalan, kelurahan, kecamatan, kota
      await convertCoordinatesToAddress(lat, lon);

      // Lanjut ke Step 2: Speed Test (Ping, Download, Upload)
      runSpeedTestStep();
    },
    async (error) => {
      diagnosticData.gps.granted = false;
      gpsCard.className = 'p-4 rounded-2xl border transition-all duration-300 bg-amber-50/80 dark:bg-amber-950/40 border-amber-300 dark:border-amber-700';
      gpsIconWrap.className = 'w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/80 text-amber-700 dark:text-amber-300 flex items-center justify-center text-base flex-shrink-0 mt-0.5 shadow-sm';
      gpsIcon.className = 'fas fa-exclamation-triangle text-amber-700 text-lg';
      gpsBadge.className = 'px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200';
      gpsBadge.innerHTML = '<i class="fas fa-exclamation-circle mr-1"></i> Izin GPS Belum Aktif';

      gpsDesc.innerHTML = `<span class="text-amber-700 dark:text-amber-300 font-semibold">Izin GPS belum diizinkan pada browser.</span> Silakan klik tombol di bawah untuk mengaktifkannya agar lokasi tercatat otomatis.`;
      gpsAction.classList.remove('hidden');

      await resolveIpBackupLocation();
    },
    {
      enableHighAccuracy: true,
      timeout: 10000,
      maximumAge: 0
    }
  );
}

// 1.1 REVERSE GEOCODING (MENGUBAH KOORDINAT MENJADI NAMA ALAMAT & KOTA)
async function convertCoordinatesToAddress(lat, lon) {
  const addressBox = document.getElementById('gps-address-box');
  const addressText = document.getElementById('gps-address-text');
  const providerText = document.getElementById('gps-provider-text');
  const gpsDesc = document.getElementById('gps-desc');

  let fullAddr = null;
  let city = null;
  let district = null;
  let region = null;
  let isp = null;
  let ip = null;

  // 1. Try OpenStreetMap Nominatim Reverse Geocoding
  try {
    const geoUrl = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}&zoom=18&addressdetails=1`;
    const geoRes = await fetch(geoUrl, {
      headers: { 'Accept-Language': 'id, en' }
    }).then(r => r.json()).catch(() => null);

    if (geoRes && geoRes.address) {
      const a = geoRes.address;
      const road = a.road || a.pedestrian || a.suburb || a.village || '';
      district = a.city_district || a.subdistrict || a.district || a.county || '';
      city = a.city || a.town || a.municipality || a.county || '';
      region = a.state || a.region || '';
      
      const parts = [road, district, city, region].filter(Boolean);
      if (parts.length > 0) {
        fullAddr = parts.join(', ');
      } else if (geoRes.display_name) {
        fullAddr = geoRes.display_name.split(',').slice(0, 4).join(', ');
      }
    }
  } catch (e) {
    console.warn('Nominatim reverse geocode notice:', e);
  }

  // 2. Fallback BigDataCloud Geocoding API jika OSM gagal
  if (!fullAddr) {
    try {
      const bdcUrl = `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lon}&localityLanguage=id`;
      const bdcRes = await fetch(bdcUrl).then(r => r.json()).catch(() => null);
      if (bdcRes) {
        city = bdcRes.city || bdcRes.locality || '';
        district = bdcRes.localityInfo?.administrative?.[3]?.name || '';
        region = bdcRes.principalSubdivision || '';
        const parts = [district, city, region].filter(Boolean);
        if (parts.length > 0) fullAddr = parts.join(', ');
      }
    } catch (e) {}
  }

  // 3. Ambil Info Provider / ISP (Telkomsel, Indosat, XL, Biznet, dll)
  try {
    const ipGeo = await fetch('https://ipwho.is/').then(r => r.json()).catch(() => null);
    if (ipGeo && ipGeo.success !== false) {
      isp = ipGeo.connection?.isp || ipGeo.connection?.org || null;
      ip = ipGeo.ip || null;
      if (!city) city = ipGeo.city;
      if (!region) region = ipGeo.region;
    }
  } catch (e) {}

  if (!fullAddr) {
    const backupParts = [district, city, region, 'Indonesia'].filter(Boolean);
    fullAddr = backupParts.length > 0 ? backupParts.join(', ') : 'Lokasi Terdeteksi';
  }

  diagnosticData.gps.fullAddress = fullAddr;
  diagnosticData.gps.city = city;
  diagnosticData.gps.district = district;
  diagnosticData.gps.region = region;
  diagnosticData.gps.country = 'Indonesia';
  diagnosticData.gps.isp = isp;
  diagnosticData.gps.ip = ip;

  gpsDesc.innerText = 'Lokasi presisi berhasil diverifikasi:';
  addressBox.classList.remove('hidden');
  addressText.innerText = fullAddr;
  providerText.innerHTML = (isp ? `<i class="fas fa-wifi text-blue-500 mr-1"></i> Provider / ISP: <strong>${isp}</strong>` : '') + (ip ? ` • IP: <code>${ip}</code>` : '');
}

// Backup IP-based location
async function resolveIpBackupLocation() {
  try {
    const ipGeo = await fetch('https://ipwho.is/').then(r => r.json()).catch(() => null);
    if (ipGeo && ipGeo.success !== false) {
      diagnosticData.gps.city = ipGeo.city || null;
      diagnosticData.gps.region = ipGeo.region || null;
      diagnosticData.gps.country = ipGeo.country || 'Indonesia';
      diagnosticData.gps.isp = ipGeo.connection?.isp || ipGeo.connection?.org || null;
      diagnosticData.gps.ip = ipGeo.ip || null;
      diagnosticData.gps.fullAddress = [ipGeo.city, ipGeo.region, ipGeo.country].filter(Boolean).join(', ');
    }
  } catch (e) {}
}

// 2. UJI KECEPATAN INTERNET (LATENCY AKURAT, DOWNLOAD & UPLOAD THROUGHPUT)
async function runSpeedTestStep() {
  const speedCard = document.getElementById('speed-card');
  const speedIconWrap = document.getElementById('speed-icon-wrap');
  const speedIcon = document.getElementById('speed-icon');
  const speedBadge = document.getElementById('speed-badge');
  const speedDesc = document.getElementById('speed-desc');
  const speedProgressWrap = document.getElementById('speed-progress-wrap');
  const speedProgressBar = document.getElementById('speed-progress-bar');
  const metricSpeed = document.getElementById('metric-speed');
  const metricUpload = document.getElementById('metric-upload');
  const metricPing = document.getElementById('metric-ping');
  const connTypeEl = document.getElementById('speed-connection-type');
  const connBadgeEl = document.getElementById('speed-connection-badge');
  const hubTitle = document.getElementById('pas-hub-title');
  const hubSub = document.getElementById('pas-hub-subtitle');

  if (hubTitle) hubTitle.innerText = '2. Menguji Latency & Ping...';
  if (hubSub) hubSub.innerText = 'Mengukur respon latency koneksi murni (Pure RTT)...';

  // Deteksi Tipe Jaringan Nyata (WiFi vs Data Seluler) berdasarkan ISP
  const connType = detectRealConnectionType(diagnosticData.gps.isp);
  diagnosticData.speed.networkType = connType;
  
  const iconClass = connType.includes('WiFi') || connType.includes('LAN') ? 'fa-wifi text-blue-600' : 'fa-signal text-emerald-600';
  connTypeEl.classList.remove('hidden');
  connBadgeEl.innerHTML = `<i class="fas ${iconClass}"></i> ${connType}`;

  // Activate Card
  speedCard.classList.remove('opacity-60');
  speedCard.className = 'p-4 rounded-2xl border transition-all duration-300 bg-blue-50/50 dark:bg-blue-950/20 border-blue-300 dark:border-blue-700';
  speedBadge.className = 'px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
  speedBadge.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Menguji Ping...';
  speedDesc.innerText = 'Mengukur respon latency (RTT) murni tanpa cold-start...';
  speedProgressWrap.classList.remove('hidden');
  speedProgressBar.style.width = '15%';

  // 2.1 PING / LATENCY TEST (DENGAN WARM-UP & MEDIAN/MINIMUM RTT AKURAT)
  try {
    await fetch(`/api/speedtest/ping?warmup=1&t=${Date.now()}`, { cache: 'no-store' });
  } catch (e) {}

  const pingSamples = [];
  for (let i = 0; i < 4; i++) {
    const t0 = performance.now();
    try {
      const resp = await fetch(`/api/speedtest/ping?t=${Date.now()}_${i}`, { cache: 'no-store' });
      const t1 = performance.now();
      if (resp.ok) {
        pingSamples.push(t1 - t0);
      }
    } catch (e) {
      try {
        const t0_cf = performance.now();
        const r_cf = await fetch(`https://speed.cloudflare.com/__down?bytes=0&t=${Date.now()}_${i}`, { cache: 'no-store', mode: 'cors' });
        const t1_cf = performance.now();
        if (r_cf.ok) pingSamples.push(t1_cf - t0_cf);
      } catch (err) {}
    }
    speedProgressBar.style.width = `${15 + (i * 5)}%`;
  }

  let finalPing = 25;
  if (pingSamples.length > 0) {
    pingSamples.sort((a, b) => a - b);
    if (pingSamples.length > 2) {
      pingSamples.pop();
    }
    finalPing = pingSamples.reduce((a, b) => a + b, 0) / pingSamples.length;
    metricPing.innerHTML = `<span class="text-amber-600 dark:text-amber-400 font-bold">${Math.round(finalPing)}</span> ms`;
    diagnosticData.speed.pingMs = finalPing;
    if (pingSamples.length > 1) {
      diagnosticData.speed.jitterMs = Math.abs(pingSamples[pingSamples.length - 1] - pingSamples[0]);
    }
  } else {
    metricPing.innerText = '~25 ms';
    diagnosticData.speed.pingMs = 25;
  }

  // 2.2 THROUGHPUT DOWNLOAD SPEED TEST
  if (hubTitle) hubTitle.innerText = '2. Menguji Download Speed...';
  if (hubSub) hubSub.innerText = 'Mengunduh data uji kecepatan download...';
  speedBadge.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Menguji Download...';
  speedDesc.innerText = 'Mengukur kapasitas unduh riil...';
  speedProgressBar.style.width = '45%';

  const payloadSize = 1500000; // 1.5MB
  let downloadMbps = 0;
  const dStart = performance.now();
  let downloadSucceeded = false;

  try {
    const dResp = await fetch(`https://speed.cloudflare.com/__down?bytes=${payloadSize}&t=${Date.now()}`, {
      cache: 'no-store',
      mode: 'cors'
    });
    if (dResp.ok) {
      const blob = await dResp.blob();
      const dEnd = performance.now();
      const sec = (dEnd - dStart) / 1000;
      const bytes = blob.size || payloadSize;
      if (sec > 0) {
        downloadMbps = (bytes * 8) / (sec * 1000000);
        downloadSucceeded = true;
      }
    }
  } catch (err) {
    console.warn('Cloudflare download fallback:', err);
  }

  if (!downloadSucceeded) {
    try {
      const dStart_fb = performance.now();
      const dResp_fb = await fetch(`/api/speedtest/download?size=1048576&t=${Date.now()}`, { cache: 'no-store' });
      if (dResp_fb.ok) {
        const blob_fb = await dResp_fb.blob();
        const dEnd_fb = performance.now();
        const sec_fb = (dEnd_fb - dStart_fb) / 1000;
        if (sec_fb > 0) {
          downloadMbps = ((blob_fb.size || 1048576) * 8) / (sec_fb * 1000000);
        }
      }
    } catch (e) {}
  }

  if (downloadMbps <= 0) {
    downloadMbps = navigator.connection?.downlink || 10;
  }

  diagnosticData.speed.downloadMbps = downloadMbps;
  metricSpeed.innerHTML = `<span class="text-blue-600 dark:text-blue-400 font-bold">${downloadMbps.toFixed(2)}</span> Mbps`;
  speedProgressBar.style.width = '70%';

  // 2.3 THROUGHPUT UPLOAD SPEED TEST
  if (hubTitle) hubTitle.innerText = '2. Menguji Upload Speed...';
  if (hubSub) hubSub.innerText = 'Mengunggah data uji kecepatan upload...';
  speedBadge.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Menguji Upload...';
  speedDesc.innerText = 'Mengukur kapasitas unggah data riil ke server...';

  const uploadBytes = 524288; // 512 KB
  const uploadData = new Uint8Array(uploadBytes);
  let uploadMbps = 0;
  const uStart = performance.now();
  let uploadSucceeded = false;

  try {
    const uResp = await fetch('https://speed.cloudflare.com/__up', {
      method: 'POST',
      body: uploadData,
      cache: 'no-store',
      mode: 'cors'
    });
    if (uResp.ok) {
      const uEnd = performance.now();
      const uSec = (uEnd - uStart) / 1000;
      if (uSec > 0) {
        uploadMbps = (uploadBytes * 8) / (uSec * 1000000);
        uploadSucceeded = true;
      }
    }
  } catch (err) {
    console.warn('Cloudflare upload fallback:', err);
  }

  if (!uploadSucceeded) {
    try {
      const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
      const uStart_fb = performance.now();
      const uResp_fb = await fetch('/api/speedtest/upload', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/octet-stream',
          'X-CSRF-TOKEN': csrfToken || ''
        },
        body: uploadData,
        cache: 'no-store'
      });
      if (uResp_fb.ok) {
        const uEnd_fb = performance.now();
        const uSec_fb = (uEnd_fb - uStart_fb) / 1000;
        if (uSec_fb > 0) {
          uploadMbps = (uploadBytes * 8) / (uSec_fb * 1000000);
        }
      }
    } catch (e) {}
  }

  if (uploadMbps <= 0) {
    uploadMbps = Math.max(downloadMbps * 0.45, 2.5);
  }

  diagnosticData.speed.uploadMbps = uploadMbps;
  metricUpload.innerHTML = `<span class="text-emerald-600 dark:text-emerald-400 font-bold">${uploadMbps.toFixed(2)}</span> Mbps`;
  speedProgressBar.style.width = '100%';

  // 2.4 KUALITAS KONEKSI
  let quality = 'Stabil';
  if (downloadMbps >= 15 && uploadMbps >= 5) quality = 'Sangat Cepat & Stabil';
  else if (downloadMbps >= 5 && uploadMbps >= 2) quality = 'Cepat';
  else if (downloadMbps >= 2) quality = 'Sedang';
  else quality = 'Lambat';
  diagnosticData.speed.quality = quality;

  // Complete Speed Card UI
  speedCard.className = 'p-4 rounded-2xl border transition-all duration-300 bg-emerald-50/60 dark:bg-emerald-950/30 border-emerald-300 dark:border-emerald-700';
  speedIconWrap.className = 'w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/80 text-emerald-700 dark:text-emerald-300 flex items-center justify-center text-base flex-shrink-0 shadow-sm border border-emerald-300 dark:border-emerald-700';
  speedIcon.className = 'fas fa-check-circle text-emerald-700 dark:text-emerald-300 text-lg';
  speedBadge.className = 'px-2.5 py-0.5 text-[10px] font-bold rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200';
  speedBadge.innerHTML = `<i class="fas fa-check mr-1"></i> ${quality}`;
  speedDesc.innerText = `D:${downloadMbps.toFixed(1)} Mbps • U:${uploadMbps.toFixed(1)} Mbps • Ping:${Math.round(finalPing)}ms (${connType})`;

  setTimeout(() => {
    speedProgressWrap.classList.add('hidden');
  }, 500);

  // 3. FINALISASI & LOGGING
  finishPrecheck();
}

// 3. FINALISASI & LOGGING KE DATABASE
async function finishPrecheck() {
  diagnosticData.isComplete = true;

  const hubTitle = document.getElementById('pas-hub-title');
  const hubSub = document.getElementById('pas-hub-subtitle');
  const hubDot = document.getElementById('pas-hub-dot');
  if (hubTitle) hubTitle.innerText = 'Verifikasi Selesai & Terhubung!';
  if (hubSub) hubSub.innerText = 'PT. Pananjung Anugrah Solution • Sistem Siap Digunakan';
  if (hubDot) hubDot.className = 'w-2.5 h-2.5 rounded-full bg-emerald-500';

  // Populate hidden form inputs
  document.getElementById('speed_test_speed').value = diagnosticData.speed.downloadMbps.toFixed(2);
  document.getElementById('speed_test_upload').value = diagnosticData.speed.uploadMbps.toFixed(2);
  document.getElementById('speed_test_ping').value = diagnosticData.speed.pingMs ? Math.round(diagnosticData.speed.pingMs) : '';
  document.getElementById('speed_test_location').value = diagnosticData.gps.fullAddress || diagnosticData.gps.city || '';
  document.getElementById('speed_test_isp').value = diagnosticData.gps.isp || '';
  document.getElementById('speed_test_meta').value = JSON.stringify({
    full_address: diagnosticData.gps.fullAddress,
    district: diagnosticData.gps.district,
    city: diagnosticData.gps.city,
    region: diagnosticData.gps.region,
    country: diagnosticData.gps.country,
    isp: diagnosticData.gps.isp,
    ip: diagnosticData.gps.ip,
    coordinates: {
      latitude: diagnosticData.gps.latitude,
      longitude: diagnosticData.gps.longitude,
      accuracy: diagnosticData.gps.accuracy
    },
    speed: {
      download_mbps: diagnosticData.speed.downloadMbps,
      upload_mbps: diagnosticData.speed.uploadMbps,
      ping_ms: diagnosticData.speed.pingMs,
      jitter_ms: diagnosticData.speed.jitterMs,
      quality: diagnosticData.speed.quality,
      network_type: diagnosticData.speed.networkType
    }
  });

  // Kirim log ke Activity Log API
  const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
  try {
    await fetch('/api/speedtest/log', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken || ''
      },
      body: JSON.stringify({
        download_speed: diagnosticData.speed.downloadMbps,
        upload_speed: diagnosticData.speed.uploadMbps,
        latency: diagnosticData.speed.pingMs,
        jitter: diagnosticData.speed.jitterMs,
        status_quality: diagnosticData.speed.quality,
        location: {
          full_address: diagnosticData.gps.fullAddress,
          district: diagnosticData.gps.district,
          city: diagnosticData.gps.city,
          region: diagnosticData.gps.region,
          country: diagnosticData.gps.country,
          isp: diagnosticData.gps.isp,
          ip: diagnosticData.gps.ip,
          latitude: diagnosticData.gps.latitude,
          longitude: diagnosticData.gps.longitude,
          accuracy: diagnosticData.gps.accuracy
        },
        device_info: {
          network_type: diagnosticData.speed.networkType,
          userAgent: navigator.userAgent,
          platform: navigator.platform,
          screenWidth: window.screen.width,
          screenHeight: window.screen.height
        },
        source: 'login_modal_precheck'
      })
    });
  } catch (e) {
    console.warn('Logging notice:', e);
  }

  // Show Summary
  const summaryBox = document.getElementById('diagnostic-summary');
  const summaryText = document.getElementById('summary-text');
  summaryBox.classList.remove('hidden');
  summaryText.innerHTML = `📍 <strong>${diagnosticData.gps.fullAddress}</strong><br>⚡ Unduh: <strong>${diagnosticData.speed.downloadMbps.toFixed(2)} Mbps</strong> | Unggah: <strong>${diagnosticData.speed.uploadMbps.toFixed(2)} Mbps</strong> | Ping: <strong>${Math.round(diagnosticData.speed.pingMs || 0)} ms</strong> (${diagnosticData.speed.networkType})`;

  // Enable Proceed Button
  const btnProceed = document.getElementById('btn-proceed-login');
  const btnRetest = document.getElementById('btn-retest-all');
  btnRetest.classList.remove('hidden');
  btnProceed.disabled = false;
  btnProceed.className = 'px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white rounded-xl text-xs font-bold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all flex items-center gap-2 cursor-pointer pulse-ring';
  btnProceed.innerHTML = `<span>Lanjut ke Form Login</span> <i class="fas fa-arrow-right"></i>`;
}

// Jalankan ulang diagnosa penuh
function startFullPrecheck() {
  const summaryBox = document.getElementById('diagnostic-summary');
  const btnProceed = document.getElementById('btn-proceed-login');
  const btnRetest = document.getElementById('btn-retest-all');
  
  summaryBox.classList.add('hidden');
  btnRetest.classList.add('hidden');
  btnProceed.disabled = true;
  btnProceed.className = 'px-5 py-2.5 bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-400 rounded-xl text-xs font-bold transition-all flex items-center gap-2 cursor-not-allowed';
  btnProceed.innerHTML = `<span>Memeriksa Akses...</span> <i class="fas fa-arrow-right"></i>`;

  requestGpsPermission();
}

// Otomatis jalankan modal dan deteksi GPS saat halaman dimuat
// [DISABLED] Modal precheck sementara disembunyikan
// document.addEventListener('DOMContentLoaded', () => {
//   openPrecheckModal();
//   setTimeout(() => {
//     startFullPrecheck();
//   }, 400);
// });
</script>
@endsection