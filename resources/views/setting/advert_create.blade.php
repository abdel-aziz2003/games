<x-back-template>
    <x-slot:title>Advert</x-slot:title>

                <form action='{{ route('advert_store') }}' method='post' enctype="multipart/form-data">
                    @csrf

                    <div class='card mb-4'>
                        <div class='card-header'>Template Ad</div>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-sm-6 mb-2'>
                                    <input type='file' class='form-control' name='template_ad'>
                                </div>
                                <div class='col-sm-6 mb-2'>
                                    <input type='text' name='template_ad_link' class='form-control' placeholder='Ad Link'
                                        value='{{ $info->template_ad_link }}'>
                                </div>
                            </div>
                            @if ($info->template_ad != '')
                            <div class='row'>
                                <div class='col-sm-9 mb-2'>
                                    <img src='{{ url('public/images/ads/' . config('settings.template_ad')) }}'
                                    class='img-fluid'><br />
                                <small>1100x150px</small>
                                </div>
                                <div class='col-sm-3 mb-2'>
                                    <a href='{{ route('remove_ad', ['ad' => 'template_ad']) }}' class='btn btn-danger' onclick="return confirm_action();"><i class="fas fa-times"></i> Remove</a>
                                </div>
                            </div>
                                
                            @endif

                        </div>
                    </div>

                    <div class='card mb-4'>
                        <div class='card-header'>Game Ad</div>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-sm-6 mb-2'>
                                    <input type='file' class='form-control' name='game_ad'>
                                </div>
                                <div class='col-sm-6 mb-2'>
                                    <input type='text' name='game_ad_link' class='form-control' placeholder='Ad Link'
                                        value='{{ $info->game_ad_link }}'>
                                </div>
                            </div>
                            @if ($info->game_ad != '')
                            <div class='row'>
                                <div class='col-sm-9 mb-2'>
                                    <img src='{{ url('public/images/ads/' . config('settings.game_ad')) }}'
                                    class='img-fluid'><br />
                                <small>357x600px</small>
                                </div>
                                <div class='col-sm-3 mb-2'>
                                    <a href='{{ route('remove_ad', ['ad' => 'game_ad']) }}' class='btn btn-danger' onclick="return confirm_action();"><i class="fas fa-times"></i> Remove</a>
                                </div>
                            </div>
                                
                            @endif

                        </div>
                    </div>

                    <div class='card mb-4'>
                        <div class='card-header'>Play Ad</div>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-sm-6 mb-2'>
                                    <input type='file' class='form-control' name='play_ad'>
                                </div>
                                <div class='col-sm-6 mb-2'>
                                    <input type='text' name='play_ad_link' class='form-control' placeholder='Ad Link'
                                        value='{{ $info->play_ad_link }}'>
                                </div>
                            </div>
                            @if ($info->play_ad != '')
                            <div class='row'>
                                <div class='col-sm-9 mb-2'>
                                    <img src='{{ url('public/images/ads/' . config('settings.play_ad')) }}'
                                    class='img-fluid'><br />
                                <small>166x166px</small>
                                </div>
                                <div class='col-sm-3 mb-2'>
                                    <a href='{{ route('remove_ad', ['ad' => 'play_ad']) }}' class='btn btn-danger' onclick="return confirm_action();"><i class="fas fa-times"></i> Remove</a>
                                </div>
                            </div>
                                
                            @endif

                        </div>
                    </div>

                    

                    <input class='btn btn-primary' type='submit' value='Save' name='save'>
                </form>
           

</x-back-template>
