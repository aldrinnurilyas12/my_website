<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <title>Aldrin Nur Ilyas - Working Experiences</title>
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
                        <h1>Working Experiences</h1>
                    </div>
                </div>


                <div class="introduction">
                    <h4 class="intro-title">Aldrin Nur Ilyas Working Experiences</h4>
                    <p class="intro-description">I'm want sharing my work experiences.
                    </p>
                </div>
            </div>


            <div class="content-wrap">
                <div class="card-post">
                    @if ($working->isEmpty())
                        <div class="container-fluid px-4">
                            <div class="alert">
                                Aldrin belum memposting apapun
                            </div>
                        </div>
                    @else
                        @foreach ($working as $work)
                            <div class="card-body-projects">
                                <div class="sharing-books-main">
                                    <div class="main-title-work-experience">

                                        <div class="working-date">
                                            <p class="date">

                                                {{ \Carbon\Carbon::parse($work->start_date)->translatedFormat('F Y') }}
                                                -

                                                @if ($work->end_date == null)
                                                    Sekarang
                                                @else
                                                    {{ \Carbon\Carbon::parse($work->end_date)->translatedFormat('F Y') }}
                                                @endif


                                            </p>
                                        </div>

                                        <div class="dot-content">
                                            <div class="company-name">

                                                <div class="vertical-list">
                                                    <span class="dot"></span>

                                                    <div class="vertical-line">

                                                        <div class="job-desc">
                                                            <span class="title-jobdesc">Job Description :</span>
                                                            <br>
                                                            <br>
                                                            <div class="jobdesc-content">

                                                                <p class="jobdesc-p">
                                                                    @foreach ($job_desc as $item)
                                                                        <li>{{ $item }}.</li>
                                                                    @endforeach

                                                                </p>


                                                            </div>

                                                            <span class="title-achievement">Achievement :</span>

                                                            <div class="jobdesc-content">

                                                                <p class="jobdesc-p">
                                                                    @if ($work->achievement == null)
                                                                        -
                                                                    @else
                                                                        @foreach ($achive as $item)
                                                                            <li>{{ $item }}.</li>
                                                                        @endforeach
                                                                    @endif

                                                                </p>


                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="title-company-name">
                                                    <h5>{{ $work->company_name }}</h5>
                                                    <div class="content-flex-job">
                                                        <span class="job-title">{{ $work->position }}</span>
                                                        <span class="dotted"> &#x1F784;</span>
                                                        <span class="industry">{{ $work->industry }}</span>
                                                    </div>
                                                </div>
                                            </div>

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
