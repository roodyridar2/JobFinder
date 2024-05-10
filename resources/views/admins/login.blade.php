@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">

            @if (Session::has('error'))
                <div class="alert alert-danger">
                    <p>{{ Session::get('error') }}</p>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mt-5">Login</h5>
                    <form method="POST" action="{{ route('admin.login') }}" class="p-auto" action="login.php">
                        @csrf
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" name="email" id="form2Example1" class="form-control"
                                placeholder="Email" />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" name="password" id="form2Example2" placeholder="Password"
                                class="form-control" />
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection
