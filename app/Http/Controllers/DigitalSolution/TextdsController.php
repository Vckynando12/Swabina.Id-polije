<?php

namespace App\Http\Controllers\DigitalSolution;

use App\Models\Textds;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TextdsController extends Controller
{
    public function index()
    {
        $texts = Textds::all();
        $userRole = auth()->user()->role;
        $layout = $userRole === 'admin' ? 'layouts.app' : 'layouts.ppa';
        return view('admin.digitalsolution.textds', compact('texts', 'userRole', 'layout'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
            'text_align' => 'required|in:left,center,right,justify',
        ]);

        $text = str_replace("\r\n", "\n", $request->text);

        Textds::create([
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

        $textds = Textds::findOrFail($id);
        $textds->update([
            'text' => $text,
            'text_align' => $request->text_align,
        ]);

        return redirect()->back()->with('success', 'Text berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $text = Textds::findOrFail($id);
        $text->delete();

        return redirect()->back()->with('success', 'Text berhasil dihapus.');
    }
}
