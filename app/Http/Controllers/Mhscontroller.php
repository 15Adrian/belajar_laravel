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

    public function saveData(Request $request)
    {
        $request->validate([
            'nim'=>'required|min:5|max:10|unique:App\Models\MahasiswaModel,nim',
            'nama'=>'required|min:5',
            'kelas'=>'required|string|max:50',
            'foto'=>'nullable|mimes:jpg,png|max:1024',
        ]);

        if($request->hasFile('foto')){
            $fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('foto'),$fileName);
            // $validated['foto'] = $request->file('foto')->store('foto','public');
        }
        $data = new MahasiswaModel();
        $data['nim'] = $request->nim;
        $data['nama'] = $request->nama;
        $data['kelas'] = $request->kelas;
        $data['foto'] = $fileName;
        $data->save();
        return redirect()->route('mhs-baru');
        // INSERT INTO tabel_mhs VALUES ('','','');
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
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('foto'), $fileName); // disimpan di public/foto
        $validatedData['foto'] = $fileName;
        }

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
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $mahasiswa = MahasiswaModel::findOrFail($id);

        if ($request->hasFile('foto')) {
            if ($mahasiswa->foto && file_exists(public_path('foto/' . $mahasiswa->foto))) {
            unlink(public_path('foto/' . $mahasiswa->foto));
        }

        $file = $request->file('foto');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('foto'), $fileName);
        $validatedData['foto'] = $fileName;
    }
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
