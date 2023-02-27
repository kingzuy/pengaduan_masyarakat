<x-admin-layout>

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}"> --}}

    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
        data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                            href="{{ route('admin.dashboard') }}">Admin</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Laporan</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Laporan</h6>
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
                                <h6 class="text-capitalize">Data Laporan/Pengaduan</h6>
                                <div class="input-group">
                                    <select type="button" onchange="filtering()" id="filter"
                                        class="btn bg-gradient-primary">
                                        <option value="">Pilih Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Proses">Proses</option>
                                        <option value="Done">Done</option>
                                    </select>
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
                    <div class="card-body p-3" id="list-data">
                        @foreach ($datas as $data)
                            <!-- Card with an image on left -->
                            <div class="card mb-3 info-card sales-card" style="display: block"
                                id="data-{{ $data->id }}">
                                <div class="row g-0">
                                    <div class="col-md-2">
                                        @if ($data->image)
                                            <img class="img-fluid rounded-start"
                                                src="{{ asset('storage/image/' . $data->image) }}" alt="">
                                        @else
                                            <img class="img-fluid rounded-start"
                                                src="{{ asset('storage/image/' . $data->image) }}" alt="">
                                        @endif
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            @if ($data->user_id != 0)
                                                <h5 class="card-title">
                                                    {{ $data->User->name }}<span
                                                        class="fw-normal">#{{ $data->User->username }}</span>
                                                </h5>
                                            @else
                                                <h5 class="card-title">
                                                    {{ $data->old_name }}<span
                                                        class="fw-normal">#{{ $data->old_username }}<br>
                                                        <span class="text-sm">(user telah dihapu)</span>
                                                    </span>
                                                </h5>
                                            @endif
                                            <p style="color : black;" class="card-text">
                                                {!! $data->laporan !!}</p>
                                            @if ($data->status == 'Process')
                                                <span id="status" class="badge bg-gradient-info">Process</span>
                                            @elseif ($data->status == 'Done')
                                                <span id="status" class="badge bg-gradient-success">Done</span>
                                            @else
                                                <span id="status"
                                                    class="badge bg-gradient-secondary">Pending</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 my-auto">
                                        <button type="button" class="btn bg-gradient-info" data-bs-toggle="modal"
                                            data-bs-target="#tanggapan{{ $data->id }}">Tanggapan</button>
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#action{{ $data->id }}"
                                            class="btn bg-gradient-success">Action</button>
                                    </div>
                                </div>
                            </div><!-- End Card with an image on left -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($datas as $data)
        <!-- Modal -->
        <div class="modal fade" id="tanggapan{{ $data->id }}" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Beri Tanggapan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <ul class="chat">
                            <li class="left clearfix">
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        @if ($data->user_id != 0)
                                            <strong class="primary-font">{{ $data->User->name }}<span
                                                    class="fw-normal">#{{ $data->User->username }}</span></strong>
                                            <br>
                                        @else
                                            <strong class="primary-font">{{ $data->old_name }}<span
                                                    class="fw-normal">#{{ $data->old_username }}<br>
                                                    <span class="text-sm">(user telah dihapu)</span>
                                                </span>
                                            </strong>
                                            <br>
                                        @endif
                                        <small class="float-right text-muted"><span
                                                class="glyphicon glyphicon-time"></span>{{ $data->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p>
                                        {!! $data->laporan !!}
                                    </p>
                                </div>
                            </li>
                            @if ($data->Tanggapan)
                                @foreach ($data->Tanggapan as $tanggapan)
                                    <li class="right clearfix">
                                        <div class="chat-body clearfix">
                                            <div class="header">
                                                @if ($tanggapan->User->id == auth()->user()->id)
                                                    <strong class="primary-font">You</strong>
                                                    <br>
                                                    <small class="float-left text-muted"><span
                                                            class="glyphicon glyphicon-time"></span>{{ $data->created_at->diffForHumans() }}</small>
                                                @else
                                                    <strong class="primary-font">{{ $tanggapan->User->name }}<span
                                                            class="fw-normal">#{{ $tanggapan->User->username }}</span></strong>
                                                    <br>
                                                    <small class="float-left text-muted"><span
                                                            class="glyphicon glyphicon-time"></span>{{ $data->created_at->diffForHumans() }}</small>
                                                @endif
                                            </div>
                                            <p>
                                                {!! $tanggapan->pesan !!}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <form action="{{ route('admin.pengaduan.post') }}" method="POST">
                        <div class="modal-footer">
                            @csrf
                            <input type="hidden" name="pengaduan_id" value="{{ $data->id }}">
                            <input class="form-control" placeholder="masukan pesan" type="text" name="pesan"
                                id="pesan" required>
                            <button type="submit" class="btn btn-primary">Send</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    @foreach ($datas as $data)
        <div class="modal fade" id="action{{ $data->id }}" tabindex="-1" role="dialog"
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
                            <h4 class="text-gradient text-danger mt-4">Pilih Action!</h4>
                            <p>pilih action di bawah</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#status{{ $data->id }}">Ubah Status</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#delete{{ $data->id }}"
                            class="btn btn-danger ml-auto">Delete</button>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.pengaduan.updateStatus', $data->id) }} " method="post">
            @method('PATCH')
            @csrf
            <div class="modal fade" id="status{{ $data->id }}" tabindex="-1" role="dialog"
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
                            <select type="button" name="ststus" id="filter"
                                class="btn bg-gradient-primary w-100">
                                <option value="">Pilih Status</option>
                                @foreach ($status as $s)
                                    <option value="{{ $s }}" {{ $data->status == $s ? 'selected' : '' }}>
                                        {{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Back</button>
                            <button type="submit" class="btn btn-success ml-auto">Ubah</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="modal fade" id="delete{{ $data->id }}" tabindex="-1" role="dialog"
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
                            <p>apa anda serius menghapus data tersebut </p>
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

    <script>
        function filtering() {
            let listData = document.querySelector("#list-data");
            let dataIds = listData.querySelectorAll("[id^='data-']");
            let statusId = listData.querySelector("#status");

            let filter = document.querySelector("#filter").value;

            for (let i = 0; i < dataIds.length; i++) {
                let dataId = dataIds[i];
                let dataIdProcess = dataId.getAttribute("id").replace("data-", "");
                let status = statusId.innerHTML;

                if (filter != "") {
                    if (status == filter) {
                        dataId.style.display = "block";
                    } else {
                        dataId.style.display = "none";
                    }
                } else {
                    dataId.style.display = "block";
                }

                // console.log("filter : ", filter)
                // console.log("Data ID Process: ", dataIdProcess);
                // console.log("Status: ", status);
            }
        }
    </script>
</x-admin-layout>
