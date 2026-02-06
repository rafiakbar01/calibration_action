{{-- resources/views/log-kalibrasi/partials/table.blade.php --}}
@forelse($logs as $log)
    <tr>
        <td class="small text-nowrap">
            {{ $log->created_at->format('d/m/Y H:i:s') }}
        </td>
        <td>
            @php
                $badgeColor = match($log->aksi) {
                    'BUAT' => 'success',
                    'UBAH' => 'warning',
                    'HAPUS' => 'danger',
                    default => 'info'
                };
            @endphp
            <span class="badge bg-{{ $badgeColor }}">
                {{ $log->aksi }}
            </span>
        </td>
        <td class="small">{{ $log->deskripsi }}</td>
        <td class="text-nowrap">
            <a href="{{ route('log-kalibrasi.per-kalibrasi', $log->kalibrasi_id) }}" 
               class="text-decoration-none">
                #{{ $log->kalibrasi_id }}
            </a>
        </td>
        <td class="small text-nowrap">
            {{ $log->user->name ?? 'System' }}
        </td>
        <td class="small">{{ $log->alamat_ip ?? '-' }}</td>
        <td class="text-center">
            <a href="{{ route('log-kalibrasi.show', $log->id) }}" 
               class="btn btn-info btn-sm" title="Detail Log">
                <i class="fas fa-eye"></i>
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center text-muted py-4">
            <i class="fas fa-inbox fa-2x mb-3 opacity-50"></i><br>
            Tidak ada data log kalibrasi.
        </td>
    </tr>
@endforelse