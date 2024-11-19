<?php

namespace App\Http\Controllers\socialmedia;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userRole = auth()->user()->role;
        $layout = $userRole === 'admin' ? 'layouts.app' : 'layouts.ppa';
        $social = SocialLink::firstOrCreate(['id' => 1]);
        return view('admin.sosialmedia.sosmed', compact('social', 'layout'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'type' => 'required|in:facebook,youtube,youtube_landing,whatsapp,instagram',
                'url' => 'required|url'
            ]);

            if (!SocialLink::validateUrl($request->type, $request->url)) {
                return response()->json([
                    'success' => false,
                    'message' => 'URL tidak valid untuk tipe yang dipilih'
                ]);
            }

            $social = SocialLink::firstOrCreate(['id' => 1]);
            $social->update([$request->type => $request->url]);

            return response()->json([
                'success' => true,
                'message' => 'Link berhasil ditambahkan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'type' => 'required|in:facebook,youtube,youtube_landing,whatsapp,instagram',
                'url' => 'required|url'
            ]);

            if (!SocialLink::validateUrl($request->type, $request->url)) {
                return response()->json([
                    'success' => false,
                    'message' => 'URL tidak valid untuk tipe yang dipilih'
                ]);
            }

            $social = SocialLink::findOrFail($id);
            $social->update([$request->type => $request->url]);

            return response()->json([
                'success' => true,
                'message' => 'Link berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $request->validate([
                'type' => 'required|in:facebook,youtube,youtube_landing,whatsapp,instagram'
            ]);

            $social = SocialLink::findOrFail($id);
            $social->update([$request->type => null]);

            return response()->json([
                'success' => true,
                'message' => 'Link berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
} 