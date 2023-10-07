<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $data_brand = Brand::orderBy('created_at', 'DESC')->get();

        return view('brand.index', compact('data_brand'));
    }

    public function create()
    {
        return view('brand.create');
    }

    public function store(Request $request)
    {
        // validasi form
        $this->validate($request, [
            'name' => 'required',
        ],[
            'name.required' => 'Nama brand harus diisi',
        ]);

        // insert data ke tabel brands
        Brand::create([
            'name' => $request->name,
        ]);

        return redirect()
                ->route('brand.index')
                ->with('success', 'Berhasil menambahkan data brand');
    }
    public function edit($id)
    {
        $brand = brand::findOrFail($id);

        return view('brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        // validasi form
        $this->validate($request, [
            'name' => 'required',
        ],[
            'name.required' => 'Nama brand harus diisi',
        ]);

        // update data ke tabel brands
        Brand::findOrFail($id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('brand.index')->with('success', 'Berhasil mengupdate data brand');
    }

    public function destroy($id)
    {
        //get id
        $brand = Brand::findOrFail($id);
        //delete data
        $brand->delete();

        return redirect()->route('brand.index')->with('success', 'Berhasil menghapus data brand');
    }
}

