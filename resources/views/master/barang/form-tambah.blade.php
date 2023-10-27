@extends('master.all')
@section('master-konten')

<form action="{{ route ('master-barang-simpan') }}" method="post">

<div class="mb-3">
    <label for="html_kode class="form-label">Kode</label>
    <input type="text" class="form-control w-50" id="html_kode" placeholder="kode barang">
</div>
<div class="mb-3">
    <label for="html_nama class="form-label">nama</label>
    <input type="text" class="form-control w-50" id="html_nama" placeholder="nama barang">
</div>
  <div class="mb-3">
    <label for="html_deskripsi" class="form-label">deskripsi</label>
    <textarea class="form-control" id="html_deskripsi" rows="3"></textarea>
  </div>
<button type="submit" class="btn btn-primary">
<i class="fa fa-solid fa-save me-2"></i>Simpan

</form>
@endsection
