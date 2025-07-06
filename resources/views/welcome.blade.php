@php
use Illuminate\Support\Str;
$category_list = \App\Models\Category::orderBy('name')->get();
@endphp

<x-front-template>
    <x-slot:title>Home</x-slot:title>

    <style>
        .category-item {
            background-color: #2b2c2f;
            color: #ffffff;
            border: none;
            margin-bottom: 5px;
            border-radius: 6px;
            transition: all 0.3s ease-in-out;
        }

        .category-item:hover {
            background-color: #ff3c82;
            color: #ffffff;
            transform: translateX(5px);
            box-shadow: 0 4px 10px rgba(255, 60, 130, 0.3);
        }

        .featured-title h4 {
            color: #ff3c82 !important;
            font-weight: bold;
        }

        .featured-title h4 em {
            color: #ff3c82 !important;
            font-style: normal;
        }

        #categoryDropdown {
            display: none;
            margin-bottom: 20px;
        }

        @media (max-width: 991.98px) {
            #categoryDropdown {
                display: block;
            }

            .sidebar-categories {
                display: none;
            }

            #categorySelect {
                background-color: #2b2c2f;
                color: #ffffff;
                border: none;
                border-radius: 6px;
                padding: 8px 12px;
                cursor: pointer;
            }

            #categorySelect option {
                background-color: #2b2c2f;
                color: #ffffff;
            }
        }

        .game-card {
            background-color: #2b2c2f;
            padding: 15px;
            border-radius: 15px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            color: #fff;
            text-align: center;
            height: 100%;
        }

        .game-card:hover {
            box-shadow: 0 8px 20px rgba(255, 60, 130, 0.5);
            transform: translateY(-5px);
        }

        .image-wrapper {
            position: relative;
            display: inline-block;
        }

        .image-wrapper img {
            max-width: 100%;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(255,60,130,0.3);
            margin-bottom: 10px;
            transition: filter 0.3s ease, opacity 0.3s ease;
        }

        /* Effet gris + opacité réduite sur l’image au hover */
        .game-card:hover .image-wrapper img {
            filter: grayscale(70%);
            opacity: 0.7;
        }

        .start-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.9);
            font-size: 48px;
            color: #ff3c82;
            opacity: 0;
            transition: opacity 0.5s ease 0.2s, transform 0.3s ease;
            z-index: 2;
            pointer-events: none;
        }

        .game-card:hover .start-icon {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.2);
        }

        .game-card h5 {
            color: #ffffff;
            font-weight: bold;
            margin-bottom: 0;
            transition: color 0.3s ease;
        }

        .game-card:hover h5 {
            color: #ff3c82;
        }
    </style>

    <div class="container-fluid">
        <div class="row" style="min-height: 100vh; margin: 0;">
            <!-- Main Content -->
            <div class="col-12 col-lg-9 order-1" style="padding: 20px;">
                <!-- Banner -->
                <div class="main-banner mb-4"
                    style="background-image: url({{ url('public/images/' . config('settings.home_banner')) }}); background-position: center center; background-size: cover; min-height: 380px; border-radius: 23px; padding: 80px 60px;">
                </div>

                <!-- Dropdown categories on mobile -->
                <div id="categoryDropdown">
                    <label for="categorySelect" class="text-white mb-2">Show All Categories</label>
                    <select id="categorySelect" class="form-select">
                        <option value="">Select Category</option>
                        @foreach($category_list as $category)
                            <option value="{{ url('/' . $category->name) }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Featured Games Section -->
                <div class="most-popular">
                    <div class="heading-section featured-title mb-4">
                        <h4><strong><em>Featured</em> Games</strong></h4>
                    </div>
                    <div class="row">
                        @if (isset($game_list) && $game_list->count() > 0)
                            @foreach ($game_list as $game)
                                <div class="col-md-4 mb-4">
                                    <a href="{{ route('play', ['title' => Str::slug($game->title)]) }}" style="text-decoration: none;">
                                        <div class="game-card">
                                            <div class="image-wrapper">
                                                <img src="{{ $game->thumb }}" alt="{{ $game->title }}">
                                                <div class="start-icon">⏻</div>
                                            </div>
                                            <h5>{{ $game->title }}</h5>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p class="text-white">No featured games available.</p>
                        @endif

                        <div class="col-lg-12 mt-4 text-center">
                            <a href="{{ route('game') }}" class="btn btn-pink"
                                style="background-color: #ff3c82; border: none; color: #fff; padding: 10px 25px; border-radius: 20px;">
                                Discover More
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar categories on desktop -->
            <div class="col-lg-3 order-2 sidebar-categories" style="background-color: #1f2122; padding: 20px;">
                <x-category-section />
            </div>
        </div>
    </div>

    <script>
        document.getElementById('categorySelect').addEventListener('change', function () {
            if (this.value) {
                window.location.href = this.value;
            }
        });
    </script>
</x-front-template>
