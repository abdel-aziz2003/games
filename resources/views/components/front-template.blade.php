<?php
use App\Models\Page;
$page_list = Page::where('id', '<>', 1)->get();
?>

@php use Illuminate\Support\Str; @endphp
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Dynamic meta title and description -->
  <title>{{ $title ?? config('settings.name') }}</title>
  <meta name="description" content="{{ $meta_description ?? config('settings.meta_description') }}">
  <meta name="keywords" content="{{ config('settings.meta_keyword') }}">

  <!-- Open Graph (optional) -->
  <meta property="og:title" content="{{ $title ?? config('settings.name') }}">
  <meta property="og:description" content="{{ $meta_description ?? config('settings.meta_description') }}">
  <meta property="og:image" content="{{ url('public/images/' . config('settings.logo')) }}">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="website">

  <!-- Fonts and CSS -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="{{ url('public/template/front') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ url('public/template/front') }}/assets/css/fontawesome.css">
  <link rel="stylesheet" href="{{ url('public/template/front') }}/assets/css/templatemo-cyborg-gaming.css">
  <link rel="stylesheet" href="{{ url('public/template/front') }}/assets/css/owl.css">
  <link rel="stylesheet" href="{{ url('public/template/front') }}/assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

  <x-head-inc/>
  @if(config('settings.adsense') != '')
    {!! config('settings.adsense') !!}
  @endif
</head>

<body>
  <!-- Header -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <a href="{{ route('welcome') }}" class="logo">
              <img src="{{ url('public/images/' . config('settings.logo')) }}" alt="">
            </a>

            <!-- Search -->
            <div class="search-input">
                <form id="search" action="{{ route('search') }}" method="GET">
                    @csrf
                    <input type="text" placeholder="Search Game" id="searchText" name="q" value="{{ request('q') }}" />
                    <i class="fa fa-search"></i>
                </form>
            </div>



            <!-- Nav Menu -->
            <ul class="nav">
              <li><a href="{{ route('welcome') }}">Home</a></li>
              <li><a href="{{ route('page_view', ['name' => Str::slug('About Us')]) }}">About Us</a></li>
              <li><a href="{{ route('contact') }}">Contact Us</a></li>
              <li class="dropdown">
                <a href="#" class='dropdown-toggle' data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                <ul class="dropdown-menu m-2 p-3">
                  @foreach($page_list as $item)
                    <li>
                      <a class="dropdown-item" href="{{ route('page_view', ['name' => Str::slug($item->name)]) }}">
                        {{ $item->name }}
                      </a>
                    </li>
                  @endforeach
                </ul>
              </li>
            </ul>
            <a class='menu-trigger'><span>Menu</span></a>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">
          {{ $slot }}

          @if(config('settings.template_ad') != '')
            <div class='mt-5'></div>
            <p align='center'>
              <img src='{{ url('public/images/' . config('settings.template_ad')) }}' class='img-fluid img-thumbnail'>
            </p>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright © {{ date('Y') }} <a href="#">{{ config('settings.name') }}</a>. All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="{{ url('public/template/front') }}/vendor/jquery/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ url('public/template/front') }}/assets/js/isotope.min.js"></script>
  <script src="{{ url('public/template/front') }}/assets/js/owl-carousel.js"></script>
  <script src="{{ url('public/template/front') }}/assets/js/tabs.js"></script>
  <script src="{{ url('public/template/front') }}/assets/js/popup.js"></script>
  <script src="{{ url('public/template/front') }}/assets/js/custom.js"></script>

  <x-foot-inc/>

  <script>
    document.getElementById('searchText')?.addEventListener("keypress", function (e) {
      if (e.key === 'Enter') {
        e.preventDefault();
        document.getElementById('search').submit();
      }
    });
  </script>
</body>
</html>
