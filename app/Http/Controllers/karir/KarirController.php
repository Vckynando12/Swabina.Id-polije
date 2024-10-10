<?php

namespace App\Http\Controllers\karir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karir;
use Illuminate\Support\Facades\Storage;

class KarirController extends Controller
{
    public function index()
    {
        $karirs = Karir::all();
        return view('admin.karir.karir', compact('karirs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,doc,docx,xls,xlsx|max:20480', // 20MB max
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/documents', $fileName);

        $karir = Karir::create([
            'judul' => $request->judul,
            'file' => $fileName,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Karir berhasil ditambahkan',
            'data' => $karir
        ]);
    }

    public function update(Request $request, $id)
    {
        $karir = Karir::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:20480', // 20MB max
        ]);

        $karir->judul = $request->judul;

        if ($request->hasFile('file')) {
            Storage::delete('public/documents/' . $karir->file);
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/documents', $fileName);
            $karir->file = $fileName;
        }

        $karir->save();

        return response()->json([
            'success' => true,
            'message' => 'Karir berhasil diperbarui',
            'data' => $karir
        ]);
    }

    public function destroy($id)
    {
        try {
            $karir = Karir::findOrFail($id);
            if ($karir->file) {
                Storage::delete('public/documents/' . $karir->file);
            }
            $karir->delete();
            return response()->json([
                'success' => true,
                'message' => 'Karir berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus karir: ' . $e->getMessage()
            ], 500);
        }
    }
}
