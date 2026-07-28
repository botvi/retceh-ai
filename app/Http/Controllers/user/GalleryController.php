<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AiGeneration;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryController extends Controller
{
    public function index()
    {
        $generations = AiGeneration::where('user_id', Auth::id())
            ->where('status', 'completed')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pageuser.gallery.index', compact('generations'));
    }

    public function destroy($id)
    {
        $gen = AiGeneration::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($gen) {
            $gen->delete();
            Alert::success('Berhasil', 'Desain foto produk berhasil dihapus dari galeri');
        } else {
            Alert::error('Gagal', 'Desain tidak ditemukan');
        }

        return redirect()->route('gallery.index');
    }

    public function clear()
    {
        AiGeneration::where('user_id', Auth::id())->delete();
        Alert::success('Berhasil', 'Seluruh galeri berhasil dibersihkan');
        return redirect()->route('gallery.index');
    }
}
