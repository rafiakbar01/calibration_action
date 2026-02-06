@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $document->title }}</h1>
            <div class="flex items-center space-x-2 mt-2">
                <span class="px-3 py-1 rounded-full text-sm font-medium
                    @if($document->status == 'draft') bg-gray-100 text-gray-800
                    @elseif($document->status == 'verified') bg-yellow-100 text-yellow-800
                    @elseif($document->status == 'approved') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800 @endif">
                    {{ strtoupper($document->status) }}
                </span>
                <span class="text-sm text-gray-600">
                    Dibuat oleh {{ $document->creator->name }} • 
                    {{ $document->created_at->format('d M Y H:i') }}
                </span>
            </div>
        </div>
        
        <div class="flex space-x-2">
            @if($document->status == 'draft')
                <a href="{{ route('documents.edit', $document) }}" 
                   class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Edit
                </a>
                @can('verify', $document)
                <form action="{{ route('documents.verify', $document) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700">
                        Verify
                    </button>
                </form>
                @endcan
            @endif
            
            @if($document->status == 'verified')
                @can('approve', $document)
                <form action="{{ route('documents.approve', $document) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Approve
                    </button>
                </form>
                @endcan
                
                <button type="button" onclick="showRejectModal()"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Reject
                </button>
            @endif
            
            <a href="{{ route('documents.logs', $document) }}" 
               class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                <i class="fas fa-history mr-2"></i>Full Log
            </a>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Konten Dokumen -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Konten</h2>
                <div class="prose max-w-none">
                    {!! nl2br(e($document->content)) !!}
                </div>
            </div>
            
            <!-- Timeline Log (Singkat) -->
            <div class="mt-6 bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Aktivitas Terakhir</h2>
                    <a href="{{ route('documents.logs', $document) }}" 
                       class="text-sm text-blue-600 hover:text-blue-800">
                        Lihat semua
                    </a>
                </div>
                
                @include('components.log-timeline', [
                    'logs' => $document->activityLogs->take(5)
                ])
            </div>
        </div>
        
        <!-- Sidebar Info -->
        <div class="space-y-6">
            <!-- Info Dokumen -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Informasi Dokumen</h2>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Dibuat oleh</dt>
                        <dd class="text-sm text-gray-900">{{ $document->creator->name }}</dd>
                        <dd class="text-xs text-gray-500">{{ $document->created_at->format('d M Y H:i') }}</dd>
                    </div>
                    
                    @if($document->verified_by)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Diverifikasi oleh</dt>
                        <dd class="text-sm text-gray-900">{{ $document->verifier->name }}</dd>
                        <dd class="text-xs text-gray-500">{{ $document->verified_at->format('d M Y H:i') }}</dd>
                    </div>
                    @endif
                    
                    @if($document->approved_by)
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Disetujui oleh</dt>
                        <dd class="text-sm text-gray-900">{{ $document->approver->name }}</dd>
                        <dd class="text-xs text-gray-500">{{ $document->approved_at->format('d M Y H:i') }}</dd>
                    </div>
                    @endif
                </dl>
            </div>
            
            <!-- Filter Log -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-lg font-semibold mb-4">Filter Log Aktivitas</h2>
                <div class="space-y-2">
                    <a href="{{ route('documents.logs', $document) }}" 
                       class="block px-3 py-2 rounded hover:bg-gray-100 
                              {{ !request()->has('type') ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        Semua Aktivitas
                    </a>
                    <a href="{{ route('documents.logs', ['document' => $document, 'type' => 'create']) }}" 
                       class="block px-3 py-2 rounded hover:bg-gray-100 
                              {{ request('type') == 'create' ? 'bg-green-50 text-green-700' : 'text-gray-700' }}">
                        <i class="fas fa-plus mr-2"></i>Pembuatan
                    </a>
                    <a href="{{ route('documents.logs', ['document' => $document, 'type' => 'update']) }}" 
                       class="block px-3 py-2 rounded hover:bg-gray-100 
                              {{ request('type') == 'update' ? 'bg-blue-50 text-blue-700' : 'text-gray-700' }}">
                        <i class="fas fa-edit mr-2"></i>Perubahan
                    </a>
                    <a href="{{ route('documents.logs', ['document' => $document, 'type' => 'verify']) }}" 
                       class="block px-3 py-2 rounded hover:bg-gray-100 
                              {{ request('type') == 'verify' ? 'bg-yellow-50 text-yellow-700' : 'text-gray-700' }}">
                        <i class="fas fa-check-circle mr-2"></i>Verifikasi
                    </a>
                    <a href="{{ route('documents.logs', ['document' => $document, 'type' => 'approve']) }}" 
                       class="block px-3 py-2 rounded hover:bg-gray-100 
                              {{ request('type') == 'approve' ? 'bg-purple-50 text-purple-700' : 'text-gray-700' }}">
                        <i class="fas fa-thumbs-up mr-2"></i>Persetujuan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Reject -->
<div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <form action="{{ route('documents.reject', $document) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="rejection_reason">
                    Alasan Penolakan
                </label>
                <textarea name="rejection_reason" id="rejection_reason" 
                          rows="4" class="w-full px-3 py-2 border rounded" required></textarea>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="hideRejectModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Batal
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                    Tolak Dokumen
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showRejectModal() {
    document.getElementById('rejectModal').classList.remove('hidden');
}

function hideRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}
</script>
@endsection