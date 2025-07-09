<?php
use App\Models\Category;
$category_list = Category::orderBy('name')->get();
?>

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
        color: #ffffff !important;
    }

    .category-title h4 {
        color: #ff3c82 !important;
    }
</style>

<div class="heading-section category-title mb-4">
    <h4><strong><em>Game</em> Categories</strong></h4>
</div>

@if ($category_list->count() > 0)
    <div class="list-group">
        @foreach ($category_list as $item)
            <a href="{{ route('game', ['category_slug' => $item->slug]) }}" class="list-group-item list-group-item-action p-3">
                <i class="fas fa-gamepad"></i> {{ $item->name }}
            </a>
        @endforeach

    </div>
@else
    <p class="text-light">No categories available.</p>
@endif

@if (config('settings.game_ad') != '')
    <div class="mt-5 text-center">
        <img src="{{ url('public/images/ads/' . config('settings.game_ad')) }}" class="img-fluid img-thumbnail"
            alt="Game Ad" style="border-radius: 10px;" />
    </div>
@endif
