@extends('base::app')

@section('content')
    <section class="bg-blue-50">
        <div class="w-full mx-auto pt-5">
            <div class="sm:flex">
                <div class="sm:flex-auto sm:w-1/2 text-center p-1">
                    <div class="w-full shadow-xl rounded-md bg-white p-2 mb-4">

                        <p class="text-xl font-semibold text-orange-600 mt-4">Current Serving</p>
                        <h1 class="text-2xl font-semibold text-blue-900 mt-4">Token Number</h1>

                        <div
                            class="inline-block mt-6 text-6xl font-semibold text-orange-600 border border-2 border-orange-600 rounded p-4 w-4/5 md:w-3/5 lg:w-1/2">
                            {{ $tickets[0]->number }}
                        </div>

                        <h1 class="text-4xl font-semibold text-blue-900 my-6">Counter 1</h1>

                    </div>


                </div>

                <div class="sm:flex-auto w-1/1 sm:w-1/2 p-1 hidden sm:block">
                    <div class="shadow-xl rounded-md bg-white p-1">
                        <iframe width="100%" height="310"
                            src="https://www.youtube.com/embed/4cPOoXRxNPY?&autoplay=1&mute=1"frameborder="0"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>

            @if (count($tickets) > 1)
                <div class="grid grid-cols-2  sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2">
                    @foreach ($tickets as $ticket)
                        @if ($tickets[0]->number != $ticket->number)
                            <div class="h-full shadow-xl rounded-md bg-blue-900 text-center  mb-2 py-4">
                                <span class="text-4xl text-white font-semibold">{{ $ticket->number }}</span>
                                <p class="text-md text-white">Counter 1</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif

        </div>


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
@endsection
