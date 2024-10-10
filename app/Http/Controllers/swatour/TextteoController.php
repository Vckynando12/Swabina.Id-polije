<?php

namespace App\Http\Controllers\swatour;

use App\models\Textteo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TextteoController extends Controller
{
    public function index()
    {
        $texts = Textteo::all();
        return view('admin.swatour.textteo', compact('texts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'text_align' => 'required|in:left,center,right,justify',
        ]);

        $content = str_replace("\r\n", "\n", $request->content);

        Textteo::create([
            'content' => $content,
            'text_align' => $request->text_align,
        ]);

        return redirect()->route('admin.swatour.textteo.index')->with('success', 'Text added successfully.');
    }

    public function update(Request $request, $id)
    {
        $text = Textteo::findOrFail($id);

        $request->validate([
            'content' => 'required|string',
            'text_align' => 'required|in:left,center,right,justify',
        ]);

        $content = str_replace("\r\n", "\n", $request->content);

        $text->update([
            'content' => $content,
            'text_align' => $request->text_align,
        ]);

        return redirect()->route('admin.swatour.textteo.index')->with('success', 'Text updated successfully.');
    }

    public function destroy($id)
    {
        $text = Textteo::find($id);
        $text->delete();

        return redirect()->route('admin.swatour.textteo.index')->with('success', 'Text deleted successfully.');
    }
}

