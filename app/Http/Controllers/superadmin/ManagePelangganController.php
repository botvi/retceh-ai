<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class ManagePelangganController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('no_wa', 'like', "%{$search}%");
            });
        }

        $pelanggan = $query->paginate(15)->withQueryString();
        return view('pagesuperadmin.manage_pelanggan.index', compact('pelanggan'));
    }

    public function updateCredit(Request $request, $id)
    {
        $request->validate([
            'credits' => 'required|integer|min:0'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'credits' => $request->credits
        ]);

        Alert::success('Berhasil', 'Saldo Gelas Kopi pelanggan berhasil diperbarui!');
        return redirect()->route('manage-pelanggan.index');
    }

    public function destroy($id)
    {
        $pelanggan = User::findOrFail($id);
        $pelanggan->delete();
        Alert::success('Success', 'Pelanggan berhasil dihapus');
        return redirect()->route('manage-pelanggan.index');
    }
}