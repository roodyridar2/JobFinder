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
              <h5 class="card-title mb-4 d-inline">Jobs</h5>
              <a  href="{{ route('admin.createJob') }}" class="btn btn-dark mb-4 text-center float-right">Create Jobs</a>

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">job title</th>
                    <th scope="col">category</th>
                    <th scope="col">company</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $job)
                    <tr>
                        <th scope="row">{{ $job->id }}</th>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->category }}</td>
                        <td>{{ $job->company }}</td>
                         <td><a href="{{ route('admin.deleteJobs', [$job->id]) }}" class="btn btn-danger  text-center ">delete</a></td>
                      </tr>
                    @endforeach

                </tbody>
              </table>
            </div>
          </div>
          {{-- {{ $jobs->links() }} --}}
        </div>
      </div>

@endsection
