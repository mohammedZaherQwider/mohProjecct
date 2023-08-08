@extends('layout.nav')
@section('title', 'Blog')
@section('content')
    <div class="hero overlay">

        <div class="img-bg rellax">
            <img src="{{ asset('asset/images/hero_1.jpg') }}" alt="Image" class="img-fluid">
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-start">
                <div class="col-lg-6 mx-auto text-center">

                    <h1 class="heading" data-aos="fade-up">Blog</h1>
                    <p class="mb-4" data-aos="fade-up">A small river named Duden flows by their place and supplies it with
                        the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly
                        into your mouth.</p>
                </div>
            </div>
        </div>


    </div>

    <div class="section">
        <div class="container">
            <div class="row align-items-stretch">
                @foreach ($posts as $post)
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="media-entry">
                            <a href="index.html">
                                <img src="{{ $post->image }}" alt="Image" class="img-fluid">
                            </a>
                            <div class="bg-white m-body">
                                <span class="date">{{ date('j M Y', strtotime($post->created_at)) }}</span>
                                <h3><a href="index.html">{{ $post->title }}</a></h3>
                                <p>{{ $post->description }}.</p>

                                <a href="single.html" class="more d-flex align-items-center float-start">
                                    <span class="label">Read More</span>
                                    <span class="arrow"><span class="icon-keyboard_arrow_right"></span></span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{ $posts->links(); }}
            </div>
        </div>
    </div>
@endsection
