<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return view('brand.index');
    }

    public function store(Request $request)
    {
        // validasi form
        $this->validate($request, [
            'name' => 'required',
        ]);

        // insert data ke tabel brands
        Brand::create([
            'name' => $request->name,
        ]);

        return redirect()
                ->route('brand')
                ->with('success', 'Berhasil menambahkan data brand');
    }
}
