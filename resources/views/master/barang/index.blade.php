@extends('master.all')
@section('master-konten')
 halaman master barang <br>
 @foreach ($barang as $b)

{{$b->kode}} <br>
{{$b->nama}} <br>
{{$b->deskripsi}} <br>

@endforeach

@endsection
