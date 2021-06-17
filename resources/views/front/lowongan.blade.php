@extends('front.layout')

@section('content')
<div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php $no = 0; ?>
        @foreach ($companies as $com)
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $no++ }}" class="active" aria-current="true" aria-label="Slide 1"></button>
      @endforeach
      {{-- <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button> --}}
    </div>
    <div class="carousel-inner">
        @foreach ($companies as $com)
        <?php $image = $com->image ?? "default.png"; ?>
        <div class="carousel-item active">
          <img src="{{ asset('storage/'. $image) }}" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>{{ $com->name }}</h5>
          </div>
        </div>
        @endforeach
      {{-- <div class="carousel-item">
        <img src="img/pwc.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>PWC</h5>
        </div>
      </div>
      <div class="carousel-item">
        <img src="img/telkom.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>Telkom</h5>
        </div>
      </div> --}}
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"  data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
<!--Carousel End-->
<br>
<br>

<!-- Berfungsi untuk membuat class view Card untuk memberikan detail tentang setiap lowongan yang akan ditambahkan -->
<section class="details-card">
  <h2 style="position: relative;right:-15px;">Lowongan Tersedia Saat Ini</h2>
  <br>
    <div class="container">
        <div class="row">
            <?php $no = 1; ?>
            @foreach ($jobs as $job)
            <?php $image = $com->image ?? "default.png"; ?>
            <div class="col-md-4">
                <div class="card-content">
                    <div class="card-img">
                        <img src="{{ asset('storage/'. $image) }}" alt="">
                    </div>
                    <div class="card-desc">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info"><i class="fa fa-briefcase"style="font-size:20px;"></i>   {{ $job->company->name }}</li>
                            <li class="list-group-item list-group-item-success"><i class="fa fa-user"style="font-size:20px;"></i>   {{ $job->jenis }}</li>
                            <li class="list-group-item list-group-item-success"><i class="fa fa-map-marker"style="font-size:20px;"></i>   {{ $job->wilayah }}</li>
                            <li class="list-group-item list-group-item-success"><i class="fa fa-clock-o"style="font-size:20px;"></i>   {{ $job->closed_at->diffForHumans() }}</li>
                            <li class="list-group-item list-group-item-success"><i class="fa fa-inr"style="font-size:20px;"></i>   {{ $job->gaji }} / {{ $job->gaji_satuan }}</li>
                        </ul>
                        <br>
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('lowongan.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="job_id" value="{{ $job->id }}">
                                    <button class="btn-card" type="submit">Apply</button>
                                </form>
                            </div>
                            <div class="col">
                                <a href="#" data-target="#Modal<?=$no++;?>" data-toggle="modal" style="position: relative;right: -30%;color: #000000;">Read More...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- <div class="col-md-4">
                <div class="card-content">
                    <div class="card-img">
                        <img src="img/telkom.png" alt="">
                    </div>
                    <div class="card-desc">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info"><i class="fa fa-briefcase"style="font-size:20px;"></i>   Telkomsel</li>
                            <li class="list-group-item list-group-item-success"><i class="fa fa-user"style="font-size:20px;"></i>   Database Admin</li>
                            <li class="list-group-item list-group-item-success"><i class="fa fa-map-marker"style="font-size:20px;"></i>   Jakarta</li>
                            <li class="list-group-item list-group-item-success"><i class="fa fa-clock-o"style="font-size:20px;"></i>   2 Bulan</li>
                            <li class="list-group-item list-group-item-success"><i class="fa fa-inr"style="font-size:20px;"></i>   Rp 1.000.000 / 2 Bulan</li>
                       </ul>
                       <br>
                       <a href="#" class="btn-card">Apply</a>
                       <a href="#Modal2" data-toggle="modal" style="position: relative;right: -30%;color: #000000;">Read More...</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-content">
                    <div class="card-img">
                        <img src="img/pwc.png" alt="">
                    </div>
                    <div class="card-desc">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info"><i class="fa fa-briefcase"style="font-size:20px;"></i>   PwC</li>
                            <li class="list-group-item list-group-item-success"><i class="fa fa-user"style="font-size:20px;"></i>   Back-end Engineer</li>
                            <li class="list-group-item list-group-item-success"><i class="fa fa-map-marker"style="font-size:20px;"></i>   Jakarta</li>
                            <li class="list-group-item list-group-item-success"><i class="fa fa-clock-o"style="font-size:20px;"></i>   3 Bulan</li>
                            <li class="list-group-item list-group-item-success"><i class="fa fa-inr"style="font-size:20px;"></i>   Rp 2.000.000 / 3 Bulan</li>
                       </ul>
                       <br>
                       <a href="#" class="btn-card">Apply</a>
                       <a href="#Modal3" data-toggle="modal" style="position: relative;right: -30%;color: #000000;">Read More...</a>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>

<!-- Tiap modal mempresentasikan tiap lowongan yang ada, yang sebelumnya class nya telah dibuat diatas-->

<?php $no = 1; ?>
@foreach ($jobs as $job)
<!-- Modal 1 -->
<div class="modal fade" id="Modal<?=$no++;?>" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deskripsi Pekerjaan</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {!! $job->detail !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach

{{-- <!-- Modal 2 -->
<div class="modal fade" id="Modal2" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deskripsi Pekerjaan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, ea magnam modi reiciendis vel, ut vero, necessitatibus optio eum non nostrum deleniti aperiam doloribus eveniet blanditiis maxime impedit sit quaerat.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal 3 -->
<div class="modal fade" id="Modal3" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deskripsi Pekerjaan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, ea magnam modi reiciendis vel, ut vero, necessitatibus optio eum non nostrum deleniti aperiam doloribus eveniet blanditiis maxime impedit sit quaerat.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> --}}
@endsection
