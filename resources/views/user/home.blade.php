<x-app-layout>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.css" rel="stylesheet" />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home Data Pengaduan Anda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <section>
                    @if (session('message'))
                        <div id="alert-3"
                            class="flex p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                            role="alert">
                            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ml-3 text-sm font-medium">
                                {{ session('message') }}
                            </div>
                            <button type="button"
                                class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                                data-dismiss-target="#alert-3" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    @endif
                    @if (session('message_error'))
                        <div id="alert-2"
                            class="flex p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                            role="alert">
                            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ml-3 text-sm font-medium">
                                {{ session('message_error') }}
                            </div>
                            <button type="button"
                                class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                                data-dismiss-target="#alert-2" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    @endif
                    @if ($datas->count())
                        <div class="flex flex-col lg:flex-row lg:flex-wrap lg:items-stretch items-center gap-4 p-4">
                            @foreach ($datas as $data)
                                <div
                                    class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                    <a href="#">
                                        @if ($data->image)
                                            <img class="w-60 h-60 object-cover rounded-t-lg"
                                                src="{{ asset('storage/image/' . $data->image) }}" alt="" />
                                        @else
                                            <div class="w-60 h-60 object-cover rounded-t-lg">
                                                "{!! $data->laporan !!}"
                                            </div>
                                        @endif
                                    </a>
                                    <p class="mb-3 font-normal mt-3 text-gray-700 dark:text-gray-400">
                                        @if (empty($data->image))
                                        @else
                                            "{!! $data->laporan !!}"
                                        @endif
                                    </p>
                                    <button
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        data-modal-target="large-modal{{ $data->id }}"
                                        data-modal-toggle="large-modal{{ $data->id }}">
                                        Read more
                                        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>

                                    <!-- Large Modal -->
                                    <div id="large-modal{{ $data->id }}" tabindex="-1"
                                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                        <div class="relative w-full h-full max-w-4xl md:h-auto">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <!-- Modal header -->
                                                <div
                                                    class="flex items-center justify-between p-5 border-b rounded-t dark:border-gray-600">
                                                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                                                        Tanggapan
                                                    </h3>
                                                    <button type="button"
                                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                        data-modal-hide="large-modal{{ $data->id }}">
                                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="container ">
                                                    <div class="flex flex-col py-8 px-4">

                                                        {{-- jawab --}}
                                                        <div class="flex flex-row">
                                                            <div class="basis-1/4"></div>
                                                            <div
                                                                class="basis-3/4 rounded-lg bg-gray-100 py-2 px-4 mb-4">
                                                                <div class="flex items-center justify-between mb-2">
                                                                    <div class="flex items-center">
                                                                        <p class="text-sm font-medium text-gray-900">
                                                                            {{ $data->User->name }}<span
                                                                                class="text-sm text-gray-500">#{{ $data->User->username }}</span>
                                                                        </p>
                                                                    </div>
                                                                    <p class="text-xs text-gray-600">
                                                                        {{ $data->created_at->diffForHumans() }}</p>
                                                                </div>
                                                                <p class="text-sm text-gray-700">
                                                                    {!! $data->laporan !!}</p>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        @if ($data->Tanggapan->count())
                                                            @if ($data->Tanggapan->user_id != auth()->user()->id)
                                                                {{-- pesan --}}
                                                                <div class="flex flex-row">
                                                                    <div
                                                                        class="basis-3/4 rounded-lg bg-gray-100 py-2 px-4 mb-4">
                                                                        <div
                                                                            class="flex items-center justify-between mb-2">
                                                                            <div class="flex items-center">
                                                                                <p
                                                                                    class="text-sm font-medium text-gray-900">
                                                                                    {{ $data->Tanggapan->User->name }}<span
                                                                                        class="text-sm text-gray-500">#{{ $data->Tanggapan->User->username }}</span>
                                                                                </p>
                                                                            </div>
                                                                            <p class="text-xs text-gray-600">
                                                                                {{ $data->Tanggapan->created_at->diffForHumans() }}
                                                                            </p>
                                                                        </div>
                                                                        <p class="text-sm text-gray-700">
                                                                            {!! $data->Tanggapan->pesan !!}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                {{-- jawab --}}
                                                                <div class="flex flex-row">
                                                                    <div class="basis-1/4"></div>
                                                                    <div
                                                                        class="basis-3/4 rounded-lg bg-gray-100 py-2 px-4 mb-4">
                                                                        <div
                                                                            class="flex items-center justify-between mb-2">
                                                                            <div class="flex items-center">
                                                                                <p
                                                                                    class="text-sm font-medium text-gray-900">
                                                                                    {{ $data->Tanggapan->User->name }}<span
                                                                                        class="text-sm text-gray-500">#{{ $data->Tanggapan->User->username }}</span>
                                                                                </p>
                                                                            </div>
                                                                            <p class="text-xs text-gray-600">
                                                                                {{ $data->Tanggapancreated_at->diffForHumans() }}
                                                                            </p>
                                                                        </div>
                                                                        <p class="text-sm text-gray-700">
                                                                            {!! $data->Tanggapan->pesan !!}</p>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif



                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div
                                                        class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                        <input type="text" class="basis-3/4 rounded-lg text-sm">
                                                        <button data-modal-hide="large-modal{{ $data->id }}"
                                                            type="button"
                                                            class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                                                            accept</button>
                                                        <button data-modal-hide="large-modal{{ $data->id }}"
                                                            type="button"
                                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                            @endforeach
                        </div>
                    @else
                        <p class="flex justify-center items-center">Data pengaduan tidak ada</p>
                    @endif
                </section>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>

</x-app-layout>
