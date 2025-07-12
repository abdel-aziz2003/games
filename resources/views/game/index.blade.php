<x-back-template>
    <x-slot:title>Games</x-slot:title>

    <p><a href='{{ route('game_create') }}' class='btn btn-success'><i class='fa fa-plus'></i> Add</a></p>

    <div class='card mb-5'>
        <div class='card-header'>Filter</div>
        <div class='card-body'>
            <form action="{{ route('game_manage') }}" method="GET">
                <div class="row">
                    <div class="col-sm-3 mb-2">
                        <input
                            type="text"
                            name="q"
                            placeholder="Search"
                            class="form-control"
                            value="{{ old('q', $vfilter['q'] ?? '') }}"
                        >
                    </div>

                    <div class="col-sm-3 mb-2">
                        <select name="category" class="form-control">
                            <option value="">Category</option>
                            @foreach ($category_list as $item)
                                <option
                                    value="{{ $item->id }}"
                                    @if (($vfilter['category'] ?? '') == $item->id) selected @endif
                                >
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-3 mb-2">
                        <div class="input-group">
                            <input
                                type="text"
                                id="drange"
                                name="drange"
                                class="form-control"
                                placeholder="Date Range"
                                autocomplete="off"
                                value="{{ old('drange', $vfilter['drange'] ?? '') }}"
                            >
                            <div class="input-group-text"><i class="fa fa-calendar bi bi-calendar"></i></div>
                        </div>
                    </div>

                    <div class="col-sm-3 mb-2">
                        <input type="submit" class="btn btn-primary" value="Filter">
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Removed unsafe raw output of $vfilter --}}

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
                                    <td>
                                        <img src='{{ $item->thumb }}' class='img-fluid img-thumbnail' width='150'>
                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->category->name ?? 'N/A' }}</td>
                                    <td>{{ $item->api->name ?? 'N/A' }}</td>
                                    <td>{{ $item->created_at ? $item->created_at->format('jS M Y H:i:s') : 'N/A' }}</td>
                                    <td>
                                        <a href='{{ route('game_create', ['id' => $item->id]) }}' class='btn btn-warning'>
                                            <i class='fa fa-pen'></i> Edit
                                        </a>
                                        <a href='{{ route('game_delete', ['id' => $item->id]) }}' class='btn btn-danger' onclick="return confirm_action()">
                                            <i class='fa fa-trash'></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $list->withQueryString()->links() }}
            </div>
        </div>
    @endif

</x-back-template>
