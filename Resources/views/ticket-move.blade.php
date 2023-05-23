@extends('base::app')

@section('content')
    <section class="bg-blue-50">

        <div class="w-full mx-auto">
            <div class="sm:flex">
                <div class="sm:flex-auto sm:w-1/2 text-center p-1">

                    <div class=" shadow-xl rounded-md bg-white p-2 sm:mx-0">
                        <div class="flex">

                            <div class="flex-auto">
                                <p class="text-blue-900 text-sm">Serving Time</p>
                                <p class="text-orange-600 font-semibold">00:45:13</p>
                            </div>

                            <div class="flex-auto">
                                <p class="text-blue-900 text-sm">Total Served</p>
                                <p class="text-orange-600 font-semibold">{{ $completed_tickets }}</p>
                            </div>

                            <div class="flex-auto">
                                <form action="{{ url(route('queuing_ticket_move')) }}" method="GET">

                                    <select id="attendant_id" name="attendant_id" value="{{ $attendant_id }}"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        onchange="if(this.value != 0) { this.form.submit(); }">
                                        <option value="0" @if (!$attendant_id) selected @endif>Choose a
                                            Attendant</option>

                                        @foreach ($destinations as $destination)
                                            <optgroup label="{{ $destination->name }}">
                                                @foreach ($destination->attendants as $attendant)
                                                    <option value="{{ $attendant->id }}"
                                                        @if ($attendant_id == $attendant->id) selected @endif>
                                                        {{ $attendant->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>

                                    <a href="{{ url(route('queuing_ticket_move')) }}?reset=1"
                                        class="text-xs text-white text-center rounded mt-4 p-3 bg-red-600 m-1">
                                        RESET
                                    </a>
                                </form>
                            </div>


                        </div>
                    </div>

                    <div class="w-full shadow-xl rounded-md bg-white p-2 mt-2">

                        <form action="{{ url(route('queuing_ticket_savemove')) }}" method="POST">

                            @csrf
                            <div class="flex">

                                <div class="flex-auto w-2/3">

                                    <div>
                                        <p class="inline-block font-semibold text-orange-600 mt-4">
                                            Current Serving
                                        </p>
                                        <h1 class="inline-block font-semibold text-blue-900 mt-4">
                                            Token Number
                                        </h1>
                                    </div>

                                    <div
                                        class="inline-block my-3 text-6xl font-semibold text-orange-600 border border-2 border-orange-600 rounded p-4 w-4/5 md:w-3/5">
                                        @if ($tickets->isNotEmpty())
                                            {{ $main_ticket->number }}
                                        @else
                                            NO TICKET
                                        @endif
                                    </div>

                                    <div class="flex">
                                        <div class="flex-auto px-2">
                                            <button value="pause" name="move"
                                                class="w-full text-white p-2 bg-orange-500 m-1">
                                                PAUSE
                                            </button>
                                        </div>
                                        <div class="flex-auto px-2">
                                            <button value="close" name="move"
                                                class="w-full text-white p-2 bg-red-500 m-1">
                                                CLOSE
                                            </button>
                                        </div>
                                    </div>


                                    @if ($tickets->isNotEmpty())
                                        <input name="ticket" type="hidden" value="{{ $main_ticket->number }}">
                                        <input name="ticket_id" type="hidden" value="{{ $main_ticket->id }}">
                                    @endif

                                </div>

                                @if ($tickets->isNotEmpty())
                                    <div class="flex-auto w-1/3">
                                        <button value="next" name="move"
                                            class="w-full text-white mt-4 p-2 bg-blue-800 m-1">
                                            NEXT
                                            <br>
                                            <small style="font-size:9px;">(CLOSE TICKET & CALL NEXT )</small>
                                        </button>

                                        <button value="previous" name="move"
                                            class="w-full text-white mt-4 p-2 bg-blue-800 m-1">
                                            PREV-ATTENDANT
                                        </button>

                                        <button value="recall" name="move"
                                            class="w-full text-white mt-4 p-2 bg-blue-800 m-1">
                                            RECALL
                                        </button>

                                    </div>
                                @endif
                            </div>

                            <div class="w-full text-left">
                                <h2 class="text-left border-b border-b-orange-200">TRANSFER:</h2>
                                @foreach ($destinations as $destination)
                                    @if ($destination->attendants->count() > 1)
                                        <button value="transfer_{{ $destination->id }}" name="move"
                                            class="text-xs text-white text-center rounded p-2 uppercase bg-blue-800 m-1">
                                            {{ $destination->name }}
                                            <small style="font-size:9px;">(Any)</small>
                                        </button>
                                        @foreach ($destination->attendants as $attendant)
                                            <button value="transfer_{{ $destination->id }}_{{ $attendant->id }}"
                                                name="move"
                                                class="text-xs text-white text-center rounded p-2 uppercase bg-blue-800 m-1">
                                                {{ $attendant->name }}
                                            </button>
                                        @endforeach
                                    @else
                                        <button value="transfer_{{ $destination->id }}" name="move"
                                            class="text-xs text-white text-center rounded p-2 uppercase bg-blue-800 m-1">
                                            {{ $destination->name }}
                                        </button>
                                    @endif
                                @endforeach
                            </div>
                        </form>

                    </div>
                </div>

                <div class="sm:flex-auto w-1/1 sm:w-1/2 p-1">
                    <div class="h-full shadow-xl rounded-md bg-white p-1">
                        @if (count($tickets) > 1)
                            <p class="text-xl font-semibold text-blue-900 text-center">Queue</p>

                            <div class="row">
                                @foreach ($tickets as $ticket)
                                    @if ($main_ticket->number != $ticket->number)
                                        <div class="col-6">
                                            <div
                                                class="text-center text-2xl font-semibold text-orange-600 border border-2 border-orange-600 rounded mb-2">
                                                {{ $ticket->number }}
                                                <p class="text-blue-900 text-sm">
                                                    {{ $main_ticket->created_at->format('d/m/y H:i') }}</p>
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
