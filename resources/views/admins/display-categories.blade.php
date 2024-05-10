@extends('layouts.admin')
@section('content')
    <div class="row">
            <div class="card col">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Categories</h5>
                    <a href="{{ route('admin.createCategories') }}"
                        class="btn btn-dark mb-4 text-center float-right">Create Categories</a>
                    <table class="table">
                        <thead style="text-align: center; justify-content: center">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">update</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center; justify-content: center">
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td><a href="{{ route('admin.editCategories', [$category->id]) }}"
                                            class="btn btn-warning text-white text-center ">Update </a></td>
                                    <td><a href="{{ route('admin.deleteCategories', [$category->id]) }}"
                                            class="btn btn-danger  text-center ">Delete </a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
            </div>
        </div>
    </div>
@endsection
