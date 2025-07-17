@extends('Layouts.master')

@section('title', 'Edit Data Mahasiswa')

@section('content')
  <div class="container mt-4">
    <h3 class="mb-4">✏️ Edit Data Mahasiswa</h3>

    {{-- Form Edit --}}
    <form action="{{ route('mahasiswa.update', $data->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input name="nim" type="text" class="form-control @error('nim') is-invalid @enderror"
               value="{{ old('nim', $data->nim) }}" placeholder="Masukkan NIM">
        @error('nim')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
               value="{{ old('nama', $data->nama) }}" placeholder="Masukkan Nama">
        @error('nama')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="kelas" class="form-label">Kelas</label>
        <input name="kelas" type="text" class="form-control @error('kelas') is-invalid @enderror"
               value="{{ old('kelas', $data->kelas) }}" placeholder="Masukkan Kelas">
        @error('kelas')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-success">Simpan Perubahan</button>
      <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
    </form>
  </div>
@endsection
