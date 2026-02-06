<div class="space-y-4">
    @foreach($logs as $log)
        <div class="flex items-start space-x-3 p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
            <!-- Icon berdasarkan tipe aktivitas -->
            <div class="flex-shrink-0">
                @switch($log->activity_type)
                    @case('create')
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center">
                            <i class="fas fa-plus text-green-600"></i>
                        </div>
                        @break
                    @case('update')
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-edit text-blue-600"></i>
                        </div>
                        @break
                    @case('verify')
                        <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center">
                            <i class="fas fa-check-circle text-yellow-600"></i>
                        </div>
                        @break
                    @case('approve')
                        <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center">
                            <i class="fas fa-thumbs-up text-purple-600"></i>
                        </div>
                        @break
                    @case('reject')
                        <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                            <i class="fas fa-times-circle text-red-600"></i>
                        </div>
                        @break
                    @default
                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-history text-gray-600"></i>
                        </div>
                @endswitch
            </div>
            
            <!-- Konten log -->
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-gray-900">
                        {{ $log->description }}
                    </p>
                    <span class="text-xs text-gray-500">
                        {{ $log->created_at->diffForHumans() }}
                    </span>
                </div>
                
                <div class="mt-1 text-sm text-gray-600">
                    <span class="font-medium">Oleh:</span> 
                    {{ $log->performer->name ?? 'System' }}
                </div>
                
                <!-- Tampilkan perubahan data jika ada -->
                @if($log->changed_fields && count($log->changed_fields) > 0)
                    <div class="mt-2 text-xs">
                        <span class="font-medium">Field yang berubah:</span>
                        <span class="text-gray-600 ml-1">
                            {{ implode(', ', $log->changed_fields) }}
                        </span>
                    </div>
                @endif
                
                <!-- Detail perubahan jika ingin expand -->
                @if($log->old_data && $log->new_data)
                    <div class="mt-2">
                        <button type="button" 
                                class="text-xs text-blue-600 hover:text-blue-800"
                                onclick="toggleLogDetail({{ $log->id }})">
                            <i class="fas fa-chevron-down mr-1"></i> Lihat detail perubahan
                        </button>
                        
                        <div id="log-detail-{{ $log->id }}" class="hidden mt-2 space-y-1">
                            @foreach($log->changed_fields as $field)
                                @if(isset($log->old_data[$field]) && isset($log->new_data[$field]))
                                    <div class="grid grid-cols-2 gap-2 text-xs">
                                        <div class="bg-red-50 p-2 rounded">
                                            <div class="font-medium">Sebelum:</div>
                                            <div class="truncate">{{ $log->old_data[$field] }}</div>
                                        </div>
                                        <div class="bg-green-50 p-2 rounded">
                                            <div class="font-medium">Sesudah:</div>
                                            <div class="truncate">{{ $log->new_data[$field] }}</div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
                
                <!-- Informasi tambahan -->
                <div class="mt-2 text-xs text-gray-500">
                    <span class="mr-3">
                        <i class="fas fa-globe mr-1"></i> {{ $log->ip_address }}
                    </span>
                    @if($log->user_agent)
                        <span>
                            <i class="fas fa-desktop mr-1"></i> 
                            {{ Str::limit($log->user_agent, 50) }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
function toggleLogDetail(logId) {
    const detailElement = document.getElementById('log-detail-' + logId);
    const button = detailElement.previousElementSibling;
    const icon = button.querySelector('i');
    
    if (detailElement.classList.contains('hidden')) {
        detailElement.classList.remove('hidden');
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
        button.innerHTML = '<i class="fas fa-chevron-up mr-1"></i> Sembunyikan detail';
    } else {
        detailElement.classList.add('hidden');
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
        button.innerHTML = '<i class="fas fa-chevron-down mr-1"></i> Lihat detail perubahan';
    }
}
</script>