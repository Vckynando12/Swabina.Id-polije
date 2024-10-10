<?php

namespace App\Http\Controllers\landingpage;

use App\Http\Controllers\Controller;
use App\Models\FotoLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class FotoLayananController extends Controller
{
    // Menampilkan halaman utama (landing page)
    public function landingpage()
    {
        $fotoLayanans = FotoLayanan::all();
        return view('landingpage', compact('fotoLayanans'));
    }

    // Menampilkan halaman foto layanan CRUD
    public function index()
    {
        $fotoLayanans = FotoLayanan::all();
        $userRole = auth()->user()->role;
        $layout = $userRole === 'admin' ? 'layouts.app' : 'layouts.ppa';
        return view('admin.landingpage.foto_layanan', compact('fotoLayanans', 'userRole', 'layout'));
    }

    // Fungsi untuk mengompres dan menyimpan gambar
    private function compressAndSaveImage($file)
    {
        try {
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);

            Log::info('Original image size: ' . $file->getSize() . ' bytes');

            // Resize gambar ke lebar maksimum 1200px dengan mempertahankan aspek ratio
            $image->scaleDown(1200);

            // Tentukan format output berdasarkan ekstensi file asli
            $extension = strtolower($file->getClientOriginalExtension());
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $extension = in_array($extension, $allowedExtensions) ? $extension : 'jpg';

            // Generate nama file unik
            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $path = 'foto-layanan/' . $fileName;

            // Pastikan direktori ada
            $directory = storage_path('app/public/foto-layanan');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Kompres dan simpan gambar
            switch ($extension) {
                case 'gif':
                    $image->toGif()->save(storage_path('app/public/' . $path));
                    break;
                case 'png':
                    $image->toPng()->save(storage_path('app/public/' . $path));
                    break;
                default:
                    $image->toJpeg(80)->save(storage_path('app/public/' . $path));
            }

            Log::info('Compressed image size: ' . filesize(storage_path('app/public/' . $path)) . ' bytes');

            return $path;
        } catch (\Exception $e) {
            Log::error('Error in compressAndSaveImage: ' . $e->getMessage());
            throw $e;
        }
    }

    // Menyimpan data baru ke database
    public function store(Request $request)
    {
        try {
            $request->validate([
                'image1' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
                'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            ]);

            $fotoLayanan = new FotoLayanan();

            if ($request->hasFile('image1')) {
                $fotoLayanan->image1 = $this->compressAndSaveImage($request->file('image1'));
            }

            if ($request->hasFile('image2')) {
                $fotoLayanan->image2 = $this->compressAndSaveImage($request->file('image2'));
            }

            $fotoLayanan->save();

            return response()->json(['success' => true, 'message' => 'Foto Layanan berhasil ditambahkan']);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'message' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // Memperbarui data yang ada di database
    public function update(Request $request, $id)
    {
        try {
            $fotoLayanan = FotoLayanan::findOrFail($id);
            
            $request->validate([
                'image1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
                'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            ]);

            if ($request->hasFile('image1')) {
                if ($fotoLayanan->image1) {
                    Storage::disk('public')->delete($fotoLayanan->image1);
                }
                $fotoLayanan->image1 = $this->compressAndSaveImage($request->file('image1'));
            }

            if ($request->hasFile('image2')) {
                if ($fotoLayanan->image2) {
                    Storage::disk('public')->delete($fotoLayanan->image2);
                }
                $fotoLayanan->image2 = $this->compressAndSaveImage($request->file('image2'));
            }

            $fotoLayanan->save();

            return response()->json(['success' => true, 'message' => 'Foto Layanan berhasil diperbarui']);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'message' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // Menghapus data dari database
    public function destroy($id)
    {
        try {
            $fotoLayanan = FotoLayanan::findOrFail($id);

            if ($fotoLayanan->image1) {
                Storage::disk('public')->delete($fotoLayanan->image1);
            }

            if ($fotoLayanan->image2) {
                Storage::disk('public')->delete($fotoLayanan->image2);
            }

            $fotoLayanan->delete();

            return response()->json(['success' => true, 'message' => 'Foto Layanan berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
};