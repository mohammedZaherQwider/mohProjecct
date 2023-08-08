@extends('layout.nav')
@section('title', 'Services')
@section('content')
    <div class="hero overlay">
        <div class="img-bg rellax">
            <img src="{{ asset('asset/images/hero_1.jpg') }}" alt="Image" class="img-fluid">
        </div>
        <div class="container">
            <div class="row align-items-center justify-content-start">
                <div class="col-lg-5">

                    <h1 class="heading" data-aos="fade-up">Services</h1>
                    <p class="mb-5" data-aos="fade-up">A small river named Duden flows by their place and supplies it with
                        the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly
                        into your mouth.</p>
                </div>
            </div>
        </div>
    </div>



    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="heading-content" data-aos="fade-up">
                        <h2>Featured <span class="d-block">Servicwes</span></h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there
                            live the blind texts.</p>
                        <p class="my-4" data-aos="fade-up" data-aos-delay="300"><a href="#"
                                class="btn btn-primary">View All</a></p>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        @for ($i = 1; $i < count($services); $i++)
                            @php
                                $service = $services[$i];
                            @endphp
                            <div class="col-6 col-md-6 col-lg-3 mb-4 mb-lg-0 text-center" data-aos="fade-up"
                                data-aos-delay="{{ $i * 100 }}">
                                <div class="service-1 left-0 mb-5">
                                    <span class="icon">
                                        <img src="{{ $service->image }}" alt="Image" class="img-fluid">
                                    </span>
                                    <div>
                                        <h3>{{ $service->title }}</h3>
                                        <p> {{ $service->description }}.</p>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6 mx-auto text-center">
                    <div class="heading-content" data-aos="fade-up">
                        <h2>Featured Servicwes</h2>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there
                            live the blind texts.</p>
                        <p class="my-4" data-aos="fade-up" data-aos-delay="300"><a href="#"
                                class="btn btn-primary">View All</a></p>
                    </div>
                </div>
            </div>
            <div class="row">
                @for ($i = 1; $i < 5; $i++)
                    @php
                        $post = $posts[$i];
                    @endphp

                    <div class="col-lg-3">
                        <div class="service-2 left-0 mb-5">
                            <img src="{{ $post->image }}" alt="Image" class="img-fluid mb-4 rounded">
                            <div>
                                <h3>{{ $post->title }}</h3>
                                <p>{{ $post->description }}.</p>
                                <p><a href="#" class="more">Learn More</a></p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection
