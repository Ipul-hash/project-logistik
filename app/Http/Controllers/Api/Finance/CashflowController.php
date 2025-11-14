<?php

namespace App\Http\Controllers\Api\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashFlow;
use App\Models\Journal;
use Illuminate\Support\Facades\Validator;

class CashflowController extends Controller
{
    /**
     * Display all cash flows.
     */
    public function index(Request $request)
{
    $query = CashFlow::with(['account', 'creator', 'verifier'])->orderBy('created_at', 'desc');
        if ($request->has('status')) {
        $query->where('status', $request->status);
    }

    $data = $query->get();

    return response()->json([
        'success' => true,
        'message' => 'Data kas masuk & keluar berhasil ditampilkan',
        'count'   => $data->count(),
        'data'    => $data,
    ]);
}

    /**
     * Store a newly created cash flow.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'        => 'required|in:in,out', // tipe kas
            'account_id'  => 'required|exists:accounts,id',
            'reference'   => 'nullable|string|max:50',
            'amount'      => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'created_by'  => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $cashflow = CashFlow::create([
            'type'        => $request->type,
            'account_id'  => $request->account_id,
            'reference'   => $request->reference ?? strtoupper(uniqid('CF-')),
            'amount'      => $request->amount,
            'description' => $request->description,
            'status'      => 'pending', // default
            'created_by'  => $request->created_by,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaksi kas berhasil ditambahkan',
            'data'    => $cashflow->load(['account', 'creator']),
        ], 201);
    }

    /**
     * Show detail cash flow.
     */
    public function show($id)
    {
        $data = CashFlow::with(['account', 'creator', 'verifier'])->find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail kas berhasil ditampilkan',
            'data' => $data,
        ], 200);
    }

    /**
     * Update cash flow (approval/validation).
     */
    public function update(Request $request, $id)
{
    $data = CashFlow::find($id);
    if (!$data) {
        return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
    }

    $validated = $request->validate([
        'status' => 'in:pending,verified',
        'description' => 'nullable|string',
    ]);

    // Simpan status baru
    $newStatus = $request->status ?? $data->status;
    $data->update([
        'status' => $newStatus,
        'description' => $request->description ?? $data->description,
        'verified_by' => auth()->id(), // lebih aman daripada hardcode 3
        'verified_at' => $newStatus === 'setujui' ? now() : null,
    ]);

    // 🔥 Auto-generate jurnal jika status jadi 'verified'
    if ($newStatus === 'verified' && !$data->journal) {
        Journal::create([
            'cash_flow_id' => $data->id,
            'transaction_ref' => $data->reference,
            'account_id' => $data->account_id,
            'debit' => $data->type === 'out' ? $data->amount : '0.00',
            'credit' => $data->type === 'in' ? $data->amount : '0.00',
            'description' => $data->description,
            'created_at' => $data->created_at,
        ]);
    }

    return response()->json([
        'success' => true,
        'message' => 'Data kas berhasil diperbarui',
        'data' => $data->load(['account', 'creator', 'verifier']),
    ]);
}
    /**
     * Delete a cash flow record.
     */
    public function destroy($id)
    {
        $data = CashFlow::find($id);

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $data->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data kas berhasil dihapus',
        ], 200);
    }
}
