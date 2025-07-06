<x-back-template>
    <x-slot:title>Save Page</x-slot:title>
    <table class='table_form' align='center'>
        <tr>
            <td>
                <form action="{{ route('page_store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if ($id != '--')
                        <input type='hidden' name='id' value='{{ $id }}'>
                    @endif

                    <div class='row'>
                        <div class='col-sm-12 mb-3'>
                            <label>Page Name*</label>
                            <input type='text' name='name' required class='form-control'
                                value="{{ old('name') ?? @$info->name }}" @if(in_array(@$info->id, [1,2,3])) readonly @endif>
                        </div>

                        <div class='col-sm-12 mb-3'>
                            <label>Content</label>
                            <textarea class="form-control" name="content" id='editor' rows='10'>{{ old('content') ?? @$info->content }}</textarea>
                        </div>

                    </div>



                    <input type='submit' name='save' class='btn btn-primary' value='Save'>
                </form>
            </td>
        </tr>
    </table>

</x-back-template>
