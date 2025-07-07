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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class='row'>
                        <div class='col-sm-12 mb-3'>
                            <label>Category*</label>
                            <select name='category' class='form-control' required>
                                <option value=''>Select Category</option>
                                @if($category_list->count() > 0)
                                    @foreach($category_list as $item)
                                        <option value='{{ $item->id }}'
                                            {{ old('category', @$info->category_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
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
                            <label>Slug</label>
                            <input type='text' name='slug' class='form-control'
                                value="{{ old('slug') ?? @$info->slug }}">
                            <small>Example: <code>super-mario-online</code>. Leave empty to generate from title.</small>
                        </div>

                        <div class='col-sm-12 mb-3'>
                            <label>Meta Title</label>
                            <input type='text' name='meta_title' class='form-control'
                                value="{{ old('meta_title') ?? @$info->meta_title }}">
                        </div>

                        <div class='col-sm-12 mb-3'>
                            <label>Meta Description</label>
                            <textarea name='meta_description' class='form-control' rows="3">{{ old('meta_description') ?? @$info->meta_description }}</textarea>
                            <small>This appears in Google search results.</small>
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
