@extends('layouts.app')

@section('content')
    <!-- HOME -->
    <section class="section-hero overlay inner-page bg-image"
        style="background-image: url('{{ asset('assets/images/hero_1.jpg') }}');" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h1 class="text-white font-weight-bold">Edit profile</h1>
                    <div class="custom-breadcrumbs">
                        <a href="{{ route('home') }}">Home</a> <span class="mx-2 slash">/</span>
                        {{-- <a href="#">Job</a> <span class="mx-2 slash">/</span> --}}
                        <span class="text-white"><strong>Edit profile</strong></span>
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
            <form class="p-4 p-md-5 border rounded" action="{{ route('profile.update') }}" method="post"
                enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $profile->name }}">
                    @error('name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

               {{-- <div class="form-group hidden-true">
                    <label for="job_title">job title</label>
                    <input type="text" name="job_title" class="form-control" value="{{ $profile->job_title }}">
                    @error('job_title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>--}}

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea name="bio" class="form-control" id="" cols="30" rows="10">
                        {{ $profile->bio }}
                    </textarea>
                    @error('bio')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="gender">gender</label>
                    <select name="gender" class="form-control">
                        <option value="male" {{ $profile->gender == 'male' ? 'selected' : '' }}>male</option>
                        <option value="femail" {{ $profile->gender == 'female' ? 'selected' : '' }}>female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="facebook">facebook</label>
                    <input type="text" name="facebook" class="form-control" value="{{ $profile->facebook }}">
                </div>

                <div class="form-group">
                    <label for="facebook">twitter</label>
                    <input type="text" name="twitter" class="form-control" value="{{ $profile->twitter }}">
                </div>

                <div class="form-group">
                    <label for="linkedin">linkedin</label>
                    <input type="text" name="linkedin" class="form-control" value="{{ $profile->linkedin }}">
                </div>

                {{-- update image upload --}}

                <div class="form-group mt-4 btn-dark w-25 " >
                    <input type="file" name="image" class="form-control-file " >
                </div>


                {{-- submit button --}}
                <button type="submit"  class="btn-dark rounded-sm " name="submit">Update</button>

            </form>
        </div>
    </div>
@endsection
