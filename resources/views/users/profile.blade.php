@extends('layouts.app')
@section('content')
    <section class="section-hero overlay inner-page bg-image"
        style="background-image: url({{ asset('assets/images/hero_1.jpg') }})" id="home-section">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7">
                    <div class="card p-3 py-4">
                        @if (Session::has('message'))
                            <div class="alert alert-success">
                                <p>{{ Session::get('message') }}</p>
                            </div>
                        @endif
                        <div class="text-center">
                            {{-- check image is null --}}
                            @if ($profile->image)
                                <img src="{{ asset('assets/images_users/' . $profile->image) }}" width="100"
                                    class="rounded-circle" />
                            @else
                                <img src="{{ asset('assets/images/hero_1.jpg ') }}" width="100" class="rounded-circle" />
                            @endif
                        </div>

                        <div class="text-center mt-3">
                            <h5 class="mt-2 mb-0">{{ $profile->name }}</h5>
                            <span>{{ $profile->job_title }}</span>
                            <a href="{{ asset('assets/cvs/' . $profile->cv) }}" class="btn btn-dark mt-4 mb-3 btn-block ">
                                Download CV
                            </a>

{{--                            <div class="px-4 mt-1">--}}
{{--                                <p class="fonts">--}}
{{--                                    {{ $profile->bio }}--}}
{{--                                </p>--}}
{{--                            </div>--}}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
