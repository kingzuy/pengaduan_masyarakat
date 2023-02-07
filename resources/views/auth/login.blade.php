<x-guest-layout>
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>

    <div class="page-header align-items-start min-vh-100 pt-5 pb-7"
        style="background-image: url('{{ asset('assets/img/Jakarta.webp') }}'); background-position: top; ">
        <span class="mask bg-gradient-dark opacity-6"></span>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mx-auto">
                    <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                    <p class="text-lead text-white">Login sekarang juga undtu dapat melakukan pengaduan</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mt-5 mx-auto">
                    <div class="card z-index-0">
                        <div class="text-center pt-4">
                            <h5>Login Now</h5>
                        </div>
                        <div class="card-body">
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="username" placeholder="Username"
                                        aria-label="Username" value="{{ old('username') }}">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Password"
                                        aria-label="Password">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-1">Login</button>
                                    <small>Tidak punya akun? <a href="/register">Regist</a></small>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
