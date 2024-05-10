<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Savejob;
use App\Models\Application;
use App\Models\Categories;
use App\Models\User;
use App\Models\JobType;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */



    public function index(Request $request)
    {
        $job_title = $request->job_title;
        $category = $request->category;
        $job_type = $request->job_type;

        $query = Job::select();

        if ($job_title !== null) {
            $query->where('title', 'like', '%' . $job_title . '%');
        }

        if ($category !== null) {
            $query->where('category', 'like', '%' . $category . '%');
        }

        if ($job_type !== null) {
            $query->where('job_type', 'like', '%' . $job_type . '%');
        }

        $jobs = $query->get();
//      -------------------------------------------
        $perPage = 10; // Number of jobs per page

        // Get the total count of jobs
        $totalJobs = $query->count();

        // Calculate the total number of pages
        $totalPages = ceil($totalJobs / $perPage);

        // Get the current page from the request, default to 1
        $currentPage = $request->query('page', 1);

        // Calculate the offset
        $offset = ($currentPage - 1) * $perPage;

        // Get jobs for the current page
        $jobs = $query->offset($offset)->limit($perPage)->get();

//      -------------------------------------------


        $totalJobs = $query->count();
        $jobTypes = JobType::all();
        $categories = Categories::all();

//        return view('home', compact('jobs', 'totalJobs', 'jobTypes', 'categories'));
        return view('home', compact('jobs', 'totalJobs', 'jobTypes', 'categories', 'totalPages', 'currentPage'));

    }

    // about page
    public function about()
    {
        return view('about');
    }
    //contact page
    public function contact()
    {
        return view('contact');
    }

    // show single job
    public function show($id)
    {
        $job = Job::find($id);

        $relatedJobs = Job::where('category', $job->category)
            ->where('id', '!=', $id)
            ->paginate(5);

        // total related jobs
        $totalRelatedJobs = Job::where('category', $job->category)
            ->where('id', '!=', $id)
            ->count();

        // all categories
        $categories = Categories::all();

        if (auth()->user()) {
            // is job saved
            $isSavedJob =
                Savejob::where('user_id', auth()->user()->id)
                    ->where('job_id', $id)
                    ->count() > 0
                    ? true
                    : false;

            // is job applied
            $isAppliedJob =
                Application::where('user_id', auth()->user()->id)
                    ->where('job_id', $id)
                    ->count() > 0
                    ? true
                    : false;

            return view('jobs.single', compact('job', 'relatedJobs', 'totalRelatedJobs', 'isSavedJob', 'isAppliedJob', 'categories'));
        } else {
            return view('jobs.single', compact('job', 'relatedJobs', 'totalRelatedJobs', 'categories'));
        }
    }

    // save job
    public function saveJob(Request $request)
    {
        $jobId = $request->job_id;
        $userId = auth()->user()->id;

        $saveJob = SaveJob::create([
            'user_id' => $userId,
            'job_id' => $jobId,
        ]);

        if ($saveJob) {
            return redirect()->back()->with('message', 'Job saved successfully');
        } else {
            return redirect()->back()->with('message', 'Failed to save job');
        }
    }
    // unsave job
    public function unsaveJob(Request $request)
    {
        $jobId = $request->job_id;
        $userId = auth()->user()->id;

        $unsaveJob = SaveJob::where('user_id', $userId)->where('job_id', $jobId)->delete();

        if ($unsaveJob) {
            return redirect()->back()->with('message', 'Job unsaved successfully');
        } else {
            return redirect()->back()->with('message', 'Failed to unsave job');
        }
    }

    // apply job
    public function applyJob(Request $request)
    {
        $userCV = auth()->user()->cv;
        $userId = auth()->user()->id;

        // check if cv is null
        // if ($userCV == null) {
        //     return redirect()->back()->with('apply', 'Please upload your cv');
        // }

        $applyJob = Application::create([
            'user_id' => $userId,
            'job_id' => $request->job_id,
            'status' => 'pending',
        ]);

        if ($applyJob) {
            return redirect()->back()->with('apply', 'apply saved successfully');
        } else {
            return redirect()->back()->with('apply', 'Failed to save apply');
        }
    }

    // show single category
