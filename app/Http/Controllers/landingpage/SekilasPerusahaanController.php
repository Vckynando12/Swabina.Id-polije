<?php

namespace App\Http\Controllers\landingpage;
use App\Models\SekilasPerusahaan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SekilasPerusahaanController extends Controller

{
    public function index()
    {
        $data = SekilasPerusahaan::all();
        $userRole = auth()->user()->role;
        $layout = $userRole === 'admin' ? 'layouts.app' : 'layouts.ppa';
        return view('admin.landingpage.sekilasperusahaan', compact('data', 'userRole', 'layout'));
    }

    public function create()
    {
        return view('admin.landingpage.sekilas.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'maintext' => 'required',
                'text_align' => 'required|in:left,center,right,justify',
            ]);

            $maintext = str_replace("\r\n", "\n", $request->maintext);

            SekilasPerusahaan::create([
                'maintext' => $maintext,
                'text_align' => $request->text_align,
            ]);

            return response()->json(['success' => true, 'message' => 'Data added successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function edit($id)
    {
        $sekilas = SekilasPerusahaan::findOrFail($id);
        return view('admin.landingpage.sekilas.edit', compact('sekilas'));
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'maintext' => 'required',
                'text_align' => 'required|in:left,center,right,justify',
            ]);

            $maintext = str_replace("\r\n", "\n", $request->maintext);

            $sekilas = SekilasPerusahaan::findOrFail($id);
            $sekilas->update([
                'maintext' => $maintext,
                'text_align' => $request->text_align,
            ]);

            return response()->json(['success' => true, 'message' => 'Data updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function destroy($id)
    {
        $sekilas = SekilasPerusahaan::findOrFail($id);
        $sekilas->delete();
        return response()->json(['success' => true, 'message' => 'Data deleted successfully.']);
    }    
}

