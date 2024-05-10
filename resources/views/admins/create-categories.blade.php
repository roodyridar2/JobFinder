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
          <h5 class="card-title mb-5 d-inline">Create Categories</h5>
          <form method="POST" action="{{ route('admin.storeCategories') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-outline mb-4 mt-4">
              <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
              @if ($errors->has('name'))
                  <p class="alert alert-success">{{ $errors->first('username') }}</p>
              @endif
            </div>
  
            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

      
          </form>

        </div>
      </div>
    </div>
</div>

@endsection