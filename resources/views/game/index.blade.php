<x-back-template>
    <x-slot:title>Games</x-slot:title>

    <p><a href='{{ route('game_create') }}' class='btn btn-success'><i class='fa fa-plus'></i> Add</a></p>

    <div class='card mb-5'>
        <div class='card-header'>Filter</div>
        <div class='card-body'>
            <form action='{{ route('filter', ['route' => Route::currentRouteName()]) }}' method='post'>
                @csrf
                <div class='row'>
                    <div class='col-sm-3 mb-2'>
                        <input type='text' placeholder='Search' name='search' class='form-control'>
                    </div>
                    <div class='col-sm-3 mb-2'>
                        <select name='category' class='form-control'>
                            <option value=''>Category</option>
                            @if ($category_list->count() > 0)
                                @foreach ($category_list as $item)
                                    <option value='{{ $item->id }}'>{{ $item->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class='col-sm-3 mb-2'>
                        <div class="input-group">
                            <input type="text" id="drange" class="form-control" name='drange'
                                placeholder="Date Range" autocomplete="off">
                            <div class="input-group-text"><i class="fa fa-calendar bi bi-calendar"></i></div>
                        </div>
                    </div>
                    <div class='col-sm-3 mb-2'>
                        <input type='submit' class='btn btn-primary' value='Filter' name='filter'>
                    </div>

                </div>
            </form>
        </div>
    </div>
    @if ($vfilter != '')
        {!! $vfilter !!}
    @endif
    @if ($list->count() < 1)
        <x-no-record />
    @else
        <div class='card'>
            <div class='card-body'>
                {{ $list->firstItem() . ' - ' . $list->lastItem() . ' of ' . $list->total() }}
                <div class='table-responsive'>
                    <table class='table table-bordered'>
                        <thead class='bg-secondary text-white'>
                            <tr>
                                <th>Thumb</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>API</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                                <tr>
                                    <td><img src='{{ $item->thumb }}' class='img-fluid img-thumbnail' width='150'>
                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->api->name }}</td>
                                    <td>{{ date('jS M Y H:i:s') }}</td>
                                    <td>
                                        <a href='{{ route('game_create', ['id' => $item->id]) }}'
                                            class='btn btn-warning'><i class='fa fa-pen'></i>
                                            Edit</a>
                                        <a href='{{ route('game_delete', ['id' => $item->id]) }}'
                                            class='btn btn-danger' onclick="return confirm_action()"><i
                                                class='fa fa-trash'></i> Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $list->links() }}
            </div>
        </div>
    @endif

</x-back-template>
