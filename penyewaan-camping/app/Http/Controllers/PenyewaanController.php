<?php
namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenyewaanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'peralatan_id' => 'required|exists:peralatans,id',
            'nama_penyewa' => 'required|string',
            'tanggal_sewa' => 'required|date',
            'lama_hari' => 'required|integer|min:1'
        ]);

        Penyewaan::create([
            'user_id' => Auth::id(),
            'peralatan_id' => $request->peralatan_id,
            'nama_penyewa' => $request->nama_penyewa,
            'tanggal_sewa' => $request->tanggal_sewa,
            'lama_hari' => $request->lama_hari,
            'status' => 'sedang_disewa'
        ]);

        return response()->json(['message' => 'Penyewaan dibuat']);
    }

    public function sedangDisewa()
    {
        return Penyewaan::with('peralatan')
            ->where('user_id', Auth::id())
            ->where('status', 'sedang_disewa')
            ->get();
    }
    public function updateStatus(Request $request, $id)
    {
        $penyewaan = Penyewaan::findOrFail($id);
        $penyewaan->status = $request->status;
        $penyewaan->save();

        return response()->json(['message' => 'Status updated']);
    }

    public function sewaSelesai()
    {
        return Penyewaan::with('peralatan')
            ->where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->get();
    }

    public function index()
    {
        return Penyewaan::with(['user', 'peralatan'])
            ->where('status', 'sedang_disewa')
            ->get();
    }

    public function history()
    {
        return Penyewaan::with(['user', 'peralatan'])
            ->where('status', 'selesai')
            ->get();
    }
}
