<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Admin;
use App\Models\Categories;
use App\Models\Application;
use App\Models\jobType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index()
    {
        $jobs = Job::select()->count();
        $categories = Categories::select()->count();
        $admins = Admin::select()->count();
        $applications = Application::select()->count();
        return view('admins.index', compact('jobs', 'categories', 'admins', 'applications'));
    }


    public function showLogin()
    {
        return view('admins.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.index');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.showLogin');
    }

    public function showAdmin()
    {
        $admins = Admin::all();

        return view('admins.show-all-admins', compact('admins'));
    }

    public function createAdmins()
    {

        return view('admins.create-admin');
    }

    public function storeAdmins(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'username' => 'required',
                'email' => 'required|email|unique:admins,email',
                'password' => 'required'
            ]);

            $admin = Admin::create([
                'name' => $validatedData['username'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            return redirect()->back()->with('message', 'Admin created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Failed to create admin');
        }
    }

    public function displayCategories()
    {
        $categories = Categories::all();
        return view('admins.display-categories', compact('categories'));
    }

    public function createCategories()
    {

        return view('admins.create-categories');
    }

    public function storeCategories(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'name' => 'required|unique:categories,name',
            ]);

            $category = Categories::create([
                'name' => $validatedData['name'],
            ]);

            return redirect()->back()->with('message', 'Category created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Failed to create Category');
        }
    }


    public function editCategories($id)
    {
        $category = Categories::find($id);
        return view('admins.edit-categories', compact('category'));
    }

    public function updateCategories($id, Request $request)
    {
        $validatedData = $request->validate(['name' => 'required|max:50']);

        $category = Categories::find($id);
        $category->update($validatedData);

        if ($category) {
            return redirect()->route('admin.displayCategories')->with('message', 'Category updated successfully');
        } else {
            return redirect()->back()->with('message', 'Category created failed');
        }
    }

    public function deleteCategories($id)
    {

        $category = Categories::find($id);
        $category->delete();
        if ($category) {
            return redirect()->route('admin.displayCategories')->with('message', 'Category deleted successfully');
        } else {
            return redirect()->back()->with('message', 'Category not deleted ');
        }
    }

    public function displayJobs()
    {
        $jobs = Job::all();
        return view('admins.display-jobs', compact('jobs'));
    }

    public function deleteJobs($id)
    {

        $job = Job::find($id);
        $job->delete();
        if ($job) {
            return redirect()->route('admin.displayJobs')->with('message', 'Job deleted successfully');
        } else {
            return redirect()->back()->with('message', 'Job not deleted ');
        }
    }

    public function createJobs()
    {
        $jobTypes = JobType::all();
        $categories = Categories::all();

        return view('admins.create-jobs', compact('jobTypes', 'categories'));
    }

    public function storeJobs(Request $request)
    {
        // try {
        $validatedData = $request->validate([
            'title' => 'required',
            'company' => 'required',
            'category' => 'required',
            'job_region' => 'required',
            'job_type' => 'required',
            'experience' => 'required',
            'salary' => 'required',
            'gender' => 'required',
            'jobdescription' => 'required',
            'responsibilities' => 'required',
            'education_experience' => 'required',
        ]);


        $job = Job::create(
            $validatedData
        );

        if ($request->hasFile('image')) {
            // Get image file
            $image = $request->file('image');
            // Make an image name based on the user's name and current timestamp
            $image_name = $job->name . '_' . time() . '.' . $image->getClientOriginalExtension();
            // Define the folder path
            $folder = 'assets/images_jobs/';
            // Upload image using the custom function (assuming you have it)
            $image->move(public_path($folder), $image_name);

            // Set the user's profile image path in the database to filePath
            $job->image = $image_name;
            $job->save(); // Save the user model with the updated image path
        }

        if ($job) {
            return redirect()->back()->with('message', 'Job created successfully');
        } else {
            return redirect()->back()->with('message', 'Failed to create job');
        }
    }

    public function displayApplications(){
        $applications = Application::all();
        foreach ($applications as $application) {
            $application->job = Job::find($application->job_id);
            $application->user = User::find($application->user_id);
        }
        return view('admins.display-application', compact('applications'));
    }
}
