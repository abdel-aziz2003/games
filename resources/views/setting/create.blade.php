<x-back-template>
    <x-slot:title>Settings</x-slot:title>
    <table class='table_form' align='center'>
        <tr>
            <td>
                <form action="{{ route('setting_store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class='row'>
                        <div class='col-sm-12 mb-2'>
                            <label>Site Name*</label>
                            <input type='text' name='name' required class='form-control'
                                value="{{ config('settings.name') }}">
                        </div>
                        <div class='col-sm-6 mb-2'>
                            <label>Email*</label>
                            <input type='email' name='email' required class='form-control'
                                value="{{ config('settings.email') }}">
                        </div>
                        <div class='col-sm-6 mb-2'>
                            <label>Phone</label>
                            <input type='text' name='tell' class='form-control'
                                value="{{ config('settings.tell') }}">
                        </div>
                        <div class='col-sm-12 mb-2'>
                            <label>Address</label>
                            <textarea name='address' class='form-control'>{{ config('settings.address') }}</textarea>
                        </div>

                        <div class='col-sm-6 mb-2'>
                            <label>Meta Keywords</label>
                            <input type='text' name='meta_keyword' class='form-control'
                                value="{{ config('settings.meta_keyword') }}">
                                <small class='text-danger'>Enter keywords separated by comma</small>
                        </div>
                        <div class='col-sm-6 mb-2'>
                            <label>Meta Description</label>
                            <textarea name='meta_description' class='form-control'>{{ config('settings.meta_description') }}</textarea>
                        </div>
                    </div>

                    <input type='submit' name='save' class='btn btn-primary' value='Save'>
                </form>
            </td>
        </tr>
    </table>

</x-back-template>
