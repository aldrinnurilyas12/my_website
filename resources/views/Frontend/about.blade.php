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
                    <img class="profile-picture" src="{{ asset('img/aldrin.jpg') }}" alt="Profile Picture"
                        class="img-fluid rounded-circle">
                </div>
                <div class="col-md-8">
                    <h1 class="name">Aldrin Nur Ilyas</h1>

                </div>
                <div class="col-md-8">
                    <div class="description">
                        <p class="description-text">I am a web application developer with a passion for creating
                            innovative solutions. <br>
                            I love exploring new technologies and applying them to real-world problems. In my
                            free time, I enjoy reading books, traveling, and trying out new foods.</p>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="back">
                        <a href="{{ url('aldrinnurilyas') }}"> <img class="back-btn" src="{{ asset('icon/left.png') }}"
                                alt="">
                            <span>Back</span></a>
                    </div>
                </div>
            </div>
        </div>

    </section>
</body>

</html>
