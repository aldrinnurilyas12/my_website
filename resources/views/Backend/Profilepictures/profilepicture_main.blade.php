<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aldrin Nur Ilyas - Profile</title>
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
                    <h4>Profile</h4>
                    <hr>
                    @if ($profilepicture->isNotEmpty())
                    @else
                        <a class="btn btn-primary" style="size: 12px;" href="#" data-toggle="modal"
                            data-target="#createPostModal">Upload Foto Profil</a>
                    @endif
                </div>

                <br>
                @if ($profilepicture->isEmpty())
                    <div class="container-fluid px-4">
                        <div class="alert alert-info" role="alert">
                            Belum ada foto profil
                        </div>
                    </div>

                    @if ($bio == null)
                        <div class="container-fluid px-4">
                            <div class="alert alert-info" role="alert">
                                Belum ada bio
                            </div>
                        </div>
                    @else
                    @endif
                @else
                    @foreach ($profilepicture as $picture)
                        <div class="container-fluid px-4">
                            <div class="card w-100 mb-3">
                                <div class="card-body">
                                    <div class="img-profile">
                                        <label for=""><strong>Foto Profile</strong></label>
                                        <br>
                                        <img src="{{ asset('storage/' . $picture->profile_img) }}" alt=""
                                            class="img-fluid" style="width: 100px; height: 100px; border-radius: 10%;">

                                        <br>
                                        <br>
                                        <label for=""><strong>Bio</strong></label>
                                        <p>{{ $picture->bio }}</p>
                                    </div>
                                    <div class="btn-action">
                                        <a class="btn btn-primary" style="size: 12px;" href="#"
                                            data-toggle="modal" data-target="#projectModal{{ $picture->id }}">Ubah</a>
                                        <form action="{{ route('profile_delete', $picture->id) }}" method="POST">
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

    {{-- CREATE POSTS MODAL --}}

    <div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profilepictures.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label><strong>Upload Foto Profil</strong></label>
                            <input type="file" name="profile_img" class="form-control" type="text">
                        </div>

                        <div class="form-group">
                            <label><strong>Bio</strong></label>
                            <input type="text" name="bio" class="form-control" type="text">
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
    <!-- Modal Edit Profile -->
    @foreach ($profilepicture as $picture)
        <div class="modal fade" id="projectModal{{ $picture->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $picture->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Profile</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('profile_update', $picture->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label><strong>Ubah Gambar (Opsional)</strong></label>
                                <input type="file" name="profile_img" class="form-control" type="text">
                            </div>

                            <div class="form-group">
                                <label><strong>Bio</strong></label>
                                <input type="text" value="{{ $picture->bio }}" name="bio"
                                    class="form-control" type="text">
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
