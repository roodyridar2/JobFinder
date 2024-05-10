@extends('layouts.app')



@section('content')
    <style>
        .form-control:focus {
            border-color: rgba(8, 8, 25, 0.25) !important;
            box-shadow: 0 0 4px rgba(6, 7, 28, 0.8) !important;
        }
    </style>
    <section class="section-hero overlay inner-page bg-image"
        style="background-image:url({{ asset('assets/images/work.jpg') }})" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">Log In</h1>
                    <div class="custom-breadcrumbs">
                        <a href="#" class="text-white">Home</a> <span class="mx-2 slash">/</span>
                        <span class="text-white"><strong>Log In</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <form style="margin : 20px" action="{{ route('login') }}" method="POST" class="p-4 border rounded">
                    @csrf
                    {{-- email input --}}
                    <div class="row form-group">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    {{-- password input --}}
                    <div class="row form-group mb-4">
                        <div class="col-md-12 mb-3 mb-md-0">
                            <label class="text-black" for="password">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <input type="submit" name="submit" value="Log In" class="btn px-4 btn-dark text-white">
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
