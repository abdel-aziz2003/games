<x-back-template>
    <x-slot:title>Categories</x-slot:title>

    <p><a href='{{ route('category_create') }}' class='btn btn-success'><i class='fa fa-plus'></i> Add</a></p>

    @if ($list->count() < 1)
        <x-no-record />
    @else
        <div class='card'>
            <div class='card-body'>
                {{ $list->count() }} records
                <div class='table-responsive'>
                    <table class='table table-bordered'>
                        <thead class='bg-secondary text-white'>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href='{{ route('category_create', ['id' => $item->id]) }}'
                                        class='btn btn-warning'><i class='fa fa-pen'></i>
                                        Edit</a>
                                    <a href='{{ route('category_delete', ['id' => $item->id]) }}'
                                        class='btn btn-danger'
                                        onclick="return confirm_action()"><i
                                            class='fa fa-trash'></i> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>

            </div>
        </div>
    @endif

</x-back-template>
