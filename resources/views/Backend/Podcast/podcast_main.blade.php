<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aldrin Nur Ilyas - Podcast</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="sb-nav-fixed">
    @include('components.component_admin.navbar.navbar')
    @include('components.component_admin.sidebar.sidebar')
    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <br>
                <div class="container-fluid px-4">
                    <h4>Podcast</h4>
                    <hr>
                    <a class="btn btn-primary" style="size: 12px;" href="#" data-toggle="modal"
                        data-target="#createPostModal">Buat Podcast</a>
                </div>

                <br>
                @if ($podcast->isEmpty())
                    <div class="container-fluid px-4">
                        <div class="alert alert-info" role="alert">
                            Aldrin belum memposting podcast apapun
                        </div>
                    </div>
                @else
                    @foreach ($podcast as $pod)
                        <div class="container-fluid px-4">
                            <div class="card w-100 mb-3">
                                <div class="card-body">
                                    <p class="date-posts">{{ $pod->created_at }}</p>
                                    <p class="card-text"><strong>{{ $pod->podcast_title }}</strong>
                                    </p>
                                    <p class="card-text">{{ $pod->podcast_subtitle }}</p>

                                    <div style="display: flex; gap:8px;" class="container-content">

                                        <div class="image-podcast">
                                            <img style="width: 70px; height:70px; border-radius:10px;"
                                                src="{{ 'storage/' . $pod->podcast_banner }}" alt="">
                                        </div>




                                        <audio controls>
                                            <source src="{{ 'storage/' . $pod->media_files }}" type="audio/mpeg">
                                        </audio>
                                    </div>

                                    <br>
                                    <div class="btn-action">
                                        <a class="btn btn-primary" style="size: 12px;" href="#"
                                            data-toggle="modal" data-target="#projectModal{{ $pod->id }}">Ubah</a>
                                        <form action="{{ route('podcast_delete', $pod->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif
            </main>
        </div>
    </div>

    {{-- CREATE PROJECT MODAL --}}

    <div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Buat Podcast</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('podcast.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label><strong>Nama Podcast</strong></label>
                            <input name="podcast_title" class="form-control" type="text">
                        </div>

                        <div class="form-group">
                            <label><strong>Subtitle Podcast</strong></label>
                            <input name="podcast_subtitle" class="form-control" type="text">
                        </div>

                        <div class="form-group">
                            <label><strong>Kategori Podcast</strong></label>
                            <select class="form-control" name="podcast_category" id="">
                                <option value="">=== Pilih Kategori Podcast ===</option>
                                @foreach ($podcast_category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label><strong>Upload Rekaman Podcast MP3</strong></label>
                            <input type="file" name="media_files" class="form-control" type="text">
                        </div>

                        <div class="form-group">
                            <label><strong>Upload Gambar Podcast (Opsional)</strong></label>
                            <input type="file" name="podcast_banner" class="form-control" type="text">
                        </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- END --}}
    <!--  UPDATE PROJECTS Modal -->
    @foreach ($podcast as $pod)
        <div class="modal fade" id="projectModal{{ $pod->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $pod->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Projects</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('podcast_update', $pod->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label><strong>Nama Podcast</strong></label>
                                <input name="podcast_title" value="{{ $pod->podcast_title }}" class="form-control"
                                    type="text">
                            </div>

                            <div class="form-group">
                                <label><strong>Subtitle Podcast</strong></label>
                                <input name="podcast_subtitle" value="{{ $pod->podcast_subtitle }}"
                                    class="form-control" type="text">
                            </div>


                            <div class="form-group">
                                <label><strong>Kategori Podcast</strong></label>
                                <select class="form-control" name="podcast_category" id="">
                                    @foreach ($podcast_category as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ $cat->id == $pod->podcast_category ? 'selected' : '' }}>
                                            {{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label><strong>Upload ulang Rekaman Podcast</strong></label>
                                <input type="file" name="media_files" class="form-control" type="text">
                            </div>

                            <div class="form-group">
                                <label><strong>Upload Gambar Podcast (Opsional)</strong></label>
                                <input type="file" name="podcast_banner" class="form-control" type="text">
                            </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</body>


@if (Session::has('message_success'))
    <script>
        Swal.fire({
            title: 'Berhasil',
            text: "{{ Session::get('message_success') }}",
            icon: 'success',
            position: 'top-end',
            toast: true,
            timer: 2000
        });
    </script>
@elseif (Session::has('message_error'))
    <script>
        Swal.fire({
            title: 'Gagal',
            text: "{{ Session::get('failed_message') }}",
            icon: 'error',
            position: 'top-end',
            toast: true,
            timer: 2000
        });
    </script>
@endif

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap');

    body {
        font-family: "DM Sans", serif;
    }

    .btn-action {
        display: flex;
        gap: 10px;
    }

    .date-posts {
        font-size: 12px;
        color: gray;
        margin-bottom: 10px
    }

    textarea {
        text-align: left;
    }

    .checkbox-tools {
        overflow-y: scroll;
        height: 100px
    }
</style>

</html>
