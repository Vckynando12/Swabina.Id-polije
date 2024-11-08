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
        try {
            $manager = new ImageManager(new Driver());
            
            // Baca gambar
            $img = $manager->read($image->getRealPath());
            
            // Resize gambar
            $img->scaleDown(800);
            
            // Generate nama file unik
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Tentukan path penyimpanan
            $path = 'public/images/' . $fileName;
            
            // Encode dan simpan sesuai format
            switch (strtolower($image->getClientOriginalExtension())) {
                case 'png':
                    Storage::put($path, $img->toPng());
                    break;
                case 'gif':
                    Storage::put($path, $img->toGif());
                    break;
                default:
                    Storage::put($path, $img->toJpeg(80));
            }
            
            return $fileName;
        } catch (\Exception $e) {

            throw $e;
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'file' => 'required|mimes:pdf,doc,docx,xls,xlsx|max:20480',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
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
        try {
            $request->validate([
                'judul' => 'required|string|max:255',
                'file' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:20480',
                'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:20840',
                'deskripsi' => 'nullable|string',
                'text_align' => 'required|in:left,center,right,justify',
            ]);

            $karir = Karir::findOrFail($id);

            // Update basic fields
            $karir->judul = $request->judul;
            $karir->deskripsi = $request->deskripsi;
            $karir->text_align = $request->text_align;

            // Handle file upload if new file is provided
            if ($request->hasFile('file')) {
                // Delete old file if exists
                if ($karir->file) {
                    Storage::delete('public/documents/' . $karir->file);
                }
                $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
                $request->file('file')->storeAs('public/documents', $fileName);
                $karir->file = $fileName;
            }

            // Handle image upload if new image is provided
            if ($request->hasFile('gambar')) {
                // Delete old image if exists
                if ($karir->gambar) {
                    Storage::delete('public/images/' . $karir->gambar);
                }
                $karir->gambar = $this->compressAndSaveImage($request->file('gambar'));
            }

            $karir->save();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data: ' . $e->getMessage()
            ], 500);
        }
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
