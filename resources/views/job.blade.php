@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail Job') }}</h1>

    <!-- Main Content goes here -->

    <div class="row">
        <div class="col-md-4 order-lg-2">
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset('storage/'.$job->image) }}" class="img-fluid mb-4">
                    <h6 class="heading-small text-muted mb-4">Employer Detail</h6>

                    @php
                        $image = $job->company->image ?? "default.png";
                    @endphp
                    <img src="{{ asset('storage/'.$image) }}" class="img-fluid mb-4">
                    <p class="text-center font-weight-bold">{{ $job->company->name }}</p>
                    <p class="text-center">{{ $job->company->email }} | {{ $job->company->phone }}</p>
                </div>

            </div>
        </div>
        <div class="col-md-8 order-lg-1">
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Information</h6>
                </div>

                <div class="card-body">

                    <h6 class="heading-small text-muted mb-4">Deskripsi</h6>
                    {!! $job->detail !!}

                    <div class="row mb-4">
                        <div class="col">
                            <h6 class="heading-small text-muted mb-4">Wilayah</h6>
                            {{ $job->wilayah }}
                        </div>
                        <div class="col">
                            <h6 class="heading-small text-muted mb-4">Spesialisasi</h6>
                            {{ $job->spesialisasi }}
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <h6 class="heading-small text-muted mb-4">Gaji</h6>
                            {{ $job->gaji }} per {{ $job->gaji_satuan }}
                        </div>
                        <div class="col">
                            <h6 class="heading-small text-muted mb-4">Closed at</h6>
                            {{ $job->closed_at->diffForHumans() }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <!-- End of Main Content -->
@endsection

@push('notif')
@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('status'))
    <div class="alert alert-success border-left-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@endpush
