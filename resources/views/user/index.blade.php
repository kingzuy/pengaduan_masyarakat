<x-index>

    <div class="page-header align-items-start min-vh-100 pt-5 pb-7"
        style="background-image: url('https://a.travel-assets.com/findyours-php/viewfinder/images/res70/69000/69227-Jakarta.jpg'); background-position: top; ">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                    <p class="text-lead text-white">Berikut adalah beberapa pengaduan dari masyarakat</p>
                </div>
            </div>
            <div class="row">

                @if ($datas->count())
                    @foreach ($datas as $data)
                        <div class="col-lg-3">
                            <div class="card">
                                <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                    <a href="javascript:;" class="d-block blur-shadow-image">
                                        <img src="{{ asset('storage/public/image/' . $data->image) }}"
                                            class="img-fluid border-radius-lg">
                                    </a>
                                </div>
                                <div class="card-body">

                                    <p class="card-description mb-5">
                                        "{!! $data->laporan !!}"
                                    </p>
                                    <div class="pull-left">
                                        {{ $data->User->name }}
                                        <span>#</span>
                                        {{ $data->User->username }}
                                    </div>
                                    <a href="javascript:;" class="text-success icon-move-right pull-right">Read More
                                        <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                                    </a>

                                    <p
                                        class="mb-0 text-xs font-weight-bolder text-warning text-gradient text-uppercase">
                                        Proses
                                    </p>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-lead text-white">Data pengaduan tidak ada</p>
                @endif


            </div>
        </div>

</x-index>
