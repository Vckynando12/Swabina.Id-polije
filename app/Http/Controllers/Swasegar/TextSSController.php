<?php

namespace App\Http\Controllers\Swasegar;

use App\models\TextSS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TextSSController extends Controller
{
    public function index()
    {
        $texts = TextSS::all();
        $userRole = auth()->user()->role;
        $layout = $userRole === 'admin' ? 'layouts.app' : 'layouts.ppa';
        return view('admin.swasegar.textSS', compact('texts', 'userRole', 'layout'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'text_align' => 'required|in:left,center,right,justify',
        ]);

        $text = str_replace("\r\n", "\n", $request->text);

        TextSS::create([
            'text' => $text,
            'text_align' => $request->text_align,
        ]);

        return redirect()->back()->with('success', 'Text berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text' => 'required|string',
            'text_align' => 'required|in:left,center,right,justify',
        ]);

        $text = str_replace("\r\n", "\n", $request->text);

        $textSS = TextSS::findOrFail($id);
        $textSS->update([
            'text' => $text,
            'text_align' => $request->text_align,
        ]);

        return redirect()->back()->with('success', 'Text berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $textSS = TextSS::findOrFail($id);
        $textSS->delete();

        return redirect()->back()->with('success', 'Text berhasil dihapus.');
    }
}
