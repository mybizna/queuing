@extends('base::app')

@section('content')
    <section class="bg-blue-50">

        <script>
            // for php demo call
            function ajax_print(url, btn) {

                fetch(url)
                    .then((response) => response.text())
                    .then(text => {
                        window.location.href = text;
                    });
            }
        </script>


        <div class="w-full md:w-4/5 lg:w-1/2 mx-auto pt-5">

            <div>
                <h1 class="text-4xl font-semibold text-center text-blue-900">TICKET</h1>
            </div>

            {{--
            <div class=" shadow-xl rounded-md bg-white sm:mr-2 my-4 pt-2 p-2">
                <div class="overflow-hidden">
                        <p class="text-gray-500">
                            Phone Number:
                        </p>
                        <div class="text-center">
                            <input
                                class="formkit-input form-input rounded border py-2 px-3 focus:border-sky-500 hover:border-sky-500 text-grey-800 text-6xl h-20 w-full"
                                type="text" name="phone_number" id="phone_number">

                        </div>
                </div>

            </div>
            --}}

            @foreach ($destinations as $destination)
                <button value="{{ $destination->id }}" name="destination_id"
                    class="w-full mt-4 shadow-xl rounded-md bg-gradient-to-br from-pink-500 via-red-900 to-pink-700 hover:from-pink-500  hover:via-red-900  hover:to-yellow-900 sm:ml-2 m-1"
                    onclick="ajax_print('{{ url(route('queuing_ticket_save')) }}?destination_id={{ $destination->id }}',this)">
                    <div class="grid h-20 place-items-center">
                        <h3 class="text-2xl text-white text-center">
                            {{ $destination->name }}
                        </h3>
                    </div>
                </button>
            @endforeach

        </div>

    </section>

    <div class="relative overflow-hidden mb-8">
        <div class="overflow-hidden px-3 py-10 flex justify-center">
            <div class="w-full max-w-xs login-card">

                <p class="text-center text-gray-500 text-xs">
                    &copy;2022 - {{ date('Y') }}. {{ ___('isp-copy-right') }}
                </p>
            </div>
        </div>
    </div>

    <style>
        .iti--separate-dial-code {
            width: 100% !important;
        }
    </style>
@endsection
