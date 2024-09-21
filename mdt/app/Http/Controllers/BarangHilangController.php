<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\BarangHilang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BarangHilangController extends Controller
{
    public function index()
    {
        return view('buat-laporan', ['title' => 'Buat Laporan Barang Hilang']);
    }
    public function fileUpload(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'alamat_barang' => 'required|string|max:255',
            'deskripsi_barang' => 'required|string',
            'gambar_barang1' => 'required|image|mimes:jpeg,jpg,png',
            'gambar_barang2' => 'nullable|image|mimes:jpeg,jpg,png',
            'gambar_barang3' => 'nullable|image|mimes:jpeg,jpg,png',
            'gambar_barang4' => 'nullable|image|mimes:jpeg,jpg,png',
            'gambar_barang5' => 'nullable|image|mimes:jpeg,jpg,png',
        ]);

        if ($request->hasAny(['gambar_barang1', 'gambar_barang2', 'gambar_barang3', 'gambar_barang4', 'gambar_barang5'])) {
            $gambarFields = ['gambar_barang1', 'gambar_barang2', 'gambar_barang3', 'gambar_barang4', 'gambar_barang5'];
            $paths = [];
            foreach ($gambarFields as $field) {
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $path = $file->storeAs('images/' . Auth::user()->id . '/BarangHilang', $file->hashName(), 'public');
                    $paths[$field] = $path;
                }
            }

            $barangHilang = new BarangHilang();
            $barangHilang->nama_barang = $request->nama_barang;
            $barangHilang->alamat_barang = $request->alamat_barang;
            $barangHilang->deskripsi_barang = $request->deskripsi_barang;
            $tanggal_hilang = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tanggal_hilang)->format('Y-m-d');
            $barangHilang->tanggal_hilang = $tanggal_hilang;
            $barangHilang->user_id = Auth::user()->id;
            foreach ($paths as $field => $path) {
                $barangHilang->$field = $path;
            }
            // dd($barangHilang);
            $barangHilang->save();
            return redirect()->route('lapor.barang')->with('success', 'user added successfully');
        }
    }
    public function showlaporan(Request $request){
        $sortOrder = $request->query('sort', 'latest');

        if ($sortOrder == 'latest') {
            $barangHilang = BarangHilang::with('user')->latest()->get();
        } elseif ($sortOrder == 'oldest') {
            $barangHilang = BarangHilang::with('user')->oldest()->get();
        }
        
        
        return view('laporan', ['title' => 'Barang Hilang'], compact('barangHilang', 'sortOrder'));
    }
}
