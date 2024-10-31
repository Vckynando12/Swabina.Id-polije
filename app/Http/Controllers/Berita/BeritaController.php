<?php

namespace App\Http\Controllers\Berita;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

class BeritaController extends Controller
{
    public function index()
    {
        $berita = Berita::all(); 
        return view('berita.berita', compact('berita'));
    }

    public function showberita()
    {
        $berita = Berita::all(); 
        $userRole = auth()->user()->role;
        $layout = $userRole === 'admin' ? 'layouts.app' : 'layouts.ppa';
        return view('admin.berita.berita', compact('berita', 'userRole', 'layout'));
    }

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
            $path = 'beritas/' . $fileName;

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

    private function formatDescription($text)
    {
        // Menghapus karakter kontrol kecuali newline
        $text = preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', $text);
        // Mengganti berbagai jenis newline menjadi \n
        return preg_replace('/\r\n|\r|\n/', "\n", $text);
    }

    public function store(Request $request)
    {
        Log::info('berita store method called', ['request' => $request->except('image')]);

        try {
            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:20480', // 20MB limit
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            if ($validator->fails()) {
                Log::warning('Validation failed', ['errors' => $validator->errors()]);
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
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

            $berita = Berita::create([
                'image' => $path,
                'title' => $request->title,
                'description' => $this->formatDescription($request->description),
            ]);

            Log::info('berita created successfully', ['berita_id' => $berita->id]);

            return response()->json(['success' => true, 'message' => 'Berita berhasil ditambahkan', 'data' => $berita]);
        } catch (\Exception $e) {
            Log::error('Error in berita store', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        Log::info('berita update method called', ['request' => $request->except('image'), 'id' => $id]);

        try {
            $berita = Berita::findOrFail($id);
            
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480', // 20MB limit
            ]);

            if ($validator->fails()) {
                Log::warning('Validation failed', ['errors' => $validator->errors()]);
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }

            if ($request->hasFile('image')) {
                if ($berita->image) {
                    Storage::disk('public')->delete($berita->image);
                }
                
                $berita->image = $this->compressAndSaveImage($request->file('image'));
            }

            $berita->title = $request->title ?? $berita->title;
            $berita->description = $this->formatDescription($request->description ?? $berita->description);
            $berita->save();

            Log::info('berita updated successfully', ['berita_id' => $berita->id]);

            return response()->json(['success' => true, 'message' => 'Berita berhasil diperbarui', 'data' => $berita]);
        } catch (\Exception $e) {
            Log::error('Error in berita update', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $berita = Berita::findOrFail($id);

            if ($berita->image) {
                Storage::disk('public')->delete($berita->image);
            }

            $berita->delete();

            return response()->json(['success' => true, 'message' => 'Berita berhasil dihapus']);
        } catch (\Exception $e) {
            Log::error('Error in berita destroy: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}