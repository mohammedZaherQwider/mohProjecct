<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[MainController::class,'index'])->name('home.index');
Route::get('/about',[MainController::class,'about'])->name('home.about');
Route::get('/services',[MainController::class,'services'])->name('home.services');
Route::get('/blog',[MainController::class,'blog'])->name('home.blog');
Route::get('/contact',[MainController::class,'contact'])->name('home.contact');
Route::post('/contact',[MainController::class,'contact_email'])->name('home.contact_email');

Route::get('/admin',[MainController::class,'admin'])->name('home.admin');

Route::get('/experts',[MainController::class,'experts'])->name('home.experts');
Route::get('/allExperts',[MainController::class,'allExperts'])->name('home.allExperts');
Route::delete('/deleteExperts/{id}',[MainController::class,'deleteexprt'])->name('home.deleteexprt');

Route::get('/jobs',[MainController::class,'jobs'])->name('home.jobs');
Route::get('/allJobs',[MainController::class,'allJobs'])->name('home.allJobs');
Route::delete('/deleteJobs/{id}',[MainController::class,'deletejod'])->name('home.deletejod');

Route::get('/posts',[MainController::class,'posts'])->name('home.posts');
Route::get('/allPosts',[MainController::class,'allPosts'])->name('home.allPosts');
Route::delete('/deletePosts/{id}',[MainController::class,'deletepost'])->name('home.deletepost');


Route::get('/service',[MainController::class,'service'])->name('home.service');
Route::get('/allService',[MainController::class,'allService'])->name('home.allService');
Route::delete('/deleteService/{id}',[MainController::class,'deleteservice'])->name('home.deleteservice');

Route::get('/testimonials',[MainController::class,'testimonials'])->name('home.testimonials');
Route::get('/allTestimonials',[MainController::class,'allTestimonials'])->name('home.allTestimonials');
Route::delete('/deleteTestimonials/{id}',[MainController::class,'deletetestimonials'])->name('home.deletetestimonials');

Route::get('/philosphies',[MainController::class,'philosphies'])->name('home.philosphie');
Route::get('/allPhilosphies',[MainController::class,'allPhilosphies'])->name('home.allPhilosphies');
Route::delete('/deletePhilosphies/{id}',[MainController::class,'deletetephilosphies'])->name('home.deletetephilosphies');

Route::post('/create/{type}',[MainController::class,'create'])->name('home.create');


