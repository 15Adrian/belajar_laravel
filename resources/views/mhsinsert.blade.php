@extends('Layouts.master')

@section('title', 'Halaman Mahasiswa')

@section('content')
  <div class="container mt-4">
    <h3 class="mb-4">Input Data Mahasiswa Baru</h3>

    <form action="{{ route('mahasiswa.store') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="nim" class="form-label">NIM</label>
        <input name="nim" type="number" class="form-control @error('nim') is-invalid @enderror"
              value="{{ old('nim') }}" placeholder="Masukkan NIM">
        @error('nim')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
              value="{{ old('nama') }}" placeholder="Masukkan Nama">
        @error('nama')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="kelas" class="form-label">Kelas</label>
        <input name="kelas" type="text" class="form-control @error('kelas') is-invalid @enderror"
              value="{{ old('kelas') }}" placeholder="Masukkan Kelas">
        @error('kelas')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input name="foto" type="file" id="foto" accept=".jpg,.png">
      </div>

      <button type="submit" class="btn btn-primary">Simpan</button>
      <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
    </form>
  </div>
@endsection
