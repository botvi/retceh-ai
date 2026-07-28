<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Testimoni;
use RealRashid\SweetAlert\Facades\Alert;

class ReviewController extends Controller
{
    public function index()
    {
        return view('pageuser.review.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pesan' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
            'name' => 'nullable|string|max:100',
            'role' => 'required|string|max:100'
        ], [
            'pesan.required' => 'Pesan ulasan wajib diisi',
            'rating.required' => 'Rating bintang wajib dipilih',
            'role.required' => 'Pekerjaan/Jenis usaha wajib diisi'
        ]);

        Testimoni::create([
            'user_id' => Auth::id(),
            'name' => $request->name ?: Auth::user()->name,
            'role' => $request->role,
            'pesan' => $request->pesan,
            'rating' => $request->rating,
            'status' => 'approved' // directly approved and shown
        ]);

        Alert::success('Terima Kasih!', 'Ulasan Anda berhasil dikirim dan langsung dipublikasikan.');
        return redirect()->route('index');
    }
}
