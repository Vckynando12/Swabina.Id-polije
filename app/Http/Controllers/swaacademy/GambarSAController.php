<?php

namespace App\Http\Controllers\Swaacademy;

use App\Models\GambarSA;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;

class GambarSAController extends Controller
{
    public function index()
    {
        $gambarSA = GambarSA::first();
        $userRole = auth()->user()->role;
        $layout = $userRole === 'admin' ? 'layouts.app' : 'layouts.ppa';
        return view('admin.swaacademy.gambarSA', compact('gambarSA', 'userRole', 'layout'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'gambarType' => 'required|in:gambar1,gambar2',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);

            $gambarSA = GambarSA::firstOrNew();
            $gambarType = $request->input('gambarType');

            if ($request->hasFile('image')) {
                $imagePath = $this->compressAndSaveImage($request->file('image'));
                $gambarSA->$gambarType = $imagePath;
            }

            $gambarSA->save();

            return response()->json(['success' => true, 'message' => 'Image added successfully.']);
        } catch (\Exception $e) {
            Log::error('Error saving image: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'gambarType' => 'required|in:gambar1,gambar2',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);

            $gambarSA = GambarSA::findOrFail($id);
            $gambarType = $request->input('gambarType');

            if ($request->hasFile('image')) {
                if ($gambarSA->$gambarType) {
                    Storage::delete('public/' . $gambarSA->$gambarType);
                }
                $imagePath = $this->compressAndSaveImage($request->file('image'));
                $gambarSA->$gambarType = $imagePath;
            }

            $gambarSA->save();

            return response()->json(['success' => true, 'message' => 'Image updated successfully.']);
        } catch (\Exception $e) {
            Log::error('Error updating image: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $request->validate([
                'gambar' => 'required|in:gambar1,gambar2',
            ]);

            $gambarSA = GambarSA::findOrFail($id);
            $gambar = $request->input('gambar');

            if ($gambarSA->$gambar) {
                Storage::delete('public/' . $gambarSA->$gambar);
                $gambarSA->$gambar = null;
                $gambarSA->save();
            }

            return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
        } catch (\Exception $e) {
            Log::error('Error deleting image: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function compressAndSaveImage($file)
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);

        $image->scaleDown(1200);

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = 'gambarSA/' . $fileName;

        Storage::put('public/' . $path, $image->encode());

        return $path;
    }
}