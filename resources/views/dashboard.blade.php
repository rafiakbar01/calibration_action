@extends('layouts.app')
@section('title', 'Dashboard')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.15/index.global.min.css" rel="stylesheet" />
<style>
    /* ============================================================
   DASHBOARD PREMIUM â€” Putih + Biru Muda Elegan
   ============================================================ */
    :root {
        --blue-1: #1e3a8a;
        --blue-2: #1d4ed8;
        --blue-3: #2563eb;
        --blue-4: #3b82f6;
        --blue-light: #eff6ff;
        --blue-pale: #dbeafe;
        --sky: #0ea5e9;
        --sky-light: #e0f2fe;
        --emerald: #10b981;
        --amber: #f59e0b;
        --rose: #f43f5e;
        --text-dark: #1e293b;
        --text-body: #475569;
        --text-muted: #94a3b8;
        --border: #e2e8f0;
        --bg-page: #f0f6ff;
        --white: #ffffff;
        --radius-xl: 20px;
        --radius-lg: 14px;
        --radius-md: 10px;
        --shadow-sm: 0 2px 8px rgba(37, 99, 235, .08);
        --shadow-md: 0 4px 20px rgba(37, 99, 235, .12);
        --shadow-lg: 0 10px 40px rgba(37, 99, 235, .15);
        --transition: all .28s cubic-bezier(.4, 0, .2, 1);
    }

    /* ===== HERO ===== */
    .hero-welcome {
        background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 55%, #3b82f6 100%);
        border-radius: var(--radius-xl);
        padding: 2.5rem 2.75rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(37, 99, 235, .3);
    }

    .hero-welcome::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 260px;
        height: 260px;
        background: radial-gradient(circle, rgba(255, 255, 255, .12) 0%, transparent 70%);
        pointer-events: none;
    }

    .hero-welcome::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: 25%;
        width: 180px;
        height: 180px;
        background: radial-gradient(circle, rgba(255, 255, 255, .07) 0%, transparent 70%);
        pointer-events: none;
    }

    .hero-avatar {
        width: 88px;
        height: 88px;
        border-radius: 50%;
        border: 3px solid rgba(255, 255, 255, .8);
        box-shadow: 0 0 0 6px rgba(255, 255, 255, .2), 0 8px 24px rgba(0, 0, 0, .2);
        object-fit: cover;
        flex-shrink: 0;
    }

    .hero-salam {
        font-size: .8rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, .75);
    }

    .hero-name {
        font-size: 1.9rem;
        font-weight: 800;
        color: #fff;
        line-height: 1.15;
    }

    .hero-quote {
        font-size: .87rem;
        font-style: italic;
        color: rgba(255, 255, 255, .75);
        max-width: 500px;
        line-height: 1.65;
    }

    .hero-badge {
        background: rgba(255, 255, 255, .18);
        border: 1px solid rgba(255, 255, 255, .35);
        color: #fff;
        border-radius: 50px;
        padding: .3rem .9rem;
        font-size: .78rem;
        font-weight: 600;
        letter-spacing: .4px;
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        backdrop-filter: blur(6px);
    }

    .hero-date-box {
        background: rgba(255, 255, 255, .15);
        border: 1px solid rgba(255, 255, 255, .25);
        border-radius: var(--radius-lg);
        padding: 1.1rem 1.5rem;
        text-align: center;
        backdrop-filter: blur(8px);
        min-width: 160px;
    }

    .hero-clock {
        font-size: 1.6rem;
        font-weight: 800;
        color: #fff;
        font-variant-numeric: tabular-nums;
        letter-spacing: 2px;
    }

    .hero-date-label {
        font-size: .75rem;
        color: rgba(255, 255, 255, .7);
        margin-top: .25rem;
    }

    /* ===== STAT CARDS ===== */
    .stat-card {
        background: var(--white);
        border-radius: var(--radius-xl);
        border: 1px solid var(--border);
        padding: 1.75rem;
        position: relative;
        overflow: hidden;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
        text-decoration: none;
        display: block;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        text-decoration: none;
        border-color: transparent;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        border-radius: var(--radius-xl) var(--radius-xl) 0 0;
    }

    .stat-card.blue::before {
        background: linear-gradient(90deg, #1d4ed8, #60a5fa);
    }

    .stat-card.sky::before {
        background: linear-gradient(90deg, #0ea5e9, #38bdf8);
    }

    .stat-card.emerald::before {
        background: linear-gradient(90deg, #10b981, #34d399);
    }

    .stat-card.rose::before {
        background: linear-gradient(90deg, #f43f5e, #fb7185);
    }

    .stat-card.amber::before {
        background: linear-gradient(90deg, #f59e0b, #fbbf24);
    }

    .stat-bg-circle {
        position: absolute;
        bottom: -25px;
        right: -25px;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        opacity: .06;
    }

    .stat-card.blue .stat-bg-circle {
        background: #1d4ed8;
    }

    .stat-card.sky .stat-bg-circle {
        background: #0ea5e9;
    }

    .stat-card.emerald .stat-bg-circle {
        background: #10b981;
    }

    .stat-card.rose .stat-bg-circle {
        background: #f43f5e;
    }

    .stat-card.amber .stat-bg-circle {
        background: #f59e0b;
    }

    .stat-icon-wrap {
        width: 54px;
        height: 54px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        margin-bottom: .9rem;
    }

    .stat-card.blue .stat-icon-wrap {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .stat-card.sky .stat-icon-wrap {
        background: #e0f2fe;
        color: #0284c7;
    }

    .stat-card.emerald .stat-icon-wrap {
        background: #d1fae5;
        color: #059669;
    }

    .stat-card.rose .stat-icon-wrap {
        background: #ffe4e6;
        color: #e11d48;
    }

    .stat-card.amber .stat-icon-wrap {
        background: #fef3c7;
        color: #d97706;
    }

    .stat-number {
        font-size: 2.6rem;
        font-weight: 800;
        line-height: 1;
        color: var(--text-dark);
        font-variant-numeric: tabular-nums;
    }

    .stat-card.blue .stat-number {
        color: #1d4ed8;
    }

    .stat-card.sky .stat-number {
        color: #0284c7;
    }

    .stat-card.emerald .stat-number {
        color: #059669;
    }

    .stat-card.rose .stat-number {
        color: #e11d48;
    }

    .stat-card.amber .stat-number {
        color: #d97706;
    }

    .stat-label {
        font-size: .8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: var(--text-muted);
        margin-top: .35rem;
    }

    .stat-trend {
        font-size: .78rem;
        color: var(--text-muted);
        margin-top: .5rem;
        display: flex;
        align-items: center;
        gap: .3rem;
    }

    /* ===== SECTION LABEL ===== */
    .section-label {
        font-size: .7rem;
        font-weight: 800;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--blue-3);
        display: flex;
        align-items: center;
        gap: .75rem;
        margin-bottom: 1.1rem;
    }

    .section-label::after {
        content: '';
        flex: 1;
        height: 1.5px;
        background: linear-gradient(90deg, var(--blue-pale), transparent);
    }

    /* ===== LIST CARDS ===== */
    .list-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        height: 100%;
    }

    .list-card:hover {
        box-shadow: var(--shadow-md);
    }

    .list-card-header {
        padding: 1.1rem 1.4rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid var(--border);
    }

    .list-card-header .title {
        font-size: .88rem;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: .55rem;
    }

    .list-card-header .icon-hd {
        font-size: 1rem;
    }

    .count-badge {
        border-radius: 50px;
        padding: .2rem .7rem;
        font-size: .76rem;
        font-weight: 700;
    }

    .lc-amber .list-card-header {
        background: linear-gradient(135deg, #fef3c7, #fffbeb);
    }

    .lc-blue .list-card-header {
        background: linear-gradient(135deg, #dbeafe, #eff6ff);
    }

    .lc-emerald .list-card-header {
        background: linear-gradient(135deg, #d1fae5, #f0fdf4);
    }

    .lc-rose .list-card-header {
        background: linear-gradient(135deg, #ffe4e6, #fff1f2);
    }

    .lc-amber .icon-hd {
        color: #d97706;
    }

    .lc-blue .icon-hd {
        color: #2563eb;
    }

    .lc-emerald .icon-hd {
        color: #059669;
    }

    .lc-rose .icon-hd {
        color: #e11d48;
    }

    .lc-amber .count-badge {
        background: #fef3c7;
        color: #d97706;
    }

    .lc-blue .count-badge {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .lc-emerald .count-badge {
        background: #d1fae5;
        color: #059669;
    }

    .lc-rose .count-badge {
        background: #ffe4e6;
        color: #e11d48;
    }

    .list-scroll {
        max-height: 280px;
        overflow-y: auto;
    }

    .list-scroll::-webkit-scrollbar {
        width: 4px;
    }

    .list-scroll::-webkit-scrollbar-track {
        background: #f8fafc;
    }

    .list-scroll::-webkit-scrollbar-thumb {
        background: #bfdbfe;
        border-radius: 4px;
    }

    .cal-item {
        display: flex;
        align-items: center;
        gap: .8rem;
        padding: .8rem 1.2rem;
        border-bottom: 1px solid #f1f5f9;
        transition: var(--transition);
        text-decoration: none;
    }

    .cal-item:last-child {
        border-bottom: none;
    }

    .cal-item:hover {
        background: #f8fbff;
        text-decoration: none;
    }

    .cal-item-dot {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .85rem;
        flex-shrink: 0;
    }

    .lc-amber .cal-item-dot {
        background: #fef3c7;
        color: #d97706;
    }

    .lc-blue .cal-item-dot {
        background: #dbeafe;
        color: #2563eb;
    }

    .lc-emerald .cal-item-dot {
        background: #d1fae5;
        color: #059669;
    }

    .lc-rose .cal-item-dot {
        background: #ffe4e6;
        color: #e11d48;
    }

    .cal-item-name {
        font-size: .86rem;
        font-weight: 600;
        color: var(--text-dark);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 140px;
    }

    .cal-item-meta {
        font-size: .74rem;
        color: var(--text-muted);
    }

    .cal-item-time {
        font-size: .74rem;
        color: var(--text-muted);
        margin-left: auto;
        white-space: nowrap;
    }

    .empty-list {
        padding: 2.5rem 1rem;
        text-align: center;
    }

    .empty-list i {
        font-size: 2.2rem;
        opacity: .2;
        margin-bottom: .6rem;
        color: var(--blue-3);
        display: block;
    }

    .empty-list p {
        font-size: .83rem;
        color: var(--text-muted);
    }

    .list-card-footer {
        padding: .8rem 1.2rem;
        border-top: 1px solid var(--border);
        background: #fafbff;
    }

    .btn-list-more {
        display: block;
        width: 100%;
        text-align: center;
        padding: .45rem;
        border-radius: var(--radius-md);
        font-size: .8rem;
        font-weight: 600;
        transition: var(--transition);
        text-decoration: none;
        background: transparent;
        border: 1px solid var(--border);
        color: var(--text-muted);
    }

    .btn-list-more:hover {
        text-decoration: none;
        background: var(--white);
    }

    .lc-amber .btn-list-more:hover {
        color: #d97706;
        border-color: #fde68a;
    }

    .lc-blue .btn-list-more:hover {
        color: #2563eb;
        border-color: #93c5fd;
    }

    .lc-emerald .btn-list-more:hover {
        color: #059669;
        border-color: #6ee7b7;
    }

    .lc-rose .btn-list-more:hover {
        color: #e11d48;
        border-color: #fda4af;
    }

    /* ===== GLASS CARD (bottom) ===== */
    .white-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .white-card-header {
        padding: 1.1rem 1.4rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: .6rem;
        font-size: .9rem;
        font-weight: 700;
        color: var(--text-dark);
        background: linear-gradient(135deg, #f0f6ff, #fff);
    }

    .white-card-header i {
        color: var(--blue-3);
    }

    /* Status sistem */
    .sys-item {
        display: flex;
        align-items: center;
        gap: .9rem;
        padding: .85rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .sys-item:last-child {
        border-bottom: none;
    }

    .sys-item-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .95rem;
        flex-shrink: 0;
    }

    .sys-item-label {
        font-size: .76rem;
        color: var(--text-muted);
    }

    .sys-item-value {
        font-size: .9rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    /* Quick actions */
    .qa-btn {
        display: flex;
        align-items: center;
        gap: .85rem;
        padding: .9rem 1.1rem;
        border-radius: var(--radius-md);
        border: 1px solid var(--border);
        background: #fafbff;
        color: var(--text-body);
        font-size: .87rem;
        font-weight: 600;
        transition: var(--transition);
        text-decoration: none;
        margin-bottom: .6rem;
    }

    .qa-btn:last-child {
        margin-bottom: 0;
    }

    .qa-btn:hover {
        background: var(--white);
        text-decoration: none;
        transform: translateX(4px);
        box-shadow: var(--shadow-md);
        color: var(--text-dark);
    }

    .qa-btn .qa-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .95rem;
        flex-shrink: 0;
    }

    .qa-btn.primary {
        border-color: #bfdbfe;
    }

    .qa-btn.primary .qa-icon {
        background: #dbeafe;
        color: #2563eb;
    }

    .qa-btn.primary:hover {
        border-color: #93c5fd;
        color: #1d4ed8;
    }

    .qa-btn.secondary .qa-icon {
        background: #e0f2fe;
        color: #0284c7;
    }

    .qa-btn.secondary:hover {
        border-color: #7dd3fc;
        color: #0284c7;
    }

    .qa-btn.file .qa-icon {
        background: #d1fae5;
        color: #059669;
    }

    .qa-btn.file:hover {
        border-color: #6ee7b7;
        color: #059669;
    }

    .qa-chevron {
        margin-left: auto;
        color: var(--text-muted);
        font-size: .78rem;
        transition: var(--transition);
    }

    .qa-btn:hover .qa-chevron {
        color: inherit;
        transform: translateX(3px);
    }

    /* ===== CALENDAR ===== */
    .calendar-card {
        background: var(--white);
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .calendar-card-header {
        padding: 1.1rem 1.6rem;
        background: linear-gradient(135deg, #eff6ff, #fff);
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .calendar-card-header .title {
        font-size: .92rem;
        font-weight: 700;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: .55rem;
    }

    .calendar-card-header .title i {
        color: var(--blue-3);
    }

    .calendar-card-body {
        padding: 1.25rem 1.5rem;
    }

    /* FullCalendar overrides */
    .fc {
        font-family: 'Inter', sans-serif;
    }

    .fc-toolbar-title {
        font-size: 1rem !important;
        font-weight: 700 !important;
        color: var(--text-dark) !important;
    }

    .fc-button-primary {
        background: #eff6ff !important;
        border: 1px solid #bfdbfe !important;
        color: #2563eb !important;
        border-radius: var(--radius-md) !important;
        font-weight: 600 !important;
        font-size: .8rem !important;
        transition: var(--transition) !important;
        box-shadow: none !important;
    }

    .fc-button-primary:hover,
    .fc-button-primary:focus {
        background: #dbeafe !important;
        border-color: #93c5fd !important;
        color: #1d4ed8 !important;
        box-shadow: none !important;
    }

    .fc-button-primary:not(:disabled).fc-button-active {
        background: #2563eb !important;
        border-color: #2563eb !important;
        color: #fff !important;
    }

    .fc-theme-standard td,
    .fc-theme-standard th,
    .fc-theme-standard .fc-scrollgrid {
        border-color: #f1f5f9 !important;
    }

    .fc-col-header-cell-cushion {
        color: #64748b !important;
        font-size: .76rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        text-decoration: none !important;
    }

    .fc-daygrid-day-number {
        color: #475569 !important;
        font-size: .82rem;
        font-weight: 500;
        text-decoration: none !important;
    }

    .fc-day-today {
        background: #eff6ff !important;
    }

    .fc-day-today .fc-daygrid-day-number {
        background: linear-gradient(135deg, #2563eb, #3b82f6) !important;
        color: #fff !important;
        border-radius: 50% !important;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800 !important;
        box-shadow: 0 4px 12px rgba(37, 99, 235, .35) !important;
    }

    .fc-event {
        border-radius: 6px !important;
        border: none !important;
        padding: 2px 6px !important;
        font-size: .75rem !important;
        font-weight: 600 !important;
        transition: var(--transition) !important;
    }

    .fc-event:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, .15) !important;
    }

    .fc-more-link {
        color: #2563eb !important;
        font-weight: 700 !important;
        font-size: .75rem !important;
    }

    .fc-more-popover {
        background: #fff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: var(--radius-lg) !important;
        box-shadow: 0 20px 60px rgba(37, 99, 235, .15) !important;
        max-height: 380px !important;
        display: flex !important;
        flex-direction: column !important;
        overflow: hidden !important;
        z-index: 9999 !important;
    }

    .fc-more-popover .fc-popover-header {
        background: #eff6ff !important;
        color: #1e3a8a !important;
        border-radius: var(--radius-lg) var(--radius-lg) 0 0 !important;
        flex-shrink: 0 !important;
    }

    .fc-more-popover .fc-popover-body {
        overflow-y: auto !important;
        max-height: 320px !important;
        flex-grow: 1 !important;
        padding: 8px !important;
        overscroll-behavior: contain;
    }

    /* Scrollbar halus */
    .fc-more-popover .fc-popover-body::-webkit-scrollbar {
        width: 6px;
    }

    .fc-more-popover .fc-popover-body::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }

    .fc-more-popover .fc-popover-body::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }

    .fc-more-popover .fc-popover-body::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* ===== PULSE DOT ===== */
    .pulse-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #10b981;
        display: inline-block;
        position: relative;
    }

    .pulse-dot::after {
        content: '';
        position: absolute;
        top: -4px;
        left: -4px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: rgba(16, 185, 129, .3);
        animation: pulse 1.8s ease-in-out infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
            opacity: .8;
        }

        50% {
            transform: scale(1.5);
            opacity: 0;
        }
    }

    /* Counter anim */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-number {
        animation: fadeUp .5s ease forwards;
        opacity: 0;
    }

    .stat-card:nth-child(1) .stat-number {
        animation-delay: .05s;
    }

    .stat-card:nth-child(2) .stat-number {
        animation-delay: .15s;
    }

    .stat-card:nth-child(3) .stat-number {
        animation-delay: .25s;
    }

    .stat-card:nth-child(4) .stat-number {
        animation-delay: .35s;
    }

    .mb-28 {
        margin-bottom: 1.75rem;
    }
</style>
@endpush

@section('content')
@php
use Carbon\Carbon;
use App\Models\Calibration;

$user = auth()->user();
$isTeknisi = ($user->role == 'teknisi');
$userName = $user->nama; // nama teknisi untuk filter calibratedBy

// Query dasar: untuk teknisi difilter berdasarkan calibratedBy
$baseQuery = Calibration::query();
if ($isTeknisi) {
$baseQuery->where('calibratedBy', $userName);
}

$todayCount = (clone $baseQuery)->whereDate('created_at', Carbon::today())->count();
$waiting = (clone $baseQuery)->where('status', 'waiting_verification')->latest()->get();
$approved = (clone $baseQuery)->where('status', 'approved')->latest()->get();
$rejected = (clone $baseQuery)->where('status', 'rejected')->latest()->get();
$verified = (clone $baseQuery)->where('status', 'verified')->latest()->get();

$totalWaiting = $waiting->count();
$totalApproved = $approved->count();
$totalVerified = $verified->count();
$totalRejected = $rejected->count();

// Untuk kalender: ambil semua data (tanpa filter status) yang sudah difilter teknisi
$allCalibrations = (clone $baseQuery)->get();

// Helper fungsi warna status untuk kalender
if (!function_exists('getEventColor')) {
function getEventColor($status) {
switch ($status) {
case 'waiting_verification': return '#f59e0b'; // amber
case 'verified': return '#2563eb'; // blue
case 'approved': return '#10b981'; // emerald
case 'rejected': return '#f43f5e'; // rose
default: return '#6b7280';
}
}
}

if (!function_exists('getCertNumber')) {
function getCertNumber($cal) {
$str = $cal->id ?? $cal->certificate_id ?? '';
if (preg_match('/PAS-(\d+)/i', $str, $matches)) {
return str_pad($matches[1], 6, '0', STR_PAD_LEFT);
}
return '';
}
}

if (!function_exists('formatCalItemTitle')) {
function formatCalItemTitle($cal) {
$num = getCertNumber($cal);
$pt = !empty($cal->pemilikAlat) ? $cal->pemilikAlat : (!empty($cal->lokasiPT) ? $cal->lokasiPT : '-');
$namaAlat = $cal->namaAlat ?? '-';

if (!empty($num)) {
return "{$num} - {$pt} - {$namaAlat}";
}
return "{$pt} - {$namaAlat}";
}
}

$calendarEvents = [];
foreach ($allCalibrations as $cal) {
$calendarEvents[] = [
'title' => $cal->namaAlat,
'start' => $cal->created_at->format('Y-m-d'),
'url' => route('calibrations.show', $cal->id),
'color' => getEventColor($cal->status),
];
}

$now = now()->timezone('Asia/Jakarta');
$jam = $now->hour;

if ($jam >= 5 && $jam < 11) {
    $salam='Selamat Pagi' ;
    $quotes=[ 'Awali hari dengan penuh semangat dan dedikasi yang tinggi.' , 'Pagi yang baik untuk memberi hasil terbaik dalam setiap tugas.' , 'Mari sambut hari baru dengan energi optimal dan fokus penuh.' ,
    ];
    } elseif ($jam>= 11 && $jam < 15) {
        $salam='Selamat Siang' ;
        $quotes=[ 'Tetap fokus dan jaga konsistensi kerja di tengah hari.' , 'Semoga segala pekerjaan hari ini berjalan lancar.' , 'Terus bekerja dengan penuh integritas dan semangat.' ,
        ];
        } elseif ($jam>= 15 && $jam < 18) {
            $salam='Selamat Sore' ;
            $quotes=[ 'Segera tuntaskan sisa tugas dengan penuh semangat.' , 'Hampir selesai â€” tutup hari ini dengan pencapaian terbaik.' ,
            ];
            } else {
            $salam='Selamat Malam' ;
            $quotes=[ 'Terima kasih atas kerja keras hari ini. Istirahat dengan baik.' , 'Pulihkan tenaga untuk hari esok yang lebih produktif.' ,
            ];
            }
            $quote=$quotes[array_rand($quotes)];
            @endphp

            {{-- ===== HERO ===== --}}
            <div class="hero-welcome mb-28">
            <div class="d-flex align-items-center flex-wrap" style="gap:1.5rem; position:relative; z-index:1;">
                @if(auth()->user()->foto)
                <img src="{{ asset('profile_foto/' . auth()->user()->foto) }}" class="hero-avatar"
                    alt="{{ auth()->user()->nama }}"
                    onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=1d4ed8&color=fff&bold=true&size=128'">
                @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama ?? 'User') }}&background=1d4ed8&color=fff&bold=true&size=128"
                    class="hero-avatar" alt="Avatar">
                @endif

                <div style="flex:1; min-width:200px;">
                    <div class="hero-badge mb-2">
                        <i class="fas fa-star" style="font-size:.7rem;"></i>
                        {!! roleBadge() !!}
                    </div>
                    <div class="hero-salam">{{ $salam }}</div>
                    <div class="hero-name">{{ auth()->user()->nama ?? 'User' }} ðŸ‘‹</div>
                    <div class="hero-quote mt-2">
                        <i class="fas fa-quote-left mr-1" style="font-size:.7rem; opacity:.6;"></i>
                        {{ $quote }}
                        <i class="fas fa-quote-right ml-1" style="font-size:.7rem; opacity:.6;"></i>
                    </div>
                </div>

                <div class="hero-date-box ml-auto" style="flex-shrink:0;">
                    <div class="hero-clock" id="heroClock">--:--:--</div>
                    <div class="hero-date-label">
                        <i class="fas fa-clock mr-1"></i> WIB
                    </div>
                    <div class="hero-date-label" style="margin-top:.2rem;">{{ $now->translatedFormat('l, d M Y') }}</div>
                </div>
            </div>
            </div>

            {{-- ===== AKSI CEPAT ===== --}}
            <div class="section-label">Aksi Cepat</div>
            <div class="row mb-28" style="row-gap:1rem;">
                @php
                $colClass = (auth()->user()->role == 'teknisi') ? 'col-12 col-md-6' : 'col-12 col-md-4';
                @endphp
                <div class="{{ $colClass }}">
                    <a href="{{ route('calibrations.create') }}" class="qa-btn primary" style="height: 100%; margin-bottom: 0;">
                        <div class="qa-icon"><i class="fas fa-plus-circle"></i></div>
                        <div>
                            <div style="font-size:.87rem; font-weight:700; color:#2563eb;">Input Kalibrasi Baru</div>
                            <div style="font-size:.74rem; color:#94a3b8;">Tambahkan data kalibrasi</div>
                        </div>
                        <i class="fas fa-chevron-right qa-chevron"></i>
                    </a>
                </div>
                <div class="{{ $colClass }}">
                    <a href="{{ route('calibrations.index') }}" class="qa-btn secondary" style="height: 100%; margin-bottom: 0;">
                        <div class="qa-icon"><i class="fas fa-list-alt"></i></div>
                        <div>
                            <div style="font-size:.87rem; font-weight:700;">Daftar Kalibrasi</div>
                            <div style="font-size:.74rem; color:#94a3b8;">Lihat semua data</div>
                        </div>
                        <i class="fas fa-chevron-right qa-chevron"></i>
                    </a>
                </div>
                @if(auth()->user()->role != 'teknisi')
                <div class="{{ $colClass }}">
                    <a href="{{ route('sertifikat-kalibrasi.index') }}" class="qa-btn file" style="height: 100%; margin-bottom: 0;">
                        <div class="qa-icon"><i class="fas fa-file-excel"></i></div>
                        <div>
                            <div style="font-size:.87rem; font-weight:700;">File Sertifikat Digital</div>
                            <div style="font-size:.74rem; color:#94a3b8;">Lihat Semua Data</div>
                        </div>
                        <i class="fas fa-chevron-right qa-chevron"></i>
                    </a>
                </div>
                @endif
            </div>

            {{-- ===== STAT CARDS ===== --}}
            <div class="section-label">Ringkasan Status Kalibrasi</div>
            <div class="row mb-28" style="row-gap:1rem;">
                @php
                $usrRole = auth()->user()->role;
                // Kita juga tambahkan role 'admin' jika ada, sebagai admin super
                $isAdmin = in_array($usrRole, ['superadmin', 'super admin', 'admin']);

                $canSeeWaiting = $isAdmin || $usrRole == 'checker';
                $canSeeVerified = $isAdmin || $usrRole == 'approver';
                $canSeeApproved = $isAdmin;
                $canSeeRejected = $isAdmin || $usrRole == 'checker';
                @endphp

                <div class="col-6 col-lg-3">
                    <a {!! $canSeeWaiting ? 'href="' .route('calibrations.index').'?status=waiting_verification"' : 'style="cursor:default;"' !!} class="stat-card amber">
                        <div class="stat-bg-circle"></div>
                        <div class="stat-icon-wrap"><i class="fas fa-hourglass-half"></i></div>
                        <div class="stat-number" data-target="{{ $totalWaiting }}">{{ $totalWaiting }}</div>
                        <div class="stat-label">Menunggu Verifikasi</div>
                        @if($canSeeWaiting)
                        <div class="stat-trend"><i class="fas fa-arrow-right" style="font-size:.65rem;"></i> Lihat semua</div>
                        @endif
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a {!! $canSeeVerified ? 'href="' .route('calibrations.index').'?status=verified"' : 'style="cursor:default;"' !!} class="stat-card blue">
                        <div class="stat-bg-circle"></div>
                        <div class="stat-icon-wrap"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-number" data-target="{{ $totalVerified }}">{{ $totalVerified }}</div>
                        <div class="stat-label">Terverifikasi</div>
                        @if($canSeeVerified)
                        <div class="stat-trend"><i class="fas fa-arrow-right" style="font-size:.65rem;"></i> Lihat semua</div>
                        @endif
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a {!! $canSeeApproved ? 'href="' .route('calibrations.index').'?status=approved"' : 'style="cursor:default;"' !!} class="stat-card emerald">
                        <div class="stat-bg-circle"></div>
                        <div class="stat-icon-wrap"><i class="fas fa-stamp"></i></div>
                        <div class="stat-number" data-target="{{ $totalApproved }}">{{ $totalApproved }}</div>
                        <div class="stat-label">Disetujui</div>
                        @if($canSeeApproved)
                        <div class="stat-trend"><i class="fas fa-arrow-right" style="font-size:.65rem;"></i> Lihat semua</div>
                        @endif
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a {!! $canSeeRejected ? 'href="' .route('calibrations.index').'?status=rejected"' : 'style="cursor:default;"' !!} class="stat-card rose">
                        <div class="stat-bg-circle"></div>
                        <div class="stat-icon-wrap"><i class="fas fa-times-circle"></i></div>
                        <div class="stat-number" data-target="{{ $totalRejected }}">{{ $totalRejected }}</div>
                        <div class="stat-label">Ditolak</div>
                        @if($canSeeRejected)
                        <div class="stat-trend"><i class="fas fa-arrow-right" style="font-size:.65rem;"></i> Lihat semua</div>
                        @endif
                    </a>
                </div>
            </div>

            {{-- ===== LIST CARDS ===== --}}
            <div class="section-label">Data Terbaru per Status</div>
            <div class="row mb-28" style="row-gap:1rem;">

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="list-card lc-amber">
                        <div class="list-card-header">
                            <span class="title"><i class="fas fa-hourglass-half icon-hd"></i> Menunggu</span>
                            <span class="count-badge">{{ $totalWaiting }}</span>
                        </div>
                        <div class="list-scroll">
                            @forelse($waiting->take(8) as $cal)
                            <a href="{{ route('calibrations.show', $cal->id) }}" class="cal-item">
                                <div class="cal-item-dot"><i class="fas fa-tools" style="font-size:.8rem;"></i></div>
                                <div style="min-width:0;">
                                    <div class="cal-item-name" title="{{ formatCalItemTitle($cal) }}">{{ formatCalItemTitle($cal) }}</div>
                                    <div class="cal-item-meta">{{ $cal->NoSeri ?? '—' }} &middot; {{ $cal->brandAlat ?? '—' }}</div>
                                </div>
                                <span class="cal-item-time">{{ $cal->created_at->format('H:i') }}</span>
                            </a>
                            @empty
                            <div class="empty-list">
                                <i class="fas fa-inbox"></i>
                                <p>Tidak ada data</p>
                            </div>
                            @endforelse
                        </div>
                        <div class="list-card-footer">
                            <button type="button" class="btn-list-more" data-toggle="modal" data-target="#modalWaiting" style="width:100%; border-radius:var(--radius-md); padding:.45rem; cursor:pointer;">Lihat Semua &rarr;</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="list-card lc-blue">
                        <div class="list-card-header">
                            <span class="title"><i class="fas fa-check-circle icon-hd"></i> Verified</span>
                            <span class="count-badge">{{ $totalVerified }}</span>
                        </div>
                        <div class="list-scroll">
                            @forelse($verified->take(8) as $cal)
                            <a href="{{ route('calibrations.show', $cal->id) }}" class="cal-item">
                                <div class="cal-item-dot"><i class="fas fa-certificate" style="font-size:.8rem;"></i></div>
                                <div style="min-width:0;">
                                    <div class="cal-item-name" title="{{ formatCalItemTitle($cal) }}">{{ formatCalItemTitle($cal) }}</div>
                                    <div class="cal-item-meta">{{ $cal->NoSeri ?? '—' }} &middot; {{ $cal->brandAlat ?? '—' }}</div>
                                </div>
                                <span class="cal-item-time">{{ $cal->updated_at->format('H:i') }}</span>
                            </a>
                            @empty
                            <div class="empty-list">
                                <i class="fas fa-check-double"></i>
                                <p>Belum ada data</p>
                            </div>
                            @endforelse
                        </div>
                        <div class="list-card-footer">
                            <button type="button" class="btn-list-more" data-toggle="modal" data-target="#modalVerified" style="width:100%; border-radius:var(--radius-md); padding:.45rem; cursor:pointer;">Lihat Semua &rarr;</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="list-card lc-emerald">
                        <div class="list-card-header">
                            <span class="title"><i class="fas fa-stamp icon-hd"></i> Approved</span>
                            <span class="count-badge">{{ $totalApproved }}</span>
                        </div>
                        <div class="list-scroll">
                            @forelse($approved->take(8) as $cal)
                            <a href="{{ route('calibrations.show', $cal->id) }}" class="cal-item">
                                <div class="cal-item-dot"><i class="fas fa-check" style="font-size:.8rem;"></i></div>
                                <div style="min-width:0;">
                                    <div class="cal-item-name" title="{{ formatCalItemTitle($cal) }}">{{ formatCalItemTitle($cal) }}</div>
                                    <div class="cal-item-meta">{{ $cal->NoSeri ?? '—' }} &middot; {{ $cal->brandAlat ?? '—' }}</div>
                                </div>
                                <span class="cal-item-time">{{ $cal->updated_at->format('H:i') }}</span>
                            </a>
                            @empty
                            <div class="empty-list">
                                <i class="fas fa-thumbs-up"></i>
                                <p>Belum ada data</p>
                            </div>
                            @endforelse
                        </div>
                        <div class="list-card-footer">
                            <button type="button" class="btn-list-more" data-toggle="modal" data-target="#modalApproved" style="width:100%; border-radius:var(--radius-md); padding:.45rem; cursor:pointer;">Lihat Semua &rarr;</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="list-card lc-rose">
                        <div class="list-card-header">
                            <span class="title"><i class="fas fa-times-circle icon-hd"></i> Rejected</span>
                            <span class="count-badge">{{ $totalRejected }}</span>
                        </div>
                        <div class="list-scroll">
                            @forelse($rejected->take(8) as $cal)
                            <a href="{{ route('calibrations.show', $cal->id) }}" class="cal-item">
                                <div class="cal-item-dot"><i class="fas fa-ban" style="font-size:.8rem;"></i></div>
                                <div style="min-width:0;">
                                    <div class="cal-item-name" title="{{ formatCalItemTitle($cal) }}">{{ formatCalItemTitle($cal) }}</div>
                                    <div class="cal-item-meta">{{ $cal->NoSeri ?? '—' }} &middot; {{ $cal->brandAlat ?? '—' }}</div>
                                </div>
                                <span class="cal-item-time">{{ $cal->updated_at->format('H:i') }}</span>
                            </a>
                            @empty
                            <div class="empty-list">
                                <i class="fas fa-smile"></i>
                                <p>Tidak ada data</p>
                            </div>
                            @endforelse
                        </div>
                        <div class="list-card-footer">
                            <button type="button" class="btn-list-more" data-toggle="modal" data-target="#modalRejected" style="width:100%; border-radius:var(--radius-md); padding:.45rem; cursor:pointer;">Lihat Semua &rarr;</button>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ===== BOTTOM ROW ===== --}}
            <div class="section-label">Sistem &amp; Kalender</div>
            <div class="row" style="row-gap:1rem;">

                <div class="col-12 col-lg-4" style="display:flex; flex-direction:column; gap:1rem;">

                    {{-- Status Sistem --}}
                    <div class="white-card">
                        <div class="white-card-header">
                            <i class="fas fa-server"></i> Status Sistem
                        </div>
                        <div class="sys-item">
                            <div class="sys-item-icon" style="background:#d1fae5;">
                                <span class="pulse-dot"></span>
                            </div>
                            <div>
                                <div class="sys-item-label">Server Status</div>
                                <div class="sys-item-value" style="color:#059669;">Online</div>
                            </div>
                        </div>
                        <div class="sys-item">
                            <div class="sys-item-icon" style="background:#dbeafe; color:#2563eb;">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <div class="sys-item-label">Waktu Saat Ini (WIB)</div>
                                <div class="sys-item-value" id="sysTime">--:--:--</div>
                            </div>
                        </div>
                        <div class="sys-item">
                            <div class="sys-item-icon" style="background:#eff6ff; color:#2563eb;">
                                <i class="fas fa-calendar-day"></i>
                            </div>
                            <div>
                                <div class="sys-item-label">Tanggal Hari Ini</div>
                                <div class="sys-item-value">{{ $now->format('d F Y') }}</div>
                            </div>
                        </div>
                        <div class="sys-item">
                            <div class="sys-item-icon" style="background:#fef3c7; color:#d97706;">
                                <i class="fas fa-database"></i>
                            </div>
                            <div>
                                <div class="sys-item-label">Kalibrasi Hari Ini</div>
                                <div class="sys-item-value" style="color:#d97706;">{{ $todayCount }} data</div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Kalender --}}
                <div class="col-12 col-lg-8">
                    <div class="calendar-card" style="height:100%;">
                        <div class="calendar-card-header">
                            <span class="title"><i class="fas fa-calendar-alt"></i> Kalender Data Kalibrasi</span>
                            <span style="font-size:.78rem; color:#94a3b8;">{{ $now->translatedFormat('F Y') }}</span>
                        </div>
                        <div class="calendar-card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- MODALS UNTUK LIST SEMUA --}}
            @foreach([
            'waiting' => ['data' => $waiting, 'title' => 'Menunggu Verifikasi', 'icon' => 'fa-hourglass-half', 'theme' => 'amber'],
            'verified' => ['data' => $verified, 'title' => 'Terverifikasi', 'icon' => 'fa-check-circle', 'theme' => 'blue'],
            'approved' => ['data' => $approved, 'title' => 'Disetujui', 'icon' => 'fa-stamp', 'theme' => 'emerald'],
            'rejected' => ['data' => $rejected, 'title' => 'Ditolak', 'icon' => 'fa-times-circle', 'theme' => 'rose']
            ] as $id => $info)
            <div class="modal fade" id="modal{{ ucfirst($id) }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content" style="border-radius: var(--radius-xl); border: none; box-shadow: var(--shadow-lg);">
                        <div class="modal-header border-0 lc-{{ $info['theme'] }}" style="border-radius: var(--radius-xl) var(--radius-xl) 0 0; padding: 1.25rem 1.5rem; background: var(--bg-page);">
                            <h5 class="modal-title font-weight-bold" style="color: var(--text-dark); display: flex; align-items: center; gap: .75rem;">
                                <div class="cal-item-dot" style="width: 36px; height: 36px;">
                                    <i class="fas {{ $info['icon'] }}"></i>
                                </div>
                                {{ $info['title'] }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: var(--text-muted); opacity: .7; text-shadow: none;">
                                <span aria-hidden="true" style="font-size: 1.75rem;">&times;</span>
                            </button>
                        </div>

                        {{-- SEARCH INPUT INSIDE MODAL --}}
                        <div class="px-4 py-2 border-bottom" style="background: #f8fafc;">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text border-right-0" style="background: #fff; border-radius: var(--radius-md) 0 0 var(--radius-md); font-size: .85rem;"><i class="fas fa-search text-muted"></i></span>
                                </div>
                                <input type="text" class="form-control border-left-0 modal-search-input" data-target="#modal{{ ucfirst($id) }}" placeholder="Cari No. Cert, PT, atau Nama Alat..." style="border-radius: 0 var(--radius-md) var(--radius-md) 0; font-size: .88rem;">
                            </div>
                        </div>

                        <div class="modal-body p-0" style="max-height: 60vh;">
                            <div class="list-group list-group-flush">
                                @forelse($info['data'] as $cal)
                                <a href="{{ route('calibrations.show', $cal->id) }}" class="list-group-item list-group-item-action d-flex align-items-center lc-{{ $info['theme'] }}" style="gap: 1.25rem; padding: 1.1rem 1.5rem; border-color: #f1f5f9;">
                                    <div class="cal-item-dot">
                                        <i class="fas {{ $info['icon'] }}"></i>
                                    </div>
                                    <div style="flex: 1; min-width: 0;">
                                        <div class="font-weight-bold text-dark text-truncate" style="font-size: .95rem;">{{ formatCalItemTitle($cal) }}</div>
                                        <div class="text-muted small text-truncate" style="margin-top: .15rem;">
                                            <i class="fas fa-barcode mr-1 opacity-50"></i> {{ $cal->NoSeri ?? '—' }} &nbsp;|&nbsp;
                                            <i class="fas fa-industry mr-1 opacity-50"></i> {{ $cal->brandAlat ?? '—' }} &nbsp;|&nbsp;
                                            <i class="fas fa-building mr-1 opacity-50"></i> {{ $cal->pemilikAlat ?? '—' }}
                                        </div>
                                    </div>
                                    <div class="text-muted small text-right" style="white-space: nowrap;">
                                        <div class="font-weight-600 mb-1" style="color: var(--text-body);">{{ $cal->created_at->format('d M Y') }}</div>
                                        <div><i class="far fa-clock mr-1"></i> {{ $cal->created_at->format('H:i') }} WIB</div>
                                    </div>
                                </a>
                                @empty
                                <div class="p-5 text-center text-muted">
                                    <i class="fas {{ $info['icon'] }} fa-3x mb-3" style="opacity: 0.2; color: var(--blue-3);"></i>
                                    <p style="font-size: .9rem;">Belum ada data untuk status ini.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top: 1px solid var(--border); background: #fafbff; border-radius: 0 0 var(--radius-xl) var(--radius-xl);">
                            <button type="button" class="btn px-4 font-weight-bold" data-dismiss="modal" style="border-radius: var(--radius-md); background: #fff; border: 1px solid var(--border); color: var(--text-body);">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @endsection

            @push('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.15/index.global.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // 1. Clock & System Time (Resilient, direct timezone formatting)
                    function updateClock() {
                        try {
                            const options = {
                                timeZone: 'Asia/Jakarta',
                                hour: '2-digit',
                                minute: '2-digit',
                                second: '2-digit',
                                hour12: false
                            };
                            const formatter = new Intl.DateTimeFormat('en-US', options); // en-US guarantees HH:mm:ss with colon
                            const t = formatter.format(new Date());

                            const e1 = document.getElementById('heroClock');
                            const e2 = document.getElementById('sysTime');
                            if (e1) e1.textContent = t;
                            if (e2) e2.textContent = t;
                        } catch (error) {
                            console.error('Error updating clock:', error);
                        }
                    }
                    updateClock();
                    setInterval(updateClock, 1000);

                    // 2. Counter animation
                    try {
                        document.querySelectorAll('.stat-number[data-target]').forEach(function(el) {
                            const target = parseInt(el.getAttribute('data-target'), 10);
                            if (target === 0) {
                                el.style.opacity = 1;
                                return;
                            }
                            let cur = 0;
                            const step = Math.max(1, Math.ceil(target / 25));
                            const timer = setInterval(function() {
                                cur += step;
                                if (cur >= target) {
                                    cur = target;
                                    clearInterval(timer);
                                }
                                el.textContent = cur;
                            }, 45);
                        });
                    } catch (error) {
                        console.error('Error starting counter animation:', error);
                    }

                    // 3. FullCalendar (Resilient to library loading failures)
                    if (typeof FullCalendar !== 'undefined') {
                        try {
                            var calendarEl = document.getElementById('calendar');
                            if (calendarEl) {
                                var calendar = new FullCalendar.Calendar(calendarEl, {
                                    initialView: 'dayGridMonth',
                                    height: 'auto',
                                    headerToolbar: {
                                        left: 'prev,next today',
                                        center: 'title',
                                        right: ''
                                    },
                                    events: @json($calendarEvents),
                                    eventClick: function(info) {
                                        info.jsEvent.preventDefault();
                                        if (info.event.url) window.location.href = info.event.url;
                                    },
                                    dayMaxEvents: 3,
                                    moreLinkClick: 'popover',
                                    locale: 'id',
                                });
                                calendar.render();
                            }
                        } catch (error) {
                            console.error('Error initializing FullCalendar:', error);
                        }
                    } else {
                        console.warn('FullCalendar library not loaded. Calendar will not be displayed.');
                        var calendarEl = document.getElementById('calendar');
                        if (calendarEl) {
                            calendarEl.innerHTML = '<div class="alert alert-warning text-center small"><i class="fas fa-exclamation-triangle mr-1"></i> Gagal memuat library Kalender. Hubungkan perangkat ke internet atau refresh halaman.</div>';
                        }
                    }

                    // 4. Modal Realtime Search Filter
                    if (typeof $ !== 'undefined') {
                        $(document).on('keyup input', '.modal-search-input', function() {
                            const query = $(this).val().toLowerCase().trim();
                            const targetModal = $(this).data('target');
                            const $modal = $(targetModal);

                            if (!$modal.length) return;

                            $modal.find('.list-group-item').each(function() {
                                const text = $(this).text().toLowerCase();
                                if (!query || text.includes(query)) {
                                    $(this).removeClass('d-none').addClass('d-flex');
                                } else {
                                    $(this).removeClass('d-flex').addClass('d-none');
                                }
                            });
                        });

                        $('.modal').on('hidden.bs.modal', function() {
                            $(this).find('.modal-search-input').val('');
                            $(this).find('.list-group-item').removeClass('d-none').addClass('d-flex');
                        });
                    }
                });
            </script>
            @endpush