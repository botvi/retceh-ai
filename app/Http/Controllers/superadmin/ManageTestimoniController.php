<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ManageTestimoniController extends Controller
{
    public function index(Request $request)
    {
        $query = Testimoni::orderBy('created_at', 'desc')->with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%")
                  ->orWhere('pesan', 'like', "%{$search}%");
            });
        }

        $testimonis = $query->paginate(15)->withQueryString();
        return view('pagesuperadmin.manage_testimoni.index', compact('testimonis'));
    }

    public function toggleStatus($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $newStatus = $testimoni->status == 'approved' ? 'pending' : 'approved';
        $testimoni->update(['status' => $newStatus]);

        Alert::success('Berhasil', 'Status testimoni diubah menjadi ' . $newStatus);
        return redirect()->route('manage-testimoni.index');
    }

    public function destroy($id)
    {
        $testimoni = Testimoni::find($id);

        if ($testimoni) {
            $testimoni->delete();
            Alert::success('Success', 'Testimoni berhasil dihapus');
        } else {
            Alert::error('Error', 'Testimoni tidak ditemukan');
        }

        return redirect()->route('manage-testimoni.index');
    }
}