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

        /* Featured title styled pink and bold */
        .featured-title h4 {
            color: #ff3c82 !important;
            font-weight: bold;
        }

        .featured-title h4 em {
            color: #ff3c82 !important;
            font-style: normal;
        }

        .category-title h4 {
            color: #ff3c82 !important;
        }

        /* Hide dropdown on desktop */
        #categoryDropdown {
            display: none;
            margin-bottom: 20px;
        }

        /* Show dropdown only on small/mobile */
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

        /* Game card styling */
        .game-card {
            background-color: #2b2c2f;
            padding: 15px;
            border-radius: 15px;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            color: #ddd;
            margin-bottom: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .game-card:hover {
            box-shadow: 0 8px 20px rgba(255, 60, 130, 0.4);
            transform: translateY(-5px);
            color: #fff;
        }

        .game-card h5 {
            color: #ff3c82;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .game-card p {
            flex-grow: 1;
        }

        .btn-play {
            background-color: #ff3c82;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            text-align: center;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .btn-play:hover {
            background-color: #e1326b;
            color: white;
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

                <!-- Dropdown categories mobile -->
                <div id="categoryDropdown">
                    <label for="categorySelect" class="text-white mb-2">Show All Categories</label>
                    <select id="categorySelect" class="form-select">
                        <option value="">Select Category</option>
                        @foreach ($category_list as $category)
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
                                <div class="col-md-4">
                                    <div class="game-card">
                                        <!-- Image du jeu depuis URL complète -->
                                        <div style="text-align:center; margin-bottom: 15px;">
                                            <img src="{{ $game->thumb }}" alt="{{ $game->title }}"
                                                style="max-width: 100%; border-radius: 12px; box-shadow: 0 4px 10px rgba(255,60,130,0.3);" />
                                        </div>

                                        <h5>{{ $game->title }}</h5>
                                        <p>{{ \Illuminate\Support\Str::limit($game->description, 100) }}</p>
                                        <a href="{{ route('play', ['title' => \Illuminate\Support\Str::slug($game->title)]) }}"
                                            class="btn-play">
                                            Jouer
                                        </a>
                                    </div>
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

            <!-- Sidebar with Categories on Desktop Only -->
            <div class="col-lg-3 order-2 sidebar-categories" style="background-color: #1f2122; padding: 20px;">
                <x-category-section />
            </div>
        </div>
    </div>

    <script>
        document.getElementById('categorySelect').addEventListener('change', function() {
            if (this.value) {
                window.location.href = this.value;
            }
        });
    </script>
</x-front-template>
