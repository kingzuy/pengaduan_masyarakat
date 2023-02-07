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
 </x-admin-layout>