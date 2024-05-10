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
                    <h5 class="card-title mb-4 d-inline">Create Jobs</h5>

                    <form class="p-4 p-md-5" action="{{ route('admin.storeJobs') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Job Title</label>
                            <input type="text" name="title" class="form-control" id="job-title" placeholder="job title"
                                value="{{ old('title') }}">
                            @if ($errors->has('title'))
                                <p class="alert alert-success">{{ $errors->first('title') }}</p>
                            @endif
                        </div>



                        <div class="form-group">
                            <label for="job-region">Job Region</label>
                            <input type="text" name="job_region" class="form-control" id="job-title"
                                placeholder="job region" value="{{ old('job_region') }}">
                            @if ($errors->has('job_region'))
                                <p class="alert alert-success">{{ $errors->first('job_region') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" name="company" class="form-control" id="job-title" placeholder="company"
                                value="{{ old('company') }}">
                            @if ($errors->has('company'))
                                <p class="alert alert-success">{{ $errors->first('company') }}</p>
                            @endif

                        </div>

                        <div class="form-group">
                            <label for="job_type">Job Type</label>
                            <select name="job_type" class="selectpicker border rounded form-control" id="job-type"
                                data-style="btn-black" data-width="100%" data-live-search="true" title="Select Job Type">
                                @foreach ($jobTypes as $jobType)
                                    <option value="{{ $jobType->job_type }}">{{ $jobType->job_type }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('job_type'))
                                <p class="alert alert-success">{{ $errors->first('job_type') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="experience">Experience</label>
                            <select name="experience" class="selectpicker border rounded form-control" id="job-type"
                                data-style="btn-black" data-width="100%" data-live-search="true"
                                title="Select Years of Experience">
                                <option>1-3 years</option>
                                <option>3-6 years</option>
                                <option>6-9 years</option>
                                <option>more than 10 years</option>
                            </select>
                            @if ($errors->has('experience'))
                                <p class="alert alert-success">{{ $errors->first('experience') }}</p>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="salary">Salary</label>
                            <input type="text" name="salary" class="form-control" id="job-title" placeholder="salary"
                                value="{{ old('salary') }}">
                            @if ($errors->has('salary'))
                                <p class="alert alert-success">{{ $errors->first('salary') }}</p>
                            @endif

                        </div>

                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" class="selectpicker border rounded form-control " id=""
                                data-style="btn-black" data-width="100%" data-live-search="true" title="Select Gender">
                                <option value="male"  >Male</option>
                                <option value="female">Female</option>
                                <option value="other">other</option>
                            </select>
                            @if ($errors->has('gender'))
                                <p class="alert alert-success">{{ $errors->first('gender') }}</p>
                            @endif

                        </div>

                        <div class="form-group">
                            <label for="application_deadline">Application Deadline</label>
                            <input name="application_deadline" type="text" class="form-control" id=""
                                placeholder="e.g. 20-12-2022" value="{{ old('application_deadline') }}">
                            @if ($errors->has('application_deadline'))
                                <p class="alert alert-success">{{ $errors->first('application_deadline') }}</p>
                            @endif
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="jobdescription">Job Description</label>
                                <textarea name="jobdescription" id="" cols="30" rows="7" class="form-control"
                                    placeholder="Write Job Description...">
                                    {{ old('jobdescription') }}
                                </textarea>
                                @if ($errors->has('jobdescription'))
                                    <p class="alert alert-success">{{ $errors->first('jobdescription') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="">Responsibilities</label>
                                <textarea name="responsibilities" id="" cols="30" rows="7" class="form-control"
                                    placeholder="Write Responsibilities...">
                                    {{ old('responsibilities') }}
                                </textarea>
                                @if ($errors->has('responsibilities'))
                                    <p class="alert alert-success">{{ $errors->first('responsibilities') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label class="text-black" for="">Education & Experience</label>
                                <textarea name="education_experience" id="" cols="30" rows="7" class="form-control"
                                    placeholder="Write Education & Experience...">
                                    {{ old('education_experience') }}</textarea>
                                @if ($errors->has('education_experience'))
                                    <p class="alert alert-success">{{ $errors->first('education_experience') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="job-type">Categroy</label>
                            <select name="category" class="selectpicker border rounded form-control " id=""
                                data-style="btn-black" data-width="100%" data-live-search="true" title="Select Gender">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="image">Images</label>
                            <input name="image" type="file" class="form-control bg-dark text-white w-25" value="{{ old('image') }}">
                        </div>

                        <div class="col-lg-4 ml-auto">
                            <div class="row">
                                <div class="col-6">
                                    <input type="submit" name="submit" class="btn btn-block btn-dark btn-md"
                                        style="margin-left: 200px;" value="Save Job">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endsection
