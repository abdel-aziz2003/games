<x-back-template>
    <x-slot:title>Save Category</x-slot:title>
    <table class='table_form' align='center'>
        <tr>
            <td>
                <form action="{{ route('category_store') }}" method="post">
                    @csrf
                    @if ($id != '--')
                        <input type='hidden' name='id' value='{{ $id }}'>
                    @endif

                    <div class='row'>
                        <div class='col-sm-12 mb-3'>
                            <label>Category Name*</label>
                            <input type='text' name='name' required class='form-control'
                                value="{{ old('name') ?? @$info->name }}">
                        </div>

                    </div>



                    <input type='submit' name='save' class='btn btn-primary' value='Save'>
                </form>
            </td>
        </tr>
    </table>

</x-back-template>
