<?php

namespace App\Http\Controllers\DigitalSolution;

use App\Models\Carouselds;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CarouseldsController extends Controller
{
    public function index()
    {
        $carousels = Carouselds::all();
        $userRole = auth()->user()->role;
        $layout = $userRole === 'admin' ? 'layouts.app' : 'layouts.ppa';
        return view('admin.digitalsolution.carouselds', compact('carousels', 'userRole', 'layout'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);

            $imagePath = $this->compressAndSaveImage($request->file('image'));

            Carouselds::create([
                'image' => $imagePath,
            ]);

            return response()->json(['success' => true, 'message' => 'Image added successfully.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'message' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error in CarouseldsController@store: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]);

            $carousel = Carouselds::findOrFail($id);

            if ($request->hasFile('image')) {
                // Delete old image
                if ($carousel->image) {
                    Storage::delete('public/' . $carousel->image);
                }
                
                $imagePath = $this->compressAndSaveImage($request->file('image'));
                $carousel->image = $imagePath;
            }

            $carousel->save();

            return response()->json(['success' => true, 'message' => 'Image updated successfully.']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'message' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Error in CarouseldsController@update: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $carousel = Carouselds::findOrFail($id);
            if ($carousel->image) {
                Storage::delete('public/' . $carousel->image);
            }
            $carousel->delete();

            return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
        } catch (\Exception $e) {
            Log::error('Error in CarouseldsController@destroy: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    private function compressAndSaveImage($file)
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);

        $image->scaleDown(1200);

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $path = 'carouselds/' . $fileName;

        Storage::put('public/' . $path, $image->encode());

        return $path;
    }
}
