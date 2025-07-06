<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600|Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('public/template/back') }}/css/easion.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
    <script src="{{ url('public/template/back') }}/js/chart-js-config.js"></script>
    <x-head-inc />
    <title>{{ $title }}</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="form-screen">
        <a href="{{ route('welcome') }}" class="easion-logo"><img src='{{ url('public/images/'.config('settings.logo')) }}' class='img-fluid'></a>
        <div class="card account-dialog">
            <div class="card-header bg-primary text-white"> {{ $title }} </div>
            <div class="card-body">
                <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />
    <x-auth-errors :errors="$errors"/>

                {{ $slot }}
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ url('public/template/back') }}/js/easion.js"></script>
    <x-foot-inc/>
</body>

</html>