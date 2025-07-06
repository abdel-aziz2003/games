<x-back-template>
    <x-slot:title>Captcha</x-slot:title>
    <table class='table_form' align='center'>
        <tr>
            <td>
                <form action="{{ route('captcha_store') }}" method="post">
                    @csrf
                    <div class='row'>
                        <div class='col-sm-12 mb-2'>
                            <label>Site Key</label>
                            <input type='text' name='g_site_key' class='form-control'
                                value="{{ config('settings.g_site_key') }}">
                        </div>
                        <div class='col-sm-12 mb-2'>
                            <label>Secret Key</label>
                            <input type='text' name='g_secret_key' class='form-control'
                                value="{{ config('settings.g_secret_key') }}">
                        </div>
                    </div>

                    <input type='submit' name='save' class='btn btn-primary' value='Save'>
                </form>
            </td>
        </tr>
    </table>

</x-back-template>
