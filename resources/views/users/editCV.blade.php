@extends('layouts.app')

@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image"
        style="background-image: url('{{ asset('assets/images/hero_1.jpg') }}');" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">Edit CV</h1>
                    <div class="custom-breadcrumbs">
                        <a href="{{ route('home') }}">Home</a> <span class="mx-2 slash">/</span>
                        {{-- <a href="#">Job</a> <span class="mx-2 slash">/</span> --}}
                        <span class="text-white"><strong>Edit-CV</strong></span>
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

    <div class="row mb-5">
        <div class="col-lg-12">
            <form class="p-4 p-md-5 border rounded" action="{{ route('cv.update') }}" method="post"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="cv">CV</label>
                    <input type="file" name="cv" class="form-control">
                    @error('cv')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" name="submit" class=" btn btn-success ">Update</button>

            </form>
        </div>
    </div>
@endsection
