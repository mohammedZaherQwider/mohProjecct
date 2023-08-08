<?php

namespace App\Http\Controllers;

use App\Mail\contact;
use App\Models\Expert;
use App\Models\Job;
use App\Models\Philosphy;
use App\Models\Post;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{

    function index()
    {
        $posts = Post::all();
        $postsR = DB::table('posts')->latest()->get();
        $services = Service::all();
        $testimonials = Testimonial::all();
        return view('project.index', compact('posts', 'services', 'testimonials', 'postsR'));
    }
    function about()
    {
        $postFirst = DB::table('posts')->oldest()->first();
        $philosphys = Philosphy::all();
        $experts = Expert::all();
        $jobs = Job::all();
        return view('project.about', compact('postFirst', 'philosphys', 'experts', 'jobs'));
    }
    function services()
    {
        $services = Service::all();
        $posts = Post::all();
        return view('project.services', compact('services', 'posts'));
    }
    function blog()
    {
        $posts = DB::table('posts')->latest()->simplePaginate(8);
        return view('project.blog', compact('posts'));
    }
    function contact()
    {
        return view('project.contact');
    }
    function contact_email(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'subject' => 'required|string',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $info = $request->except('_token');
        Mail::to($request->email)->send(new contact($info));
        return view('project.contact');
    }
    function admin()
    {
        return view('admin.admin');
    }
    function experts()
    {
        return view('admin.createExperts');
    }
    function jobs()
    {
        return view('admin.createJob');
    }
    function philosphies()
    {
        return view('admin.createPhilosphie');
    }
    function posts()
    {
        return view('admin.createPosts');
    }
    function service()
    {
        return view('admin.createService');
    }
    function testimonials()
    {
        return view('admin.createTestimonial');
    }
    function create(Request $request, $type)
    {
        if ($type == 'experts') {
            $request->validate([
                'name' => ['required', 'string'],
                'job_name' => ['required', 'string'],
                'description' => ['required', 'string'],
                'image' => 'required'
            ]);

            $name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $name);
            $name = 'uploads/' . $name;
            $expert = Expert::updateOrCreate([
                'name'=>$request->name
            ],[
                'name' => $request->name,
                'job_name' => $request->job_name,
                'description' => $request->description,
                'image' => $name
            ]);

            // return redirect()
            //     ->route('home.admin')
            //     ->with('msg', 'Experts added successfully')
            //     ->with('icon', 'success');
            return  $expert;
        } elseif ($type == 'job') {
            $request->validate([
                'job_name' => ['required', 'string'],
                'job_location' => ['required', 'string'],
                'time' => 'required'
            ]);
            Job::create([
                'job_name' => $request->job_name,
                'job_location' => $request->job_location,
                'time' => $request->time
            ]);
            return redirect()
                ->route('home.admin')
                ->with('msg', 'Job added successfully')
                ->with('icon', 'success');
        } elseif ($type == 'philosphie') {
            $request->validate([
                'title' => ['required', 'string'],
                'description' => ['required', 'string'],
                'image' => 'required'
            ]);

            $name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $name);
            $name = 'uploads/' . $name;

            Philosphy::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $name
            ]);

            return redirect()
                ->route('home.admin')
                ->with('msg', 'Philosphie added successfully')
                ->with('icon', 'success');
        } elseif ($type == 'post') {
            $request->validate([
                'title' => ['required', 'string'],
                'price' => ['required', 'integer'],
                'description' => ['required', 'string'],
                'image' => 'required'
            ]);

            $name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $name);
            $name = 'uploads/' . $name;

            Post::create([
                'title' => $request->title,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $name
            ]);

            return redirect()
                ->route('home.admin')
                ->with('msg', 'Posts added successfully')
                ->with('icon', 'success');
        } elseif ($type == 'service') {
            $request->validate([
                'title' => ['required', 'string'],
                'description' => ['required', 'string'],
                'image' => 'required'
            ]);

            $name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $name);
            $name = 'uploads/' . $name;

            Service::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $name
            ]);

            return redirect()
                ->route('home.admin')
                ->with('msg', 'Service added successfully')
                ->with('icon', 'success');
        } elseif ($type == 'testimonial') {
            $request->validate([
                'name' => ['required', 'string'],
                'job' => ['required', 'string'],
                'comment' => ['required', 'string'],
                'image' => 'required'
            ]);

            $name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads'), $name);
            $name = 'uploads/' . $name;

            Testimonial::create([
                'name' => $request->name,
                'job' => $request->job,
                'comment' => $request->comment,
                'image' => $name
            ]);

            return redirect()
                ->route('home.admin')
                ->with('msg', 'Testimonial added successfully')
                ->with('icon', 'success');
        }
    }
    function allExperts()
    {
        $experts = Expert::latest('id')->paginate(5);
        return  view('admin.show.allexprts', compact('experts'));
    }
    function allJobs()
    {
        $jobs = Job::latest('id')->paginate(5);
        return view('admin.show.allJob', compact('jobs'));
    }
    function allPosts()
    {
        $posts = Post::latest('id')->paginate(5);
        return view('admin.show.allPost', compact('posts'));
    }
    function allService()
    {
        $services = Service::latest('id')->paginate(5);
        return view('admin.show.allservice', compact('services'));
    }
    function allTestimonials()
    {
        $testimonials = Testimonial::latest('id')->paginate(5);
        return view('admin.show.allTestimonial', compact('testimonials'));
    }
    function allPhilosphies()
    {
        $philosphies = Philosphy::latest('id')->paginate(5);
        return view('admin.show.allPhilosphie', compact('philosphies'));
    }
    function deleteexprt($id)
    {
        $new = Expert::findorFail($id);
        File::delete(public_path($new->image));
        $new->delete();
        return redirect()->route('home.admin')
            ->with('msg', 'Expert deleted .')
            ->with('icon', 'error');
    }
    function deletejod($id)
    {
        $new = Job::findorFail($id);
        $new->delete();
        return redirect()->route('home.admin')
            ->with('msg', 'Job deleted .')
            ->with('icon', 'error');
    }
    function deletepost($id)
    {
        $new = Post::findorFail($id);
        File::delete(public_path($new->image));
        $new->delete();
        return redirect()->route('home.admin')
            ->with('msg', 'Post deleted .')
            ->with('icon', 'error');
    }
    function deleteservice($id) {
        $new = Service::findorFail($id);
        File::delete(public_path($new->image));
        $new->delete();
        return redirect()->route('home.admin')
            ->with('msg', 'Service deleted .')
            ->with('icon', 'error');
    }
    function deletetestimonials($id) {
        $new = Testimonial::findorFail($id);
        File::delete(public_path($new->image));
        $new->delete();
        return redirect()->route('home.admin')
            ->with('msg', 'Testimonial deleted .')
            ->with('icon', 'error');
    }
    function deletetephilosphies($id) {
        $new = Philosphy::findorFail($id);
        File::delete(public_path($new->image));
        $new->delete();
        return redirect()->route('home.admin')
            ->with('msg', 'Philosphy deleted .')
            ->with('icon', 'error');
    }

}
