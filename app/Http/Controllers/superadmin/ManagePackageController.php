<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use RealRashid\SweetAlert\Facades\Alert;

class ManagePackageController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('price', 'asc')->get();
        return view('pagesuperadmin.package.index', compact('packages'));
    }

    public function create()
    {
        return view('pagesuperadmin.package.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'credits' => 'required|integer|min:0',
            'features_raw' => 'required|string',
            'is_recommended' => 'nullable|boolean'
        ]);

        // Explode features by line break
        $features = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $request->features_raw))));

        Package::create([
            'name' => $request->name,
            'price' => $request->price,
            'credits' => $request->credits,
            'features' => array_values($features),
            'is_recommended' => $request->has('is_recommended')
        ]);

        Alert::success('Berhasil', 'Paket top up berhasil ditambahkan!');
        return redirect()->route('package.index');
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        $features_raw = is_array($package->features) ? implode("\n", $package->features) : '';
        return view('pagesuperadmin.package.edit', compact('package', 'features_raw'));
    }

    public function update(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'credits' => 'required|integer|min:0',
            'features_raw' => 'required|string',
            'is_recommended' => 'nullable|boolean'
        ]);

        $features = array_filter(array_map('trim', explode("\n", str_replace("\r", "", $request->features_raw))));

        $package->update([
            'name' => $request->name,
            'price' => $request->price,
            'credits' => $request->credits,
            'features' => array_values($features),
            'is_recommended' => $request->has('is_recommended')
        ]);

        Alert::success('Berhasil', 'Paket top up berhasil diperbarui!');
        return redirect()->route('package.index');
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();

        Alert::success('Berhasil', 'Paket top up berhasil dihapus');
        return redirect()->route('package.index');
    }
}
