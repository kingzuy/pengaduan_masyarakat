 <x-admin-layout>
     <!-- Navbar -->
     <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
         data-scroll="false">
         <div class="container-fluid py-1 px-3">
             <nav aria-label="breadcrumb">
                 <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                     <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Admin</a></li>
                     <li class="breadcrumb-item text-sm text-white active" aria-current="page">Profile</li>
                 </ol>
                 <h6 class="font-weight-bolder text-white mb-0">Profile</h6>
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
                         <h6 class="text-capitalize">Profile</h6>
                     </div>
                     <div class="card-body p-3">
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
                         <form
                             @if (auth()->user()->role == 'admin') action="{{ route('admin.profile.edit') }}"
                         @else
                             action="{{ url('petugas/profile') }}" @endif
                             method="post">
                             @csrf
                             @method('PATCH')
                             <div class="row">
                                 <div class="col col-lg-6">

                                     <label>NIK</label>
                                     <div class="form-input mb-3">
                                         <input type="number" name="nik" class="form-control" placeholder="nik"
                                             aria-label="nik" aria-describedby="nik-addon"
                                             value="{{ old('nik', auth()->user()->nik) }}">
                                         @error('nik')
                                             <small class="text-danger">{{ $message }}</small>
                                         @enderror
                                     </div>
                                     <label>Name</label>
                                     <div class="form-input mb-3">
                                         <input type="text" name="name" class="form-control" placeholder="name"
                                             aria-label="name" aria-describedby="name-addon"
                                             value="{{ old('name', auth()->user()->name) }}">
                                         @error('name')
                                             <small class="text-danger">{{ $message }}</small>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="col col-lg-6">
                                     <label>Telp</label>
                                     <div class="form-input mb-3">
                                         <input type="number" name="telp" class="form-control" placeholder="telp"
                                             aria-label="telp" aria-describedby="telp-addon"
                                             value="{{ old('telp', auth()->user()->telp) }}">
                                         @error('telp')
                                             <small class="text-danger">{{ $message }}</small>
                                         @enderror
                                     </div>
                                     <label>Username</label>
                                     <div class="form-input mb-3">
                                         <input type="name" name="username" class="form-control"
                                             placeholder="username" aria-label="username"
                                             aria-describedby="username-addon"
                                             value="{{ old('username', auth()->user()->username) }}">
                                         @error('username')
                                             <small class="text-danger">{{ $message }}</small>
                                         @enderror
                                     </div>
                                 </div>
                                 <label>Password</label>
                                 <div class="form-input mb-3">
                                     <input type="password" name="password" class="form-control"
                                         placeholder="Password" aria-label="Password"
                                         aria-describedby="password-addon">
                                     @error('password')
                                         <small class="text-danger">{{ $message }}</small>
                                     @enderror
                                 </div>
                                 <button type="submit" name="role" value="1"
                                     class="btn btn-round bg-gradient-info btn-lg mt-4 mb-0">Simpan</button>


                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </x-admin-layout>
