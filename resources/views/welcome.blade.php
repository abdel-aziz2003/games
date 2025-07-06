@php
    // Get all categories ordered by name
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

        /* Optional: style the <em> inside Featured title */
        .featured-title h4 em {
            color: #ff3c82 !important;
            font-style: normal; /* remove italic if you want */
        }

        .category-title h4 {
            color: #ff3c82 !important;
        }

        /* Hide the dropdown on desktop */
        #categoryDropdown {
            display: none;
            margin-bottom: 20px;
        }

        /* Show dropdown only on small/mobile */
        @media (max-width: 991.98px) {
            #categoryDropdown {
                display: block;
            }
            /* Hide sidebar categories on mobile */
            .sidebar-categories {
                display: none;
            }

            /* Black style for select on mobile */
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
    </style>

    <div class="container-fluid">
        <div class="row" style="min-height: 100vh; margin: 0;">

            <!-- Banner + Featured Games on Mobile and Desktop -->
            <div class="col-12 col-lg-9 order-1" style="padding: 20px;">

                <!-- Banner -->
                <div class="main-banner mb-4"
                    style="background-image: url({{ url('public/images/' . config('settings.home_banner')) }}); background-position: center center; background-size: cover; min-height: 380px; border-radius: 23px; padding: 80px 60px;">
                </div>

                <!-- Dropdown Categories on Mobile -->
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
                            <x-game-list :list="$game_list" />
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
        document.getElementById('categorySelect').addEventListener('change', function () {
            if (this.value) {
                window.location.href = this.value;
            }
        });
    </script>

</x-front-template>
