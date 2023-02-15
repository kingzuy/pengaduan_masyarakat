<x-admin-layout>

    <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}">

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
        data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                            href="{{ route('admin.dashboard') }}">Admin</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Petugas</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Petugas</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                </div>
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item dropdown pe-2 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0 dropdown-toggle" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user me-sm-1"></i>
                            <span class="d-sm-inline d-none">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
                            aria-labelledby="dropdownMenuButton" style="top: 0 !important;"">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="{{ url('/admin/profile') }}">
                                    Profile
                                </a>
                            </li>
                            <li class="mb-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item border-radius-md"
                                        href="{{ route('logout') }}"onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <div class="">
                            <div class="btn-toolbar justify-content-between" role="toolbar"
                                aria-label="Toolbar with button groups">
                                <h6 class="text-capitalize">Data Petugas</h6>
                                <div class="input-group">
                                    <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal"
                                        data-bs-target="#tambah-data">Tambah Petugas</button>
                                </div>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger text-white text-sm alert-dismissible fade show"
                                role="alert">
                                Error :
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close">&times;</button>
                            </div>
                        @endif
                        @if (session('error_message'))
                            <div class="alert alert-danger text-white alert-dismissible fade show" role="alert">
                                {{ session('error_message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close">&times;</button>
                            </div>
                        @endif

                        @if (session('message'))
                            <div class="alert alert-success text-white alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close">&times;</button>
                            </div>
                        @endif
                    </div>
                    <div class="card-body p-3">
                        <table class="table table-flush" id="datatable-basic">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIK
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Username</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Telp
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td class="text-sm font-weight-normal">{{ !$data->nik ? 'Null' : $data->nik }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            {{ !$data->name ? 'Null' : $data->name }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            {{ !$data->username ? 'Null' : $data->username }}</td>
                                        <td class="text-sm font-weight-normal">
                                            {{ !$data->telp ? 'Null' : $data->telp }}</td>
                                        <td class="text-sm font-weight-normal">
                                            <button type="button" class="btn btn-sm bg-gradient-info"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-form{{ $data->id }}">Edit</button>
                                            <button type="button" class="btn btn-sm bg-gradient-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-notification{{ $data->id }}">Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($datas as $data)
        <!-- Modal -->
        <div class="modal fade" id="modal-form{{ $data->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h3 class="font-weight-bolder text-info text-gradient">Edit Data Petugas</h3>
                                <p class="mb-0">Silahkan masukan value untuk mengedit data petugas</p>
                            </div>
                            <div class="card-body">
                                <form role="form text-left" method="POST"
                                    action="{{ route('admin.edit', $data->id) }}">
                                    @csrf
                                    @method('PATCH')

                                    <label>NIK</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="nik" class="form-control" placeholder="nik"
                                            aria-label="nik" aria-describedby="nik-addon"
                                            value="{{ old('nik', $data->nik) }}">
                                    </div>
                                    <label>Name</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="name" class="form-control" placeholder="name"
                                            aria-label="name" aria-describedby="name-addon"
                                            value="{{ old('name', $data->name) }}">
                                    </div>
                                    <label>Username</label>
                                    <div class="input-group mb-3">
                                        <input type="name" name="username" class="form-control"
                                            placeholder="username" aria-label="username"
                                            aria-describedby="username-addon"
                                            value="{{ old('username', $data->username) }}">
                                    </div>
                                    <label>Telp</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="telp" class="form-control" placeholder="telp"
                                            aria-label="telp" aria-describedby="telp-addon"
                                            value="{{ old('telp', $data->telp) }}">
                                    </div>
                                    <label>Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Password" aria-label="Password"
                                            aria-describedby="password-addon">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    @foreach ($datas as $data)
        <div class="modal fade" id="modal-notification{{ $data->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modal-notification" aria-hidden="true">
            <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="py-3 text-center">
                            <i class="ni ni-bell-55 ni-3x"></i>
                            <h4 class="text-gradient text-danger mt-4">Perhatian!</h4>
                            <p>apa anda serius menghapus data
                                <br>
                                {{ $data->name }}
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('admin.delete', $data->id) }}" method="post">
                            @method('DELETE')
                            @csrf

                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Back</button>
                            <button type="submit" class="btn btn-danger ml-auto">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Modal -->
    <div class="modal fade" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="modal-form"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-info text-gradient">Tambah Data Petugas</h3>
                            <p class="mb-0">Silahkan masukan value untuk menambahkan data petugas</p>
                        </div>
                        <div class="card-body">
                            <form role="form text-left" method="POST" action="{{ route('admin.post') }}">
                                @csrf

                                <label>NIK</label>
                                <div class="input-group mb-3">
                                    <input type="number" name="nik" class="form-control" placeholder="nik"
                                        aria-label="nik" aria-describedby="nik-addon" value="{{ old('nik') }}">
                                </div>
                                <label>Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="name"
                                        aria-label="name" aria-describedby="name-addon" value="{{ old('name') }}">
                                </div>
                                <label>Username</label>
                                <div class="input-group mb-3">
                                    <input type="name" name="username" class="form-control"
                                        placeholder="username" aria-label="username"
                                        aria-describedby="username-addon" value="{{ old('username') }}">
                                </div>
                                <label>Telp</label>
                                <div class="input-group mb-3">
                                    <input type="number" name="telp" class="form-control" placeholder="telp"
                                        aria-label="telp" aria-describedby="telp-addon" value="{{ old('telp') }}">
                                </div>
                                <label>Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Password" aria-label="Password"
                                        aria-describedby="password-addon">
                                </div>
                                <div class="text-center">
                                    <button type="submit" name="role" value="1"
                                        class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/plugins/datatable.js') }}"></script>
    <script type="text/javascript">
        const dataTableBasic = new simpleDatatables.DataTable("#datatable-basic", {
            searchable: true,
            fixedHeight: true
        });
    </script>
</x-admin-layout>
