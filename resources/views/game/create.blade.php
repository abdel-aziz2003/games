<x-back-template>
    <x-slot:title>Save Game</x-slot:title>
    <table class='table_form' align='center'>
        <tr>
            <td>
                <form action="{{ route('game_store') }}" method="post">
                    @csrf
                    @if ($id != '--')
                        <input type='hidden' name='id' value='{{ $id }}'>
                    @endif

                    <div class='row'>
                        <div class='col-sm-12 mb-3'>
                            <label>Gategory*</label>
                            <select name='category' class='form-control' required>
<option value=''>Select Category</option>
@if($category_list->count() > 0)
@foreach($category_list as $item)
<option value='{{ $item->id }}' @if(old('category') == $item->id) selected @elseif(@$info->category_id == $item->id) selected @endif>{{ $item->name }}</option>
@endforeach
@endif
                            </select>
                        </div>

                        <div class='col-sm-12 mb-3'>
                            <label>Title*</label>
                            <input type='text' name='title' required class='form-control'
                                value="{{ old('title') ?? @$info->title }}">
                        </div>

                        <div class='col-sm-12 mb-3'>
                            <label>Description*</label>
<textarea name='description' required class='form-control'>{{ old('description') ?? @$info->description }}</textarea>
                        </div>

                        <div class='col-sm-12 mb-3'>
                            <label>Instructions*</label>
<textarea name='instructions' required class='form-control'>{{ old('instructions') ?? @$info->instructions }}</textarea>
                        </div>

                        <div class='col-sm-12 mb-3'>
                            <label>Game URL*</label>
                            <input type='text' name='url' required class='form-control'
                                value="{{ old('url') ?? @$info->url }}">
                        </div>

                        <div class='col-sm-12 mb-3'>
                            <label>Game Image*</label>
                            <input type='text' name='thumb' required class='form-control'
                                value="{{ old('thumb') ?? @$info->thumb }}">
                                <small>512x384px</small>
                        </div>

                    </div>



                    <input type='submit' name='save' class='btn btn-primary' value='Save'>
                </form>
            </td>
        </tr>
    </table>

</x-back-template>
