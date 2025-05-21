<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aldrin Nur Ilyas - Working Experiences</title>
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
                    <h4>Working Experiences</h4>
                    <hr>
                    <a class="btn btn-primary" style="size: 12px;" href="#" data-toggle="modal"
                        data-target="#createPostModal">Tambah Pengalaman Kerja</a>
                </div>

                <br>
                @if ($working->isEmpty())
                    <div class="container-fluid px-4">
                        <div class="alert alert-info" role="alert">
                            Aldrin belum menambahkan pengalaman kerja
                        </div>
                    </div>
                @else
                    @foreach ($working as $work)
                        <div class="container-fluid px-4">
                            <div class="card w-100 mb-3">
                                <div class="card-body">
                                    <p class="date-posts">{{ $work->created_at }}</p>
                                    <p style="margin: 0;" class="card-text">{{ $work->company_name }}
                                    </p>
                                    <p style="font-size: 13px; color:black;margin:8;">
                                        {{ \Carbon\Carbon::parse($work->start_date)->translatedFormat('F Y') }} -

                                        @if ($work->end_date == null)
                                            Sekarang
                                        @else
                                            {{ \Carbon\Carbon::parse($work->end_date)->translatedFormat('F Y') }}
                                        @endif
                                    </p>
                                    <div class="btn-action">
                                        <a class="btn btn-primary" style="size: 12px;" href="#"
                                            data-toggle="modal" data-target="#projectModal{{ $work->id }}">Ubah</a>
                                        <form action="{{ route('work_delete', $work->id) }}" method="POST">
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pengalaman Kerja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('workingexperiences.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label><strong>Nama Perusahaan</strong></label>
                            <input name="company_name" class="form-control" type="text">
                        </div>

                        <div class="form-group">
                            <label><strong>Posisi</strong></label>
                            <input name="position" class="form-control" type="text">
                        </div>

                        <div class="form-group">
                            <label><strong>Job Description</strong></label>
                            <br>
                            <span class="alert-desc">* Berikan tanda titik (.) akhir kalimat </span>
                            <textarea name="job_description" class="form-control" placeholder="Buat postingan">
                                    </textarea>
                        </div>

                        <div class="form-group">
                            <label><strong>Bidang Pekerjaan</strong></label>
                            <select class="form-control" name="industry" id="">
                                <option value="">=== Pilih Bidang Pekerjaan ===</option>
                                @foreach ($work_category as $category)
                                    <option value="{{ $category->id }}">{{ $category->industry }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label><strong>Tools/Sotware yang digunakan</strong> (optional)</label>
                            <div class="checkbox-tools">
                                @foreach ($software_tools as $tool)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="software_tools[]"
                                            value="{{ $tool->tools_name }}" id="tool_{{ $tool->id }}">
                                        <label class="form-check-label" for="tool_{{ $tool->id }}">
                                            {{ $tool->tools_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="form-group">
                            <label><strong>Achievement (Opsional)</strong></label>
                            <br>
                            <span class="alert-desc">* Berikan tanda titik (.) akhir kalimat </span>
                            <textarea name="achievement" class="form-control" placeholder="Buat postingan">
                                    </textarea>
                        </div>

                        <div class="form-group">
                            <label><strong>Tanggal Mulai Bekerja</strong></label>
                            <input name="start_date" class="form-control" type="date">
                        </div>

                        <div class="form-group">
                            <label><strong>Tanggal Akhir Bekerja</strong></label>
                            <input name="end_date" class="form-control" type="date">
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



    <!-- Modal UPDATED -->
    @foreach ($working as $work)
        <div class="modal fade" id="projectModal{{ $work->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $work->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Pengalaman Kerja</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('work_update', $work->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @METHOD('PUT')
                            <div class="form-group">
                                <label><strong>Nama Perusahaan</strong></label>
                                <input name="company_name" value="{{ $work->company_name }}" class="form-control"
                                    type="text">
                            </div>

                            <div class="form-group">
                                <label><strong>Posisi</strong></label>
                                <input name="position" value="{{ $work->position }}" class="form-control"
                                    type="text">
                            </div>

                            <div class="form-group">
                                <label><strong>Job Description</strong></label>
                                <br>
                                <span class="alert-desc">* Berikan tanda titik (.) akhir kalimat </span>
                                <textarea name="job_description" class="form-control" placeholder="Buat postingan">
                                {{ $work->job_description }}    </textarea>
                            </div>

                            <div class="form-group">
                                <label><strong>Bidang Pekerjaan</strong></label>
                                <select class="form-control" name="industry" id="">
                                    @foreach ($work_category as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ $cat->id == $work->industry ? 'selected' : '' }}>
                                            {{ $cat->industry }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label><strong>Tools/Sotware saat ini:</strong></label>
                                <br>
                                @if ($work->tools)
                                    <span>{{ $work->tools }}</span>
                                @else
                                    -
                                @endif
                            </div>

                            <div class="form-group">
                                <label><strong>Tools/Sotware yang digunakan</strong> (optional)</label>
                                <br>
                                <span style="font-size: 12px; color:red; font-style:italic;">*pilih kembali jika ingin
                                    mengubah tools</span>
                                <div class="checkbox-tools">
                                    @foreach ($software_tools as $tool)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="software_tools[]"
                                                value="{{ $tool->tools_name }}" id="tool_{{ $tool->id }}">
                                            <label class="form-check-label" for="tool_{{ $tool->id }}">
                                                {{ $tool->tools_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>


                            </div>

                            <div class="form-group">
                                <label><strong>Achievement (Opsional)</strong></label>
                                <br>
                                <span class="alert-desc">* Berikan tanda titik (.) akhir kalimat </span>
                                <textarea name="achievement" class="form-control" placeholder="Buat postingan">
                                  {{ $work->achievement }}  </textarea>
                            </div>

                            <div class="form-group">
                                <label><strong>Tanggal Mulai Project</strong></label>
                                <input name="start_date"
                                    value="{{ old('end_date', $work->start_date ? $start_date->format('Y-m-d') : null) }}"
                                    class="form-control" type="date">
                            </div>

                            <div class="form-group">
                                <label><strong>Tanggal Akhir Project</strong></label>
                                <input name="end_date"
                                    value="{{ old('end_date', $work->end_date ? $end_date->format('Y-m-d') : null) }}"
                                    class="form-control" type="date">
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


    span.alert-desc {
        font-size: 13px;
        color: rgb(255, 0, 0);
        font-style: italic;
    }
</style>

</html>
