<?php

namespace App\Http\Controllers\Facilitymanagement;

use App\models\TextFM;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TextFMController extends Controller
{
    public function index()
    {
        $texts = TextFM::all();
        $userRole = auth()->user()->role;
        $layout = $userRole === 'admin' ? 'layouts.app' : 'layouts.ppa';
        return view('admin.facilitymanagement.textFM', compact('texts', 'userRole', 'layout'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'text_align' => 'required|in:left,center,right,justify',
        ]);

        $content = str_replace("\r\n", "\n", $request->content);

        TextFM::create([
            'content' => $content,
            'text_align' => $request->text_align,
        ]);

        return redirect()->back()->with('success', 'Text berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
            'text_align' => 'required|in:left,center,right,justify',
        ]);

        $content = str_replace("\r\n", "\n", $request->content);

        $textFM = TextFM::findOrFail($id);
        $textFM->update([
            'content' => $content,
            'text_align' => $request->text_align,
        ]);

        return redirect()->back()->with('success', 'Text berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $textFM = TextFM::findOrFail($id);
        $textFM->delete();

        return redirect()->back()->with('success', 'Text berhasil dihapus.');
        // return response()->json(['success' => true]);
    }
}
