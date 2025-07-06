@php use Illuminate\Support\Str; @endphp


<div class="row">
    @foreach ($list as $item)
    @php
        if(Route::currentRouteName() == 'game')
        {
            $col = 4;
        }
        else {
            $col = 3;
        }
    @endphp
        <div class="col-lg-{{ $col }} col-sm-6 mb-3 col-6 d-flex align-items-stretch">
            <div class="item" onclick="location.href='{{route('play', ['title' => Str::slug($item->title)])}}'"
                style="cursor:pointer;">
                <img src="{{ $item->thumb }}" alt="" class='img-fluid'>
                <h4>{{ $item->title }}<br><span>{{ $item->category->name }}</span></h4>


            </div>
        </div>
    @endforeach
    </div>
