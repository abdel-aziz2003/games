<x-front-template>
    <x-slot:title>{{ $info->name }}</x-slot:title>

    <div class="container-fluid">
        <h2>{{ $info->name }}</span></h2>
        <div class='container mt-5'>
            <div class='card bg-dark text-white'>
                <div class='card-body bg-dark text-white' style='color: #FFF !important'>
                    {!! $info->content !!}
                </div>
            </div>
            
        </div>
    </div>

</x-front-template>