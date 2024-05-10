@extends('layouts.app')

@section('content')
    <section class="section-hero overlay inner-page bg-image"
        style="background-image: url('{{ asset('assets/images/work.jpg') }}');" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="custom-breadcrumbs">
                        <a href="{{ route('home') }}" class="text-white">Home</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong>applications</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container">

            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="section-title mb-2">{{ $totalApply }} Job apply</h2>
                </div>
            </div>

            <ul class="job-listings mb-5">
                @foreach ($applications as $application)
                    <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                        <a href="{{ route('jobs.single', ['id' => $application->job->id]) }}"></a>
                        <div class="job-listing-logo">
                            @if ($application->job->image )
                                <img src="{{ $application->job->image }}" alt="Free Website Template by Free-Template.co"
                                     class="img-fluid">
                            @else
                                <img src="{{  asset('assets/images/work.jpg')}}" alt="Free Website Template by Free-Template.co"
                                     class="img-fluid">
                            @endif
                        </div>

                        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                            <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                                <h2>{{  $application->job->title }}</h2>
                                <strong>{{  $application->job->company }}</strong>
                            </div>
                            <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                                <span class="icon-room"></span> {{  $application->job->job_region }}
                            </div>
                            <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                                {{-- category icon --}}

                                <span class="icon-room"></span> {{  $application->job->category }}
                            </div>
                            <div class="job-listing-meta">
                                <span class="badge badge-danger">{{  $application->job->job_type }}</span>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
