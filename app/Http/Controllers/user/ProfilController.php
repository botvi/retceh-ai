<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilController extends Controller
{
    public function index()
    {
        return view('pageuser.profile.index');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'no_wa' => 'required|string|max:20|unique:users,no_wa,' . $user->id,
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ], [
            'name.required' => 'Nama lengkap wajib diisi',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah digunakan oleh pengguna lain',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi',
            'no_wa.unique' => 'Nomor WhatsApp sudah digunakan oleh pengguna lain',
            'foto_profile.image' => 'Berkas harus berupa gambar',
            'foto_profile.max' => 'Ukuran gambar maksimal 2MB'
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'no_wa' => $request->no_wa
        ];

        if ($request->hasFile('foto_profile')) {
            $file = $request->file('foto_profile');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Create folder if not exists
            $path = public_path('uploads/foto_profile');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Delete old photo if local
            if ($user->foto_profile && !str_starts_with($user->foto_profile, 'http')) {
                $oldFile = public_path('uploads/foto_profile/' . $user->foto_profile);
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }

            // Move new file
            $file->move($path, $filename);
            $data['foto_profile'] = $filename;
        }

        User::where('id', $user->id)->update($data);

        Alert::success('Berhasil', 'Profil Anda berhasil diperbarui!');
        return redirect()->back();
    }
}
