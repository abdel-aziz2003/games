<?php
use App\Models\Category;
?>
<x-front-template>
    <x-slot:title>Games</x-slot:title>
    <!-- ***** Featured Games Start ***** -->
    <div class="row">
        <div class="col-lg-8">
            <div class="featured-games header-text">
                <div class="heading-section">
                    @if ($vfilter != '')
                        <h4>{!! $vfilter !!}</h4>
                    @else
                        @if ($category == '--')
                            <h4><em>All</em> Games</h4>
                        @else
                            <h4><em>{{ Category::find($category)->name }}</em> Games</h4>
                        @endif
                    @endif
                </div>
                @if ($list->count() > 0)
                    <x-game-list :list="$list" />
                    {{ $list->links() }}
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="top-downloaded">
                <div class="heading-section">
                    <h4><em>Game</em> Categories</h4>
                </div>
                @if ($category_list->count() > 0)
                    <div class="list-group">
                        @foreach ($category_list as $item)
                            <a href='{{ route('game', ['category' => Str::slug($item->name)]) }}'
                                class='list-group-item list-group-item-action p-3'><i class="fas fa-gamepad"></i>
                                {{ $item->name }}</a>
                        @endforeach
                    </div>
                @endif

                @if (config('settings.game_ad') != '')
                <div class='mt-5'></div>
                <p align='center'><img src='{{ url('public/images/ads/' . config('settings.game_ad')) }}'
                        class='img-fluid img-thumbnail'></p>
                @endif
            </div>



        </div>
    </div>
    <!-- ***** Featured Games End ***** -->

</x-front-template>
