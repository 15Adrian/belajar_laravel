@extends('Layouts.master')

@section('title', 'Halaman Mahasiswa')

@section('content')
  <div class="container mt-4">
    <h3 class="mb-3">Data Mahasiswa Baru</h3>

    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary mb-3">Tambah Mahasiswa</a>
    <table class="table table-bordered">
      <thead class="table-light">
        <tr>
          <th>No</th>
          <th>NIM</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($semuaData as $item)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nim }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->kelas }}</td>
            <td>
              <a href="{{ route('mahasiswa.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

              <form action="{{ route('mahasiswa.destroy', $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                  Hapus
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center">Belum ada data mahasiswa.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
