<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <title>Aldrin Nur Ilyas</title>
</head>

<body class="body-daily-post">
    <section class="main-daily-post">
        <div class="content-daily-post">
            <div class="title">
                <div class="dflex-title">
                    <div class="col-md-8">
                        <div class="back">
                            <a href="{{ url('aldrinnurilyas') }}"> <img class="back-btn"
                                    src="{{ asset('icon/left.png') }}" alt="">
                                <span>Back</span></a>
                        </div>
                    </div>

                    <div class="title-content">
                        <h1>Daily Post</h1>
                    </div>
                </div>


                <div class="introduction">
                    <h4 class="intro-title">Aldrin Nur Ilyas Daily Posts</h4>
                    <p class="intro-description">I'm wanna sharing my momment and experiences in my life.
                    </p>
                </div>
            </div>

            <div class="content-wrap">
                <div class="card-post">
                    @if ($posts->isEmpty())
                        <div class="container-fluid px-4">
                            <div class="alert">
                                Aldrin belum memposting apapun
                            </div>

                        </div>
                    @else
                        @foreach ($posts as $post)
                            <div class="card-body">
                                <img class="profile-picture-post" src="{{ asset('img/aldrin.jpg') }}"
                                    alt="Profile Picture" class="img-fluid rounded-circle">

                                <div class="content-daily">
                                    <div class="title-time">
                                        <h5 class="card-title">Aldrin Nur Ilyas</h5>
                                        <span class="dotted"> &#x1F784;</span>
                                        <span class="time">{{ $post->created_at->format(' j F Y H:i a') }} </span>
                                    </div>
                                    <p class="text-post"> {{ $post->post }}</p>
                                </div>
                            </div>
                            <hr class="hr-post">
                        @endforeach
                    @endif

                </div>
            </div>
    </section>
</body>

</html>
