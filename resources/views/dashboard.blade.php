<x-back-template>
    <x-slot:title>Dashboard</x-slot:title>
    <div class="row dash-row">

        <div class="col-xl-6">
            <div class="stats stats-primary">
                <h3 class="stats-title"> Categories </h3>
                <div class="stats-content">
                    <div class="stats-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="stats-data">
                        <div class="stats-number">{{ $category_count }}</div>
                        <div class="stats-change">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="stats stats-success">
                <h3 class="stats-title"> Games </h3>
                <div class="stats-content">
                    <div class="stats-icon">
                        <i class="fas fa-gamepad"></i>
                    </div>
                    <div class="stats-data">
                        <div class="stats-number">{{ $game_count }}</div>
                        <div class="stats-change">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    
        <div class='card'>
            <div class='card-header'>Latest Games</div>
            <div class='card-body'>
                @if ($game_list->count() < 1)
        <x-no-record />
    @else
                {{ $game_list->count() }} records
                <div class='table-responsive'>
                    <table class='table table-bordered'>
                        <thead class='bg-secondary text-white'>
                            <tr>
                                <th>Thumb</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>API</th>
                                <th>Date Added</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($game_list as $item)
                                <tr>
                                    <td><img src='{{ $item->thumb }}' class='img-fluid img-thumbnail' width='150'>
                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->api->name }}</td>
                                    <td>{{ date('jS M Y H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href='{{ route('game') }}' class='btn btn-primary'><i class="fas fa-eye"></i> View All</a>
                @endif
            </div>
        </div>
    

</x-back-template>
