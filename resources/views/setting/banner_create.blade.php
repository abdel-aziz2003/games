<x-back-template>
    <x-slot:title>Homepage Banner</x-slot:title>

    <table class='table_form' align='center'>
        <tr>
            <td>
            <form action='{{ route('setting_banner_store') }}' method='post' enctype="multipart/form-data">
                @csrf

                <div class='row'>
                   
                    <div class='mb-3 col-12'>
                        <label>Banner</label>
                        <input type='file' class='form-control' name='home_banner'>
                        <img src='{{ url('public/images/'.config('settings.home_banner')) }}' class='img-fluid'><br />
                        <small>1050x382px</small>
                    </div>

                </div>
                <input class='btn btn-primary' type='submit' value='Save' name='save'>
            </form>
            </td>
        </tr>
    </table>


</x-back-template>
