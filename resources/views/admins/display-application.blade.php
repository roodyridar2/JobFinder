@extends('layouts.admin')
@section('content')
    @if (Session::has('message'))
        <div class="alert alert-success">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Job Applications</h5>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">job title</th>
                                <th scope="col">company</th>
                                <th scope="col">user name</th>
                                <th scope="col">email</th>
                                <th scope="col">cv</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($applications as $application)
                                <tr>
                                    <th scope="row">{{ $application->id }}</th>
                                    <td>{{ $application->job->title }}</td>
                                    <td>{{ $application->job->company }}</td>
                                    <td>{{ $application->user->name }}</td>
                                    <td>{{ $application->user->email }}</td>
                                    @if ($application->user->cv == null)
                                        <td>No CV</td>
                                    @else
                                        <td><a href="{{ asset('assets/cvs/' . $application->user->cv) }}"
                                               target="_blank">View CV</a></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
