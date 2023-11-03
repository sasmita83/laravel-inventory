@extends('master.all')
@section('master-konten')

@if (isset($barang[0]))

@php

    // Konversi tanggal format sql menjadi gampang di baca
    $tanggal_dibuat = new DateTime($barang[0]->dibuat_kapan);
    $dibuat = $tanggal_dibuat ->format('D, d M Y');

    // Konversi tanggal format sql menjadi gampang di baca
    $tanggal_diperbaharui = new DateTime($barang[0]->dibuat_kapan);
    $diperbaharui = $tanggal_diperbaharui ->format('D,d M Y');

@endphp

<div class="card w-50 shadow ">

    <div class="card-body">
      <h5 class="card-title">{{ $barang[0]->kode }}</h5>
      <h6 class="card-title">{{ $barang[0]->nama }}</h6>
      <p class="card-text">{{ $barang[0]->deskripsi }}</p>
      <span class="card-text">Dibuat : {{ $barang[0]->dibuat_kapan }} | {{ $barang[0]->dibuat_nama }}</span><br>
      <span class="card-text">Terakhir Diperbaharui : {{ $diperbaharui }} | {{ $barang[0]->diperbaharui_nama }}</span>

    </div>
  </div>
  @else
  <h2> TIDAK ADA DATA </h2>
  @endif

@endsection
