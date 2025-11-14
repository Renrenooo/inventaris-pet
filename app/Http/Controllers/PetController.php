<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function index()
    {
         $pets = Pet::where('account_id', Auth::id())->get();
         $search = request('search');

    if ($search) {
        $pets = Pet::where('account_id', Auth::id())
                    ->where('nama_pet', 'like', "%{$search}%")
                    ->get();
    } else {
        $pets = Pet::where('account_id', Auth::id())->get();
    }
        return view('pets.index', compact('pets'));

    }

    public function create()
    {
        return view('pets.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'nama_pet' => 'required|string|max:255',
        'jumlah' => 'required|integer|min:1',
        'berat' => 'required|numeric|min:1',
    ]);
    $total = Pet::where('account_id', Auth::id())->sum('jumlah');
    if ($total + $request->jumlah > 60) {
        return back()->with('error', 'Maksimal total 60 pet per akun!');
    }
    $pet = Pet::where('account_id', Auth::id())
              ->where('nama_pet', $request->nama_pet)
              ->first();

    if ($pet) {
        $pet->jumlah += $request->jumlah;
        $pet->save();
    } else {
        Pet::create([
            'account_id' => Auth::id(),
            'nama_pet' => $request->nama_pet,
            'jumlah' => $request->jumlah,
            'berat' => $request->berat,
        ]);
    }

    return redirect()->route('pets.index')->with('success', 'Pet berhasil ditambahkan!');
}


    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        $total = Pet::where('account_id', Auth::id())->sum('jumlah') - $pet->jumlah;
        if ($total + $request->jumlah > 60) {
            return back()->with('error', 'Maksimal total 60 pet per akun!');
        }

        $request->validate([
            'nama_pet' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'berat' => 'required|numeric|min:1',
        ]);

        $pet->update([
            'nama_pet' => $request->nama_pet,
            'jumlah' => $request->jumlah,
            'berat' => $request->berat,
        ]);

        return redirect()->route('pets.index')->with('success', 'Pet berhasil diupdate!');
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();
        return redirect()->route('pets.index')->with('success', 'Pet berhasil dihapus!');
    }
}
