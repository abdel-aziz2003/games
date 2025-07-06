<x-back-template>
    <x-slot:title>Logo/Favicon</x-slot:title>

    <table class='table_form' align='center'>
        <tr>
            <td>
            <form action='{{ route('setting_icon_store') }}' method='post' enctype="multipart/form-data">
                @csrf

                <div class='row'>
                   
                    <div class='mb-3 col-6'>
                        <label>Logo</label>
                        <input type='file' class='form-control' name='logo'>
                        <img src='{{ url('public/images/'.config('settings.logo')) }}' class='img-fluid'><br />
                        <small>200x50px</small>
                    </div>
                    <div class='mb-3 col-6'>
                        <label>Favicon</label>
                        <input type='file' class='form-control' name='favicon'>
                        <img src='{{ url('public/images/'.config('settings.favicon')) }}' class='img-fluid'><br />
                        <small>32x32px</small>
                    </div>

                </div>
                <input class='btn btn-primary' type='submit' value='Save' name='save'>
            </form>
            </td>
        </tr>
    </table>


</x-back-template>
