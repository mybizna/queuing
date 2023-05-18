@extends('base::app')

@section('content')
    <section class="bg-blue-50">
        <div class="w-full mx-auto pt-5">
            <div class="sm:flex">
                <div class="sm:flex-auto sm:w-1/2 text-center p-1">
                    <div class="w-full shadow-xl rounded-md bg-white p-2 mb-4">

                        <div class="flex">

                            <div class="flex-auto w-2/3">
                                <p class="text-xl font-semibold text-orange-600 mt-4">Current Serving</p>
                                <h1 class="text-2xl font-semibold text-blue-900 mt-4">Token Number</h1>

                                <div
                                    class="inline-block mt-6 text-2xl font-semibold text-orange-600 border border-2 border-orange-600 rounded p-4 w-4/5 md:w-3/5 lg:w-1/2">
                                    {{ $tickets[0]->number }}
                                </div>

                                <h1 class="font-semibold text-blue-900 mt-6">Serving Time</h1>
                                <h1 class="text-4xl font-semibold text-blue-900 mt-1">00:45:13</h1>
                            </div>

                            <div class="flex-auto w-1/3">
                                <button value="next" name="move" class="w-full text-white mt-4 p-2 bg-blue-800 m-1">
                                    NEXT
                                </button>

                                <div class="dropdown">
                                    <button class="dropbtn w-full text-white mt-4 p-2 bg-blue-800 m-1">TRANSFER</button>
                                    <div class="dropdown-content bg-blue-200 p-2">
                                        @foreach ($destinations as $destination)
                                            <p class="text-left border-b border-b-orange-200">{{ $destination->name }}:</p>
                                            <button value="transfer"
                                                name="move" class="w-full text-left text-orange-600 font-semibold">
                                                RANDOM
                                            </button>
                                            @foreach ($destination->attendants as $attendant)
                                                <button value="transfer_{{ $destination->id }}_{{ $attendant->id }}"
                                                    name="move" class="w-full text-left text-orange-600 font-semibold">
                                                    {{ $attendant->name }}
                                                </button>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>


                                <button value="recall" name="move" class="w-full text-white mt-4 p-2 bg-blue-800 m-1">
                                    RECALL
                                </button>

                                <button value="pause" name="move" class="w-full text-white mt-4 p-2 bg-blue-800 m-1">
                                    PAUSE
                                </button>

                                <button value="close" name="move" class="w-full text-white mt-4 p-2 bg-blue-800 m-1">
                                    CLOSE
                                </button>

                            </div>
                        </div>
                    </div>

                    <div class=" shadow-xl rounded-md bg-white p-2 sm:mx-0">
                        <div class="flex">
                            <div class="flex-auto">
                                <p class="text-blue-900 text-sm">Total Served</p>
                                <p class="text-orange-600 font-semibold">{{ $completed_tickets }}</p>
                            </div>
                            <div class="flex-auto">
                                <p class="text-blue-900 text-sm">Performance</p>
                                <p class="text-orange-600 font-semibold">GOOD</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sm:flex-auto w-1/1 sm:w-1/2 p-1">
                    <div class="h-full shadow-xl rounded-md bg-white p-1">
                        @if (count($tickets) > 1)
                            <p class="text-xl font-semibold text-blue-900 text-center">Queue</p>

                            <div class="row">
                                @foreach ($tickets as $ticket)
                                    @if ($tickets[0]->number != $ticket->number)
                                        <div class="col-6">
                                            <div
                                                class="text-center text-2xl font-semibold text-orange-600 border border-2 border-orange-600 rounded mb-2">
                                                {{ $ticket->number }}
                                                <p class="text-blue-900 text-sm">
                                                    {{ $tickets[0]->created_at->format('d/m/y H:i') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="mt-8 text-center border border-2 border-dotted border-orange-600 rounded">
                                <p class="text-sm font-semibold text-orange-600 my-2">Empty Queue</p>
                                <h1 class="text-md font-semibold text-blue-900 my-2">No one remains in queue</h1>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

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

    <style>
        /* Dropdown Button */
        .dropbtn {
            color: white;
            border: none;
        }

        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show the dropdown menu on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Change the background color of the dropdown button when the dropdown content is shown */
        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
@endsection
