@extends('template.index')
@section('konten')
<ul class="nav">
    <li class="nav-item">
      <a class="nav-link {{(Request::segment(2) == 'barang') ? 'bg-warning' : ''}}" href="{{route ('master-barang')}}">Barang</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{(Request::segment(2) == 'kategori') ? 'bg-warning' : ''}}" href="{{route('master-kategori')}}">Kategori</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{(Request::segment(2) == 'gudang') ? 'bg-warning' : ''}}" href="{{route('master-gudang')}}">Gudang</a>
    </li>

  </ul>
  <div class="tab-conten p-4">
    @yield('master-konten')

  </div>
@endsection
