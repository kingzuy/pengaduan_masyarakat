<x-app-layout>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengaduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Ajukan Pengaduan') }}
                            </h2>

                            <p class="mt-1 mb-3 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Ajukan pengaduan sekarang juga') }}
                            </p>
                        </header>

                        @if (auth()->user()->nik == null || auth()->user()->telp == null)
                            <label class='block font-medium text-sm text-red-700 dark:text-red-300'>
                                Harap lengkapi NIK dan nomer telepon anda
                            </label>
                            <a class="block underline font-medium text-sm text-red-700 dark:text-red-300"
                                href="{{ route('profile.edit') }}"> Click
                                di sini untuk melengkapi nik dan no telp</a>
                        @endif

                        <form method="post" action="{{ route('post.pengaduan') }}" class="mt-3 space-y-6"
                            enctype="multipart/form-data">
                            @csrf

                            <div>
                                <x-input-label for="laporan" :value="__('Laporan')" />
                                <textarea rows="7" cols="50"
                                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
                                    id="laporan" name="laporan" type="text" autofocus @if (auth()->user()->nik == null || auth()->user()->telp == null) disabled @endif>
                                    {{ old('laporan') }}
                                    </textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('laporan')" />
                            </div>

                            <div>
                                {{-- <x-input-label for="dropzone-file" :value="__('Foto (Jika ada)')" /> --}}

                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="file_input">Upload file foto (tidak wajib)</label>
                                <input name="image"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="file_input_help" id="file_input" type="file"
                                    @if (auth()->user()->nik == null || auth()->user()->telp == null) disabled @endif>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">JPEG, PNG,
                                    JPG, GIF, SVG</p>

                                <x-input-error class="mt-2" :messages="$errors->get('image')" />
                            </div>

                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                @if (auth()->user()->nik == null || auth()->user()->telp == null) disabled @endif>Kirim</button>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>

</x-app-layout>
