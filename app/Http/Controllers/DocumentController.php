<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Traits\Loggable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::with(['creator', 'verifier', 'approver'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $document = Document::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'created_by' => Auth::id(),
                'status' => 'draft'
            ]);

            // Log aktivitas pembuatan
            $document->logActivity('create', "Dokumen '{$document->title}' berhasil dibuat");

            DB::commit();
            
            return redirect()->route('documents.show', $document)
                ->with('success', 'Dokumen berhasil dibuat');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membuat dokumen: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        $document->load(['creator', 'verifier', 'approver', 'activityLogs.performer']);
        
        // Group logs by date untuk tampilan yang lebih rapi
        $groupedLogs = $document->activityLogs
            ->groupBy(function ($log) {
                return $log->created_at->format('Y-m-d');
            });
            
        return view('documents.show', compact('document', 'groupedLogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        // Cek authorization
        if ($document->status !== 'draft') {
            return redirect()->route('documents.show', $document)
                ->with('error', 'Hanya dokumen dengan status draft yang dapat diedit');
        }
        
        return view('documents.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        // Cek authorization
        if ($document->status !== 'draft') {
            return redirect()->route('documents.show', $document)
                ->with('error', 'Hanya dokumen dengan status draft yang dapat diedit');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // Simpan data lama untuk log
            $oldData = $document->toArray();
            
            // Update dokumen
            $document->update($validated);
            
            // Tentukan field yang berubah
            $changedFields = [];
            foreach ($validated as $field => $newValue) {
                if ($oldData[$field] != $newValue) {
                    $changedFields[] = $field;
                }
            }
            
            // Log aktivitas update
            $document->logActivity(
                'update',
                "Dokumen '{$document->title}' berhasil diperbarui",
                $oldData,
                $document->toArray(),
                $changedFields
            );

            DB::commit();
            
            return redirect()->route('documents.show', $document)
                ->with('success', 'Dokumen berhasil diperbarui');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui dokumen: ' . $e->getMessage());
        }
    }

    /**
     * Verify the document.
     */
    public function verify(Request $request, Document $document)
    {
        // Cek authorization (misal: hanya verifier yang bisa verify)
        if ($document->status !== 'draft') {
            return back()->with('error', 'Hanya dokumen dengan status draft yang dapat diverifikasi');
        }

        DB::beginTransaction();
        try {
            $oldData = $document->toArray();
            
            $document->update([
                'status' => 'verified',
                'verified_by' => Auth::id(),
                'verified_at' => now(),
            ]);
            
            // Log aktivitas verifikasi
            $document->logActivity(
                'verify',
                "Dokumen '{$document->title}' berhasil diverifikasi oleh " . Auth::user()->name,
                $oldData,
                $document->toArray(),
                ['status', 'verified_by', 'verified_at']
            );

            DB::commit();
            
            return redirect()->route('documents.show', $document)
                ->with('success', 'Dokumen berhasil diverifikasi');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memverifikasi dokumen: ' . $e->getMessage());
        }
    }

    /**
     * Approve the document.
     */
    public function approve(Request $request, Document $document)
    {
        // Cek authorization dan status
        if ($document->status !== 'verified') {
            return back()->with('error', 'Hanya dokumen dengan status verified yang dapat disetujui');
        }

        DB::beginTransaction();
        try {
            $oldData = $document->toArray();
            
            $document->update([
                'status' => 'approved',
                'approved_by' => Auth::id(),
                'approved_at' => now(),
            ]);
            
            // Log aktivitas approval
            $document->logActivity(
                'approve',
                "Dokumen '{$document->title}' berhasil disetujui oleh " . Auth::user()->name,
                $oldData,
                $document->toArray(),
                ['status', 'approved_by', 'approved_at']
            );

            DB::commit();
            
            return redirect()->route('documents.show', $document)
                ->with('success', 'Dokumen berhasil disetujui');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyetujui dokumen: ' . $e->getMessage());
        }
    }

    /**
     * Reject the document.
     */
    public function reject(Request $request, Document $document)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            $oldData = $document->toArray();
            
            $document->update([
                'status' => 'rejected',
            ]);
            
            // Log aktivitas rejection dengan reason
            $document->logActivity(
                'reject',
                "Dokumen '{$document->title}' ditolak oleh " . Auth::user()->name . 
                ". Alasan: " . $validated['rejection_reason'],
                $oldData,
                $document->toArray(),
                ['status']
            );

            DB::commit();
            
            return redirect()->route('documents.show', $document)
                ->with('success', 'Dokumen berhasil ditolak');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menolak dokumen: ' . $e->getMessage());
        }
    }

    /**
     * Show activity logs for the document.
     */
    public function logs(Document $document, Request $request)
    {
        $type = $request->get('type');
        
        if ($type) {
            $logs = $document->getActivityLogsByType($type, 20);
        } else {
            $logs = $document->getActivityLogsPaginated(20);
        }
        
        return view('documents.logs', compact('document', 'logs', 'type'));
    }
}