@extends('layout.layout')
@section('admin_content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        table td,
        table th {
            vertical-align: middle
        }
    </style>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{ route('home.admin') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Add
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('home.experts') }}">
                                    Add Experts
                                </a>
                                <a class="nav-link" href="{{ route('home.jobs') }}">
                                    Add Jobs
                                </a>
                                <a class="nav-link" href="{{ route('home.philosphie') }}">
                                    Add Philosphies
                                </a>
                                <a class="nav-link" href="{{ route('home.posts') }}">
                                    Add Posts
                                </a>
                                <a class="nav-link" href="{{ route('home.service') }}">
                                    Add Services
                                </a>
                                <a class="nav-link" href="{{ route('home.testimonials') }}">
                                    Add Testimonials
                                </a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                            data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Show
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo"
                            data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('home.allExperts') }}">
                                        Show All Experts
                                    </a>
                                    <a class="nav-link" href="{{ route('home.allJobs') }}">
                                        Show All Jobs
                                    </a>
                                    <a class="nav-link" href="{{ route('home.allPhilosphies') }}">
                                        Show All Philosphies
                                    </a>
                                    <a class="nav-link" href="{{ route('home.allPosts') }}">
                                        Show All Posts
                                    </a>
                                    <a class="nav-link" href="{{ route('home.allService') }}">
                                        Show All Services
                                    </a>
                                    <a class="nav-link" href="{{ route('home.allTestimonials') }}">
                                        Show All Testimonials
                                    </a>
                                </nav>
                            </nav>
                        </div>
            </nav>
        </div>

    </div>
    </div>
    </nav>

    </div>
    </div>
    <div id="layoutSidenav_content" style="margin: 100px; margin-left:250px">
        @yield('con')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('asset/js/axios.min.js') }}"></script>
    <script>
      const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        @if (session('msg'))
            Toast.fire({
                icon: '{{ session('icon') }}',
                title: '{{ session('msg') }}'
            })
        @endif
    </script> 
@endsection
