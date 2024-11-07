<?php

namespace App\Http\Controllers\karir;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karir;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class KarirController extends Controller
{
    public function index()
    {
        $karirs = Karir::all();
        return view('admin.karir.karir', compact('karirs'));
    }

    public function karir()
    {
        $karirs = Karir::all();
        return view('karir.karir', compact('karirs'));
    }
    public function karirEng()
    {
        $karirs = Karir::all();
        return view('eng.karir-eng.karir-eng', compact('karirs'));
    }

    private function compressAndSaveImage($image)
    {
        $manager = new ImageManager(new Driver());
        $img = $manager->read($image);

        $img->scaleDown(800);

        $fileName = time() . '_' . $image->getClientOriginalName();
        $path = 'images/' . $fileName;

        Storage::put('public/' . $path, $img->encode());

        return $fileName;
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,doc,docx,xls,xlsx|max:20480',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
            'text_align' => 'required|in:left,center,right,justify',
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/documents', $fileName);

        $gambarName = null;
        if ($request->hasFile('gambar')) {
            $gambarName = $this->compressAndSaveImage($request->file('gambar'));
        }

        $karir = Karir::create([
            'judul' => $request->judul,
            'file' => $fileName,
            'gambar' => $gambarName,
            'deskripsi' => $request->deskripsi,
            'text_align' => $request->text_align,
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
            'file' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:20480',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
            'text_align' => 'required|in:left,center,right,justify',
        ]);

        $karir->judul = $request->judul;
        $karir->deskripsi = $request->deskripsi;
        $karir->text_align = $request->text_align;

        if ($request->hasFile('file')) {
            Storage::delete('public/documents/' . $karir->file);
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/documents', $fileName);
            $karir->file = $fileName;
        }

        if ($request->hasFile('gambar')) {
            if ($karir->gambar) {
                Storage::delete('public/images/' . $karir->gambar);
            }
            
            $gambarName = $this->compressAndSaveImage($request->file('gambar'));
            $karir->gambar = $gambarName;
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
            if ($karir->gambar) {
                Storage::delete('public/images/' . $karir->gambar);
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
