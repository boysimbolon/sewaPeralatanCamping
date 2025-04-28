<?php
namespace App\Http\Controllers;

use App\Models\Peralatan;
use Illuminate\Http\Request;

class PeralatanController extends Controller
{
    public function index()
    {
        return Peralatan::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'harga_per_hari' => 'required|numeric',
            'gambar' => 'nullable|string'
        ]);

        $peralatan = Peralatan::create($request->all());
        return response()->json($peralatan, 201);
    }

    public function update(Request $request, Peralatan $peralatan)
    {
        $peralatan->update($request->all());
        return response()->json($peralatan);
    }

    public function destroy(Peralatan $peralatan)
    {
        $peralatan->delete();
        return response()->json(['message' => 'Peralatan dihapus']);
    }
}
