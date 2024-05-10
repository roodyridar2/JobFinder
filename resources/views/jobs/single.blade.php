@extends('layouts.app')

@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image"
        style="background-image: url('{{ asset('assets/images/work.jpg') }}');" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">{{ $job->title }}</h1>
                    <div class="custom-breadcrumbs">
                        <a href="{{ route('home') }}" class="text-white">Home</a> <span class="mx-2 slash ">/</span>
                        {{-- <a href="#">Job</a> <span class="mx-2 slash">/</span> --}}
                        <span class="text-white"><strong>{{ $job->title }}</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (Session::has('message'))
        <div class="alert alert-success">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif

    @if (Session::has('apply'))
        <div class="alert alert-success">
            <p>{{ Session::get('apply') }}</p>
        </div>
    @endif

    <section class="site-section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center">

                        <div>
                            <h2>{{ $job->title }}</h2>
                            <div>
                                <span class="ml-0 mr-2 mb-2"><span
                                        class="icon-briefcase mr-2"></span>{{ $job->company }}</span>
                                <span class="m-2"><span class="icon-room mr-2"></span>{{ $job->job_region }}</span>
                                <span class="m-2"><span class="icon-clock-o mr-2"></span>
                                    <span class="text-primary">{{ $job->job_type }}</span>
                                </span>
                                <span class="icon-room"></span><span> {{ $job->category }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-5">

                            @if ($job->image)
                                <img src="{{ asset('assets/images_jobs/' . $job->image)}}" alt="Free Website Template by Free-Template.co"
                                     class="img-fluid" />
                            @else
                                <img src="{{  asset('assets/images/work.jpg')}}" alt="Free Website Template by Free-Template.co"
                                     class="img-fluid rounded w-50 p-3" >
                            @endif
                            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span
                                    class="icon-align-left mr-3"></span>Job Description</h3>
                            <p>{{ $job->jobdescription }}</p>
                        </div>
                        <div class="mb-5">
                            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span
                                    class="icon-rocket mr-3"></span>Responsibilities</h3>
                            <p>{{ $job->responsibilities }}</p>
                        </div>

                        <div class="mb-5">
                            <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span
                                    class="icon-book mr-3"></span>Education + Experience</h3>
                            <p>{{ $job->education_experience }}</p>
                        </div>

                        <div class="row mb-5">
                            @if (Auth::user())
                                <div class="col-6">
                                    <form action="{{ route('jobs.save') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $job->id }}" name="job_id">
                                        {{-- <input type="text" value="{{ Auth::user()->id }}" name="user_id"> --}}
                                        @if ($isSavedJob)
                                            <button disabled class="btn btn-block btn-success btn-md"><i
                                                    class="icon-heart"></i>
                                                you already saved Job
                                            </button>
                                        @else
                                            <button name="submit" type="submit" class="btn btn-block btn-light btn-md"><i
                                                    class="icon-heart"></i>Save
                                                Job</button>
                                        @endif
                                    </form>
                                </div>

                                {{-- apply job --}}
                                <div class="col-6">
                                    <form action="{{ route('jobs.apply') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $job->id }}" name="job_id">
                                        {{-- <input type="hidden" value="{{ Auth::user()->id }}" name="user_id"> --}}
                                        @if ($isAppliedJob)
                                            <button disabled class="btn btn-block btn-success btn-md"><i
                                                    class="icon-heart"></i>
                                                you already applied Job
                                            </button>
                                        @else
                                            <button name="submit" type="submit"
                                                class="btn btn-block btn-primary btn-md"><i class="icon-heart"></i>Apply
                                                Job</button>
                                        @endif
                                </div>
                            @else
                                <button  class="btn btn-block btn-primary btn-md text-white">
                                    <a href="{{ route('login') }}" class="text-white">Login to save or apply job</a>
                                </button>
                            @endif

                        </div>
                    </div>
                    <div class="col-lg-4">
                        {{-- job summary --}}
                        <div class="bg-light p-3 border rounded mb-4">
                            <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Job Summary</h3>
                            <ul class="list-unstyled pl-3 mb-0">
                                <li class="mb-2"><strong class="text-black">Published on:</strong> {{ $job->created_at }}
                                </li>
{{--                                <li class="mb-2"><strong class="text-black">Vacancy:</strong> {{ $job->vacancy }} </li>--}}
                                <li class="mb-2"><strong class="text-black">Employment Status:</strong>
                                    {{ $job->job_type }}</li>
                                <li class="mb-2"><strong class="text-black">Experience:</strong>{{ $job->experience }}
                                    year(s)</li>
                                <li class="mb-2"><strong class="text-black">Job Location:</strong> {{ $job->job_region }}
                                </li>
                                <li class="mb-2"><strong class="text-black">Salary:</strong> {{ $job->salary }}$</li>
                                <li class="mb-2"><strong class="text-black">Gender:</strong> {{ $job->gender }}</li>
                                <li class="mb-2"><strong class="text-black">Application Deadline:</strong>
                                    {{ $job->application_deadline }}</li>
                            </ul>
                        </div>



                        {{-- categories --}}
                        <div class="bg-light p-3 border rounded mb-4">
                            <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Categories</h3>
                            <ul class="list-unstyled pl-3 mb-0">
                                @foreach ($categories as $category)
                                    <li class="mb-2"><a
                                            href="{{ route('categories.single', [$category->name]) }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{--    related jobs--}}
    <section class="site-section" id="next">
        <div class="container">
            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
{{--                    {{ $totalRelatedJobs }}--}}
                    <h2 class="section-title mb-2"> Related Jobs</h2>
                </div>
            </div>

            <ul class="job-listings mb-5">
                @foreach ($relatedJobs as $job)
                    <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                        <a href="{{ route('jobs.single', ['id' => $job->id]) }}"></a>
                        <div class="job-listing-logo">
{{--                            <img src="{{ $job->image }}" alt="Free Website Template by Free-Template.co"--}}
{{--                                class="img-fluid">--}}
                            @if ($job->image)
                                <img src="{{ asset('assets/images_jobs/' . $job->image)}}" alt="Free Website Template by Free-Template.co"
                                     class="img-fluid" />
                            @else
                                <img src="{{  asset('assets/images/work.jpg')}}" alt="Free Website Template by Free-Template.co"
                                     class="img-fluid rounded " >
                            @endif
                        </div>

                        <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                            <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                                <h2>{{ $job->title }}</h2>
                                <strong>{{ $job->company }}</strong>
                            </div>

                            <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                                <span class="icon-room"></span> {{ $job->job_region }}
                            </div>
                            <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                                {{-- category icon --}}

                                <span class="icon-room"></span> {{ $job->category }}
                            </div>
                            <div class="job-listing-meta">
                                <span class="badge badge-danger">{{ $job->job_type }}</span>
                            </div>
                        </div>

                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
