<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShowcaseItem;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class ManageShowcaseItemController extends Controller
{
    public function index()
    {
        $items = ShowcaseItem::orderBy('created_at', 'desc')->get();
        return view('pagesuperadmin.showcase.index', compact('items'));
    }

    public function create()
    {
        return view('pagesuperadmin.showcase.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_label' => 'required|string|max:100',
            'label_before' => 'required|string|max:50',
            'label_after' => 'required|string|max:50',
            'image_before' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
            'image_after' => 'required|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $data = $request->only(['title', 'description', 'category_label', 'label_before', 'label_after']);

        // Upload folder
        $path = public_path('uploads/showcase');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        // Before Image
        if ($request->hasFile('image_before')) {
            $file = $request->file('image_before');
            $filename = time() . '_before_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['image_before'] = 'uploads/showcase/' . $filename;
        }

        // After Image
        if ($request->hasFile('image_after')) {
            $file = $request->file('image_after');
            $filename = time() . '_after_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['image_after'] = 'uploads/showcase/' . $filename;
        }

        ShowcaseItem::create($data);

        Alert::success('Berhasil', 'Kartu galeri perbandingan berhasil ditambahkan!');
        return redirect()->route('brand.index'); // We will redirect to showcase.index but let's register the routes first
    }

    public function edit($id)
    {
        $item = ShowcaseItem::findOrFail($id);
        return view('pagesuperadmin.showcase.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = ShowcaseItem::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_label' => 'required|string|max:100',
            'label_before' => 'required|string|max:50',
            'label_after' => 'required|string|max:50',
            'image_before' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'image_after' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $data = $request->only(['title', 'description', 'category_label', 'label_before', 'label_after']);

        $path = public_path('uploads/showcase');

        if ($request->hasFile('image_before')) {
            // Delete old file
            if ($item->image_before && File::exists(public_path($item->image_before))) {
                File::delete(public_path($item->image_before));
            }
            $file = $request->file('image_before');
            $filename = time() . '_before_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['image_before'] = 'uploads/showcase/' . $filename;
        }

        if ($request->hasFile('image_after')) {
            // Delete old file
            if ($item->image_after && File::exists(public_path($item->image_after))) {
                File::delete(public_path($item->image_after));
            }
            $file = $request->file('image_after');
            $filename = time() . '_after_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $filename);
            $data['image_after'] = 'uploads/showcase/' . $filename;
        }

        $item->update($data);

        Alert::success('Berhasil', 'Kartu perbandingan berhasil diperbarui!');
        return redirect()->route('showcase.index');
    }

    public function destroy($id)
    {
        $item = ShowcaseItem::findOrFail($id);

        // Delete files
        if ($item->image_before && File::exists(public_path($item->image_before))) {
            File::delete(public_path($item->image_before));
        }
        if ($item->image_after && File::exists(public_path($item->image_after))) {
            File::delete(public_path($item->image_after));
        }

        $item->delete();

        Alert::success('Berhasil', 'Kartu perbandingan berhasil dihapus');
        return redirect()->route('showcase.index');
    }
}
