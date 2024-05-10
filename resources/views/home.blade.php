@extends('layouts.app')

@section('content')


    <section class="home-section section-hero overlay bg-image"
        style="background-image: url({{ asset('assets/images/work.jpg') }});" id="home-section">

        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-12">
                    <div class="mb-5 text-center">
                        <h1 class="text-white font-weight-bold">The Easiest Way To Get Your Dream Job</h1>
                        <p>Achieving your dream job with minimal effort is possible by implementing this straightforward approach.</p>
                    </div>
                    <form method="get" class="search-jobs-form" action="{{ route('home') }}">
                        @csrf
                        <div class="row mb-5">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                <input name="job_title" type="text" class="form-control form-control-lg"
                                    placeholder="Job title">
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                <select name="category" class="selectpicker" data-style="btn-white btn-lg" data-width="100%"
                                    data-live-search="true" title="Select category">
                                    @foreach ($categories as $category)
                                        <option>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                <select name="job_type" class="selectpicker" data-style="btn-white btn-lg" data-width="100%"
                                    data-live-search="true" title="Select Job Type">
                                    @foreach ($jobTypes as $jobType)
                                        <option>{{ $jobType->job_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                                <button name="submit" type="submit"
                                    class="btn btn-primary btn-lg btn-block text-white btn-search">
                                    <span class="icon-search icon mr-2"></span>
                                    Search Job
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <a href="#bottom" class="scroll-button smoothscroll">
            <span class=" icon-keyboard_arrow_down"></span>
        </a>

    </section>


    <section class="site-section">
        <div class="container">
            @if($totalJobs >0)

            <div class="row mb-5 justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="section-title mb-2">{{ $totalJobs }} Job Listed</h2>

                </div>
            </div>
            @endif

            <ul class="job-listings mb-5">
                @foreach ($jobs as $job)
                    <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                        <a href="{{ route('jobs.single', ['id' => $job->id]) }}"></a>
                        <div class="job-listing-logo">
                            {{-- {{ asset('assets/images' . $job->image) }} --}}
                            @if ($job->image)
                                <img src="{{ asset('assets/images_jobs/' . $job->image)}}" alt="Free Website Template by Free-Template.co"
                                    class="img-fluid" />
                            @else
                            <img src="{{  asset('assets/images/work.jpg')}}" alt="Free Website Template by Free-Template.co"
                                class="img-fluid">
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
{{--            @if ($totalPages > 1)--}}
{{--                <div class="pagination">--}}
{{--                    @for ($i = 1; $i <= $totalPages; $i++)--}}
{{--                        <a class="{{ $currentPage == $i ? 'active' : '' }}" href="?page={{ $i }}">{{ $i }}</a>--}}
{{--                    @endfor--}}
{{--                </div>--}}
{{--            @endif--}}

            <!-- Bootstrap Pagination links -->
            @if ($totalPages > 1)
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
                            <a class="page-link" href="?page=1" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">First</span>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $totalPages; $i++)
                            <li class="page-item  {{ $currentPage == $i ? 'active' : '' }}">
                                <a class="page-link {{ $currentPage == $i ? 'bg-dark border border-dark' : '' }}"  href="?page={{ $i }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
                            <a class="page-link" href="?page={{ $totalPages }}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Last</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            @endif


        </div>

    </section>




@endsection
