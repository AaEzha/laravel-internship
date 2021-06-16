@extends('front.layout')

@section('content')

<img src="{{ asset('img/homepic.jpg') }}" id="img1">

<!-- Berfungsi untuk membuat container yg bertujuan untnuk membuat form cari lowongan-->
<div class="container">
        <div class="top-left">
            <form id="formcarikerja" clas="form-control form-control-lg">
                <h1 style="color: white;">Jenis Pekerjaan</h1>
                <input type="text" id="jenisjob" placeholder="Designing">
                <br>
                <h1 style="color: white;position:relative;bottom:-60px;">Wilayah</h1>
                <input type="text" id="wilayah" placeholder="Bandung">
                <br>
                <h1 style="color: white;position:relative;bottom:-120px;">Spesialisasi</h1>
                <input type="text" id="spesialisasi" placeholder="Quality Assurance">

                <button type="button" class="btn btn-primary btn btn-lg" id="buttoncari">Cari Lowongan !</button>
            </form>
        </div>
</div>



@endsection
