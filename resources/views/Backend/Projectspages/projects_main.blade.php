<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aldrin Nur Ilyas - Projects</title>
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
                    <h4>Projects Porfolio</h4>
                    <hr>
                    <a class="btn btn-primary" style="size: 12px;" href="#" data-toggle="modal"
                        data-target="#createPostModal">Buat Project</a>
                </div>

                <br>
                @if ($projects->isEmpty())
                    <div class="container-fluid px-4">
                        <div class="alert alert-info" role="alert">
                            Aldrin belum memposting projects apapun
                        </div>
                    </div>
                @else
                    @foreach ($projects as $project)
                        <div class="container-fluid px-4">
                            <div class="card w-100 mb-3">
                                <div class="card-body">
                                    <p class="date-posts">{{ $project->created_at }}</p>
                                    <p class="card-text">{{ $project->project_name }}
                                    </p>
                                    <div class="btn-action">
                                        <a class="btn btn-primary" style="size: 12px;" href="#"
                                            data-toggle="modal" data-target="#projectModal{{ $project->id }}">Ubah</a>
                                        <form action="{{ route('projects_delete', $project->id) }}" method="POST">
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Buat Project Portfolio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label><strong>Nama Project</strong></label>
                            <input name="project_name" class="form-control" type="text">
                        </div>

                        <div class="form-group">
                            <label><strong>Description</strong></label>
                            <textarea name="description" class="form-control" placeholder="Buat postingan">
                                    </textarea>
                        </div>

                        <div class="form-group">
                            <label><strong>Kategori Project</strong></label>
                            <select class="form-control" name="category_id" id="">
                                <option value="">=== Pilih Kategori Project ===</option>
                                @foreach ($project_category as $project)
                                    <option value="{{ $project->id }}">{{ $project->category_name }}</option>
                                @endforeach
                            </select>
                        </div>



                        <div class="form-group">
                            <label><strong>Tools/Sotware yang digunakan</strong></label>
                            <div class="checkbox-tools">
                                @foreach ($tools as $tool)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="tools[]"
                                            value="{{ $tool->tools_name }}" id="tool_{{ $tool->id }}">
                                        <label class="form-check-label" for="tool_{{ $tool->id }}">
                                            {{ $tool->tools_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>


                        </div>

                        <div class="form-group">
                            <label><strong>Link Github</strong></label>
                            <input name="github_link" class="form-control" type="text">
                        </div>

                        <div class="form-group">
                            <label><strong>Link Demo</strong></label>
                            <input name="demo_project_link" class="form-control" type="text">
                        </div>

                        <div class="form-group">
                            <label><strong>Tanggal Mulai Project</strong></label>
                            <input name="start_date" class="form-control" type="date">
                        </div>

                        <div class="form-group">
                            <label><strong>Tanggal Akhir Project</strong></label>
                            <input name="end_date" class="form-control" type="date">
                        </div>

                        <div class="form-group">
                            <label><strong>Status Project</strong></label>
                            <select class="form-control" name="project_status" id="">
                                <option value="">=== Pilih status project ===</option>
                                <option value="Progress">Progress</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Peninjauan ulang">Revisi/Tinjau Ulang</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><strong>Contributors (opsional)</strong></label>
                            <input name="contributors" class="form-control" type="text">
                        </div>

                        <div class="form-group">
                            <label><strong>Upload Gambar (Opsional)</strong></label>
                            <input type="file" name="media_files" class="form-control" type="text">
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
    @foreach ($projects as $project)
        <div class="modal fade" id="projectModal{{ $project->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle{{ $project->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Projects</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('projects_update', $project->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label><strong>Nama Project</strong></label>
                                <input name="project_name" value="{{ $project->project_name }}" class="form-control"
                                    type="text">
                            </div>


                            <div class="form-group">
                                <label><strong>Description</strong></label>
                                <textarea name="description" class="form-control" placeholder="Buat postingan">
                                    {{ $project->description }}
                                    </textarea>
                            </div>

                            <div class="form-group">
                                <label><strong>Link Github</strong></label>
                                <input name="github_link" value="{{ $project->github_link }}" class="form-control"
                                    type="text">
                            </div>

                            <div class="form-group">
                                <label><strong>Link Demo</strong></label>
                                <input name="demo_project_link" value="{{ $project->demo_project_link }}"
                                    class="form-control" type="text">
                            </div>

                            <div class="form-group">
                                <label><strong>Kategori Project</strong></label>
                                <select class="form-control" name="category_id" id="">
                                    @foreach ($project_category as $cat)
                                        <option value="{{ $project->id }}"
                                            {{ $cat->id == $project->category_id ? 'selected' : '' }}>
                                            {{ $cat->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="form-group">
                                <label><strong>Tools/Sotware yang digunakan</strong></label>
                                <div class="checkbox-tools">
                                    @foreach ($tools as $tool)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="tools[]"
                                                value="{{ $tool->tools_name }}" id="tool_{{ $tool->id }}">
                                            <label class="form-check-label" for="tool_{{ $tool->id }}">
                                                {{ $tool->tools_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>


                            </div>


                            <div class="form-group">
                                <label><strong>Tanggal Mulai Project</strong></label>
                                <input name="start_date"
                                    value="{{ old('end_date', $project->start_date ? $start_date->format('Y-m-d') : null) }}"
                                    class="form-control" type="date">
                            </div>

                            <div class="form-group">
                                <label><strong>Tanggal Akhir Project</strong></label>
                                <input name="end_date"
                                    value="{{ old('end_date', $project->end_date ? $end_date->format('Y-m-d') : null) }}"
                                    class="form-control" type="date">
                            </div>

                            <div class="form-group">
                                <label><strong>Status Project</strong></label>
                                <select class="form-control" name="project_status" id="">
                                    <option value="Progress"
                                        {{ $project->project_status == 'Progress' ? 'selected' : '' }}>Progress
                                    </option>
                                    <option value="Selesai"
                                        {{ $project->project_status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Peninjauan ulang"
                                        {{ $project->project_status == 'Peninjauan ulang' ? 'selected' : '' }}>
                                        Revisi/Tinjau Ulang</option>
                                </select>

                            </div>

                            <div class="form-group">
                                <label><strong>Contributors (opsional)</strong></label>
                                <input name="contributors" value="{{ $project->contributors }}" class="form-control"
                                    type="text">
                            </div>


                            <div class="form-group">
                                <label><strong>Upload Gambar (Opsional)</strong></label>
                                <input type="file" name="media_files" class="form-control" type="text">
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
