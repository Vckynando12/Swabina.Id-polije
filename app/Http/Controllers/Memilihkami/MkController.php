<?php

namespace App\Http\Controllers\Memilihkami; // Pastikan namespace sesuai

use App\Http\Controllers\Controller;
use App\Models\MK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Validation\ValidationException; // Add this line
use Illuminate\Support\Facades\Log;

class MkController extends Controller // Ubah mkController menjadi MkController
{
    // Menampilkan halaman utama (landing page)
    public function index()
    {
        $MK = MK::all(); 
        return view('memilihkami.mengapa', compact('MK'));
    }

    // Menampilkan halaman mk CRUD
    public function showmk()
    {
        $MK = MK::all(); 
        $userRole = auth()->user()->role;
        $layout = $userRole === 'admin' ? 'layouts.app' : 'layouts.ppa';
        return view('admin.memilihkami.mk', compact('MK', 'userRole', 'layout'));
    }

    // Fungsi untuk mengompres dan menyimpan gambar
    private function compressAndSaveImage($file)
    {
        try {
            Log::info('Starting image compression', ['original_size' => $file->getSize()]);
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read($file);

            $image->scaleDown(1200);

            $extension = strtolower($file->getClientOriginalExtension());
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $extension = in_array($extension, $allowedExtensions) ? $extension : 'jpg';

            $fileName = time() . '_' . uniqid() . '.' . $extension;
            $path = 'mks/' . $fileName;

            $fullPath = storage_path('app/public/' . $path);
            
            switch ($extension) {
                case 'gif':
                    $image->toGif()->save($fullPath);
                    break;
                case 'png':
                    $image->toPng()->save($fullPath);
                    break;
                default:
                    $image->toJpeg(80)->save($fullPath);
            }

            if (!file_exists($fullPath)) {
                throw new \Exception("Failed to save image to {$fullPath}");
            }

            Log::info('Image compression completed', ['compressed_size' => filesize($fullPath)]);

            return $path;
        } catch (\Exception $e) {
            Log::error('Error in compressAndSaveImage', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    // Menyimpan data baru ke database
    public function store(Request $request)
    {
        Log::info('mk store method called', ['request' => $request->except('image')]);

        try {
            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480', // 20MB limit
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                Log::warning('Validation failed', ['errors' => $validator->errors()]);
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }

            if (!$request->hasFile('image')) {
                Log::error('No image file uploaded');
                return response()->json(['success' => false, 'message' => 'No image file uploaded'], 400);
            }

            $file = $request->file('image');
            Log::info('Image file details', [
                'name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType()
            ]);

            $path = $this->compressAndSaveImage($file);

            $MK = MK::create([
                'image' => $path,
                'title' => $request->title,
                'description' => $request->description,
            ]);

            Log::info('mk created successfully', ['mk_id' => $MK->id]);

            return response()->json(['success' => true, 'message' => 'mk berhasil ditambahkan']);
        } catch (\Exception $e) {
            Log::error('Error in mk store', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // Memperbarui data yang ada di database
    public function update(Request $request, $id)
    {
        Log::info('mk update method called', ['request' => $request->except('image'), 'id' => $id]);

        try {
            $MK = MK::findOrFail($id);
            
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480', // 20MB limit
            ]);

            if ($validator->fails()) {
                Log::warning('Validation failed', ['errors' => $validator->errors()]);
                return response()->json(['success' => false, 'message' => $validator->errors()], 422);
            }

            if ($request->hasFile('image')) {
                // Delete old image
                if ($MK->image) {
                    Storage::disk('public')->delete($MK->image);
                }
                
                // Compress and save new image
                $MK->image = $this->compressAndSaveImage($request->file('image'));
            }

            $MK->title = $request->title ?? $MK->title;
            $MK->description = $request->description ?? $MK->description;
            $MK->save();

            Log::info('mk updated successfully', ['mk_id' => $MK->id]);

            return response()->json(['success' => true, 'message' => 'mk berhasil diperbarui']);
        } catch (\Exception $e) {
            Log::error('Error in mk update', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // Menghapus data dari database
    public function destroy($id)
    {
        try {
            $MK = MK::findOrFail($id);

            if ($MK->image) {
                Storage::disk('public')->delete($MK->image);
            }

            $MK->delete();

            return response()->json(['success' => true, 'message' => 'mk berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error in mk destroy: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    // Menampilkan daftar MK
}
