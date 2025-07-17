<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaModel;
use Illuminate\Http\Request;

class Mhscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semuaData = MahasiswaModel::all();
        return view('mhs', compact('semuaData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mhsinsert');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required|string|unique:mahasiswa,nim|max:10',
            'nama' => 'required|string|max:225',
            'kelas' => 'required|string|max:50',
        ]);

        MahasiswaModel::create($validatedData);

        return redirect()->route('mahasiswa.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = MahasiswaModel::findOrFail($id);
        return view('mhsedit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nim' => 'required|string|max:10|unique:mahasiswa,nim,' . $id,
            'nama' => 'required|string|max:225',
            'kelas' => 'required|string|max:50',
        ]);

        $mahasiswa = MahasiswaModel::findOrFail($id);
        $mahasiswa->update($validatedData);

        return redirect()->route('mahasiswa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = MahasiswaModel::findOrFail($id);
        $mahasiswa->delete();

    return redirect()->route('mahasiswa.index');
    }
}
