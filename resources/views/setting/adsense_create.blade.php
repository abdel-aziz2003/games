<x-back-template>
    <x-slot:title>Google Adsense</x-slot:title>
    <table class='table_form' align='center'>
        <tr>
            <td>
                <form action="{{ route('adsense_store') }}" method="post">
                    @csrf

                    <div class='row'>
                        <div class='col-sm-12 mb-2'>
                            <label>Code</label>
                            <textarea name='adsense' class='form-control' rows="10">{{ config('settings.adsense') }}</textarea>
                        </div>

                    </div>

                    <input type='submit' name='save' class='btn btn-primary' value='Save'>
                </form>
            </td>
        </tr>
    </table>

</x-back-template>
