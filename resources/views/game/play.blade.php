<x-front-template>
    <x-slot:title>Play Game</x-slot:title>

    <!-- ***** Featured Start ***** -->
    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-sm-2 mb-2">
                    <img src="{{ $info->thumb }}" alt="" style="border-radius: 23px;"
                        class='img-fluid'><br /><br />
                    <p align='center'><button onclick="goFullscreen('embededGame'); return false"
                            class='btn btn-primary'><i class="fas fa-expand-arrows-alt"></i> Fullscreen</button></p>
                    @if (config('settings.play_ad') != '')
                        <div class='mt-5'></div>
                        <p align='center'><img src='{{ url('public/images/ads/' . config('settings.play_ad')) }}'
                                class='img-fluid img-thumbnail'></p>
                    @endif

                    <script>
                        function goFullscreen(id) {
                            var element = document.getElementById(id);
                            if (element.mozRequestFullScreen) {
                                element.mozRequestFullScreen();
                            } else if (element.webkitRequestFullScreen) {
                                element.webkitRequestFullScreen();
                            }
                        }
                    </script>
                </div>
                <div class="col-sm-10 mb-2">
                    <iframe src="{{ $info->url }}" id='embededGame' width="100%" height="500" frameborder="0"
                        webkitallowfullscreen="true" mozallowfullscreen="true" allowfullscreen marginheight="0"
                        scrolling="no"></iframe>
                    <ul class='list-inline text-white'>
                        <li class='list-inline-item'><i class="fas fa-eye"></i> {{ $info->view }}</li>
                        <li class='list-inline-item'><a onclick="like_game({{ $info->id }});" style="cursor:pointer;"><i
                                    class="fas fa-thumbs-up text-success"></i></a> <span id='thumb_up'>{{ $info->thumb_up }}</span></li>
                        <li class='list-inline-item'><a onclick="dislike_game({{ $info->id }});" style="cursor:pointer;"><i
                                    class="fas fa-thumbs-down text-danger"></i></a> <span id='thumb_down'>{{ $info->thumb_down }}</span></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- ***** Featured End ***** -->

    <!-- ***** Details Start ***** -->
    <div class="game-details">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{ $info->title }}</h2>
            </div>
            <div class="col-lg-12">
                <div class="content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="left-info">
                                <div class="left text-white">
                                    <h4>Instructions:</h4>
                                    <small>{{ $info->instructions }}</small>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-12 text-white">
                            <h4>Description</h4><br />
                            <small>{{ $info->description }}</small>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Details End ***** -->

    <!-- ***** Other Start ***** -->
    <div class="other-games">
        <div class="row">
            <div class="col-lg-12">
                <div class="heading-section">
                    <h4><em>Related</em> Games</h4>
                </div>
            </div>
            @if ($related_games->count() > 0)
                <x-game-list :list="$related_games" />
            @endif
        </div>
    </div>
    <!-- ***** Other End ***** -->

    <x-category-section />

</x-front-template>

<script>
    function like_game(id) {

            $.ajax({
                type: 'post',
                url: "{{ route('like_game') }}",
                dataType:"json",
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.code=="200") {
                        document.getElementById("thumb_up").innerHTML=response.count;
                    }
                }
            });


        return false;
    }
</script>

<script>
    function dislike_game(id) {

            $.ajax({
                type: 'post',
                url: "{{ route('dislike_game') }}",
                dataType:"json",
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.code=="200") {
                        document.getElementById("thumb_down").innerHTML=response.count;
                    }
                }
            });


        return false;
    }
</script>
