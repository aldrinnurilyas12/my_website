<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <title>Aldrin Nur Ilyas</title>
</head>

<body>
    <section class="foto-profile">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="stories-circle">
                        @if ($profile->isEmpty())
                            <img class="profile-picture" src="{{ asset('img/blank.jpg') }}" title="stories"
                                class="img-fluid rounded-circle">
                        @else
                            <img class="profile-picture" src="{{ asset('storage/' . $profile->first()->profile_img) }}"
                                title="stories" class="img-fluid rounded-circle">
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <h1 class="name">Aldrin Nur Ilyas</h1>
                    @if ($profile->isEmpty())
                        -
                    @else
                        <p class="subtitle typewriter-animation">{{ $profile->first()->bio }}</p>
                    @endif

                </div>
                <div class="col-md-8">
                    <div class="icons">
                        <a href="https://www.instagram.com/aldrinnurilyas/" target="_blank">
                            <img src="{{ asset('icon/ig.png') }}" title="Instagram"></a>
                        <a href="https://x.com/aldrinnryas" target="_blank">
                            <img src="{{ asset('icon/x.png') }}" title="X"></a>
                        <a href="https://www.linkedin.com/in/aldrinnurilyas/" target="_blank">
                            <img src="{{ asset('icon/linkedin.png') }}" title="Linkedin"></a>
                        <a href="https://www.github.com/aldrinnurilyas12/" target="_blank">
                            <img src="{{ asset('icon/github.png') }}" title="Github"></a>
                        <a href="mailto:aldrinnoor1201@gmail.com" target="_blank">
                            <img src="{{ asset('icon/email.png') }}" title="Email"></a>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="main-menu">
                        <ul class="menu-list">
                            <li><a href="{{ url('about') }}">About <img class="link-href"
                                        src="{{ asset('icon/arrowup.png') }}" title=""></a></li>
                            <li><a href="{{ url('myworking') }}">Working Experiences <img class="link-href"
                                        src="{{ asset('icon/arrowup.png') }}" title=""></a></li>
                            <li><a href="{{ url('myprojects') }}">Projects <img class="link-href"
                                        src="{{ asset('icon/arrowup.png') }}" title=""></a></li>
                            <li><a href="{{ route('posts') }}">Daily Post <img class="link-href"
                                        src="{{ asset('icon/arrowup.png') }}" title=""></a></li>
                            <li><a href="{{ url('certification') }}">Podcast <img class="link-href"
                                        src="{{ asset('icon/arrowup.png') }}" title=""></a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </section>
</body>

</html>