//    !! fix bug
    public function singleCategory($name)
    {
        $jobs = Job::where('category', $name)->get();

        // total job of the same category
        $totalJobs = Job::where('category', $name)->count();

        // category name
        return view('categories.single', compact('jobs', 'totalJobs', 'name'));
    }

    // show user profile
    public function singleUser()
    {
        $profile = User::find(auth()->user()->id);

        // dd($profle);
        return view('users.profile', compact('profile'));
    }

    // show user applications
    public function applications()
    {
        $applications = Application::where('user_id', auth()->user()->id)->get();

        // fetch all jobs base of the job id in application
        foreach ($applications as $application) {
            $application->job = Job::find($application->job_id);
        }
        // total applications
        $totalApply = Application::where('user_id', auth()->user()->id)->count();

        return view('users.applications', compact('applications', 'totalApply'));
    }

    // edit user profile
    public function editProfile()
    {
        $profile = User::find(auth()->user()->id);

        return view('users.edit', compact('profile'));
    }

    // update user profile
    public function updateProfile(Request $request)
    {
        // Retrieve the authenticated user
        $user = User::find(auth()->user()->id);

        // Validate user profile
        $validatedData = $request->validate([
            'name' => 'required',
            'job_title' => 'nullable',
            'bio' => 'nullable',
            'gender' => 'nullable',
            'facebook' => 'nullable',
            'twitter' => 'nullable',
            'linkedin' => 'nullable',
        ]);

        // Update user profile
        $user->update($validatedData);
        // Check if a profile image has been uploaded
        if ($request->hasFile('image')) {
            // Get image file
            $image = $request->file('image');
            // Make an image name based on the user's name and current timestamp
            $image_name = $user->name . '_' . time() . '.' . $image->getClientOriginalExtension();
            // Define the folder path
            $folder = 'assets/images_users/';

            // Upload image using the custom function (assuming you have it)
            $image->move(public_path($folder), $image_name);

            // Set the user's profile image path in the database to filePath
            $user->image = $image_name;
            $user->save(); // Save the user model with the updated image path
        }

        if ($user) {
            return redirect()->route('profile')->with('message', 'profile updated successfully');
        } else {
            return redirect()->back()->with('message', 'profile updated failed');
        }
    }

    // show user saves
    public function saves()
    {
        $saves = Savejob::where('user_id', auth()->user()->id)->get();

        // fetch all jobs base of the job id in savejob
        foreach ($saves as $save) {
            $save->job = Job::find($save->job_id);
        }

        // total saves
        $totalSaves = Savejob::where('user_id', auth()->user()->id)->count();

        return view('users.saves', compact('saves', 'totalSaves'));
    }

    // edit user cv
    public function editCv()
    {
        return view('users.editCV');
    }

    // update user cv
    public function updateCv(Request $request)
    {
        // Retrieve the authenticated user
        $user = User::find(auth()->user()->id);

        // Validate user cv
        $validatedData = $request->validate([
            'cv' => 'required|mimes:pdf,doc,docx',
        ]);

        // Check if a cv has been uploaded
        if ($request->hasFile('cv')) {
            // Get cv file
            $cv = $request->file('cv');
            // Make an cv name based on the user's name and current timestamp
            $cv_name = $user->name . '_' . time() . '.' . $cv->getClientOriginalExtension();
            // Define the folder path
            $folder = 'assets/cvs/';

            // Upload cv using the custom function (assuming you have it)
            $cv->move(public_path($folder), $cv_name);

            // Set the user's cv path in the database to filePath
            $user->cv = $cv_name;
            $user->save(); // Save the user model with the updated cv path
        }

        if ($validatedData) {
            return redirect()->route('profile')->with('message', 'cv updated successfully');
        } else {
            return redirect()->back()->with('message', 'cv updated failed');
        }
    }
}
