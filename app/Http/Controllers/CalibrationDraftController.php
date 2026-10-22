<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CalibrationDraft;
use Carbon\Carbon;

class CalibrationDraftController extends Controller
{
    /**
     * Simpan draft ke server (upsert per user)
     */
    public function save(Request $request)
    {
        $request->validate([
            'draft_data' => 'required',
        ]);

        $user = Auth::user();

        $rawDraft = $request->input('draft_data');
        if (is_string($rawDraft)) {
            if (strlen($rawDraft) > 5 * 1024 * 1024) {
                return response()->json(['success' => false, 'message' => 'Data draft terlalu besar.'], 413);
            }
            $draftData = json_decode($rawDraft, true);
        } else {
            $draftData = $rawDraft;
        }

        if (!is_array($draftData) && !is_object($draftData)) {
            return response()->json(['success' => false, 'message' => 'Format draft tidak valid.'], 422);
        }

        CalibrationDraft::updateOrCreate(
            ['user_id' => $user->id],
            [
                'draft_data'    => $draftData,
                'last_saved_at' => Carbon::now(),
            ]
        );

        return response()->json([
            'success'       => true,
            'last_saved_at' => Carbon::now()->format('H:i:s'),
        ]);
    }

    /**
     * Load draft dari server milik user yang sedang login
     */
    public function load()
    {
        $user  = Auth::user();
        $draft = CalibrationDraft::where('user_id', $user->id)->first();

        if (!$draft) {
            return response()->json(['success' => false, 'draft' => null]);
        }

        return response()->json([
            'success'       => true,
            'draft'         => $draft->draft_data,
            'last_saved_at' => $draft->last_saved_at
                ? $draft->last_saved_at->format('d/m/Y H:i:s')
                : null,
        ]);
    }

    /**
     * Hapus draft dari server (dipanggil setelah submit berhasil atau user pilih mulai baru)
     */
    public function clear()
    {
        $user = Auth::user();
        CalibrationDraft::where('user_id', $user->id)->delete();

        return response()->json(['success' => true]);
    }
}
