<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">

    <title>Aldrin Nur Ilyas - Projects Portfolio list</title>
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
                        <h1>Projects Portfolio</h1>
                    </div>
                </div>

                <div class="introduction">
                    <h4 class="intro-title">Aldrin Nur Ilyas Projects Portfolio List</h4>
                    <p class="intro-description">I'm wanna sharing to my projects for show projects in software
                        engineering.
                    </p>
                </div>
            </div>



            <div class="content-wrap">
                <div class="card-post">
                    @if ($projects->isEmpty())
                        <div class="container-fluid px-4">
                            <div class="alert">
                                Aldrin belum memposting apapun
                            </div>
                        </div>
                    @else
                        @foreach ($projects as $project)
                            <div class="card-body-projects">
                                <div class="projects-title">
                                    <div class="main-title">
                                        <h5 class="title-project">
                                            <a class="link-project"
                                                href="{{ route('displayproject', $project->project_code) }}">{{ $project->project_name }}</a>
                                        </h5>

                                        <div class="project-category">
                                            <span>{{ $project->category_name }}</span>

                                            @if ($project->github_link)
                                                <span class="github-link">
                                                    <a href="{{ $project->github_link }}" target="_blank">
                                                        <img class="github-link-projects"
                                                            src="{{ asset('icon/github.png') }}" title="github-links">
                                                    </a>
                                                </span>
                                            @else
                                            @endif

                                            @if ($project->demo_project_link)
                                                <span class="github-link">
                                                    <a href="{{ $project->demo_project_link }}" target="_blank">
                                                        <img class="github-link-projects"
                                                            src="{{ asset('icon/globe.png') }}" title="demo project">
                                                    </a>
                                                </span>
                                            @else
                                            @endif
                                        </div>
                                        <p class="description">
                                            {{ $project->description }}
                                        </p>

                                        <div class="project-date">
                                            <span
                                                class="start-project-date">{{ \Carbon\Carbon::parse($project->start_date)->translatedFormat('F Y') }}

                                            </span>
                                            <span>-</span>
                                            @if ($project->end_date == null)
                                                <span class="end-project-date">Ongoing</span>
                                            @else
                                                <span
                                                    class="end-project-date">{{ \Carbon\Carbon::parse($project->end_date)->translatedFormat('F Y') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="image-project">

                                        @if ($project->media_files)
                                            <img class="project-img"
                                                src="{{ asset('storage/' . $project->media_files) }}"
                                                alt="Profile Picture" class="img-fluid rounded-circle">
                                        @else
                                        @endif
                                    </div>
                                </div>

                                <hr class="hr-post">
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>


        </div>
    </section>
</body>

</html>
