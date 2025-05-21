<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">

    <title>Aldrin Nur Ilyas - Podcast</title>
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
                        <h1>Podcast</h1>
                    </div>
                </div>

                <div class="introduction">
                    <h4 class="intro-title">Aldrin Nur Ilyas Podcast</h4>
                    <p class="intro-description">I'm wanna sharing my podcast for talks about projects in software
                        engineering, friends, foods, and any field.
                    </p>
                </div>
            </div>



            <div class="content-wrap">
                <div class="card-post-podcast">
                    @if ($podcast->isEmpty())
                        <div class="container-fluid px-4">
                            <div class="alert">
                                Aldrin belum upload podcast apapun
                            </div>
                        </div>
                    @else
                        @foreach ($podcast as $podcast)
                            <div style="margin-top:10px; " class="card-body-projects">
                                <div class="podcast-title">

                                    <div class="image-podcast">

                                        @if ($podcast->podcast_banner)
                                            <img class="podcast-img"
                                                src="{{ asset('storage/' . $podcast->podcast_banner) }}"
                                                alt="Profile Picture" class="img-fluid rounded-circle">
                                        @else
                                        @endif
                                    </div>

                                    <div class="main-title">
                                        <h5 class="title-project">
                                            {{ $podcast->podcast_title }}
                                        </h5>

                                        <div style="display: flex;" class="project-category">
                                            <span>{{ $podcast->category_name }}</span>

                                            <div class="project-date">
                                                <span style="border:none;color:black;"
                                                    class="start-project-date">{{ \Carbon\Carbon::parse($podcast->created_at)->translatedFormat('d F Y') }}
                                                </span>
                                            </div>
                                        </div>
                                        <p class="description">
                                            {{ $podcast->podcast_subtitle }}
                                        </p>



                                        <div class="podcast-content">
                                            <audio controls>
                                                <source src="{{ 'storage/' . $podcast->media_files }}"
                                                    type="audio/mpeg">
                                            </audio>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        @endforeach
                    @endif

                </div>
            </div>


        </div>
    </section>
</body>

</html>
