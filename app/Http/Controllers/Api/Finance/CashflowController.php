<?php

namespace App\Http\Controllers\Api\Finance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashFlow;
use Illuminate\Support\Facades\Validator;

class CashflowController extends Controller
{
    /**
     * Display all cash flows.
     */
    public function index()
    {
        $data = CashFlow::with(['account', 'creator', 'verifier'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data kas masuk & keluar berhasil ditampilkan',
            'count'   => $data->count(),
            'data'    => $data,
        ], 200);
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
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $validated = $request->validate([
            'status' => 'in:pending,approved,rejected',
            'description' => 'nullable|string',
        ]);

        $data->update([
            'status' => $request->status ?? $data->status,
            'description' => $request->description ?? $data->description,
            'verified_by' => 3, // sementara hardcode (nanti pakai auth()->id())
            'verified_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data kas berhasil diperbarui',
            'data' => $data->load(['account', 'creator', 'verifier']),
        ], 200);
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
