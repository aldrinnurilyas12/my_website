<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
    <title>Aldrin Nur Ilyas</title>
</head>

<body class="body-daily-post">
    <section class="main-daily-post">
        <div class="content-daily-post">
            <div class="title">
                <div class="dflex-title">

                    <div class="back">
                        <a href="{{ url('aldrinnurilyas') }}"> <img class="back-btn" src="{{ asset('icon/left.png') }}"
                                alt="">
                            <span>Back</span></a>
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


            <div class="card-body">
                <ul style="display: contents;" class="nav nav-tabs mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a data-mdb-tab-init class="nav-link active" id="ex1-tab-1" href="#ex1-tabs-1" role="tab"
                            aria-controls="ex1-tabs-1" aria-selected="true">Postingan</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a data-mdb-tab-init class="nav-link" id="ex1-tab-2" href="#ex1-tabs-2" role="tab"
                            aria-controls="ex1-tabs-2" aria-selected="false">Media</a>
                    </li>
                </ul>
            </div>

            <div class="content-wrap">
                <div class="tab-content" id="ex1-content">
                    {{-- Postingan --}}
                    <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                        <div id="table-detail" class="table-responsive">
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
                                            <img class="profile-picture-post"
                                                src="{{ asset('storage/' . $profile_img->first()->profile_img) }}"
                                                alt="Profile Picture" class="img-fluid rounded-circle">

                                            <div class="content-daily">
                                                <div class="title-time">
                                                    <h5 class="card-title">Aldrin Nur Ilyas</h5>
                                                    <span class="dotted"> &#x1F784;</span>
                                                    <span
                                                        class="time">{{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('j F Y h:i a') }}</span>
                                                </div>

                                                <div class="content-daily-posts">
                                                    @php
                                                        // Fetch images related to the current post
                                                        $post_images = DB::table('posts_view')
                                                            ->where('posts_id', $post->id)
                                                            ->limit(4)
                                                            ->get();
                                                    @endphp

                                                    @if ($post_images->isNotEmpty())
                                                        <div class="img-posts">
                                                            @foreach ($post_images as $image)
                                                                <a href="#" data-toggle="modal"
                                                                    data-target="#showImage{{ $image->id }}">
                                                                    <img class="img-daily-posts"
                                                                        src="{{ asset('storage/' . (is_array($image->posts_img) ? $image->posts_img[0] : $image->posts_img)) }}"
                                                                        alt="Thumbnail">
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                    <p class="text-post">{{ $post->post }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="hr-post">
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>

                    {{-- Media --}}
                    <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">

                        <div class="card-body">
                            <div id="table-detail" class="table-responsive">
                                <div class="card-post">
                                    <div class="img-content-post">
                                        @foreach ($all_images_show as $item)
                                            <a href="#" data-toggle="modal"
                                                data-target="#showImages{{ $item->img_id }}">
                                                <img class="img-daily-posts"
                                                    src="{{ asset('storage/' . $item->posts_img) }}" alt="">
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </section>


    {{-- MODAL SHOW IMAGES --}}
    @foreach ($all_images_show as $post)
        @php
            $images = is_array($post->posts_img) ? $post->posts_img : [$post->posts_img];
        @endphp

        <div class="modal fade" id="showImage{{ $post->img_id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $post->img_id }}" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Posts Image</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($images as $key => $img)
                                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"
                                        class="{{ $key === 0 ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div style="margin-bottom: 20px;" class="carousel-inner">
                                @foreach ($images as $key => $img)
                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                        <img style="width:400px; height:400px;" class="d-block w-100"
                                            src="{{ asset('storage/' . $img) }}" alt="Slide {{ $key + 1 }}">
                                    </div>
                                @endforeach
                            </div>

                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- END --}}


    {{-- SHOW IMAGES MEDIA --}}
    @foreach ($all_images_show as $post)
        @php
            $images = is_array($post->posts_img) ? $post->posts_img : [$post->posts_img];
        @endphp

        <div class="modal fade" id="showImages{{ $post->img_id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $post->img_id }}" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-body">

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div style="margin-bottom: 20px;" class="carousel-inner">
                                @foreach ($images as $key => $img)
                                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                        <img style="width:400px; height:400px;" class="d-block w-100"
                                            src="{{ asset('storage/' . $img) }}" alt="Slide {{ $key + 1 }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach




</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Select all tab links
        const tabLinks = document.querySelectorAll('.nav-link');

        // Add click event to each tab link
        tabLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent default anchor behavior

                // Remove active class from all links and hide all tab content
                tabLinks.forEach(item => {
                    item.classList.remove('active');
                    item.setAttribute('aria-selected', 'false');
                });
                document.querySelectorAll('.tab-pane').forEach(content => {
                    content.classList.remove('show', 'active');
                });

                // Add active class to the clicked link and show corresponding tab content
                this.classList.add('active');
                this.setAttribute('aria-selected', 'true');
                const target = this.getAttribute('href');
                document.querySelector(target).classList.add('show', 'active');
            });
        });
    });
</script>

</html>
