@extends('base::app')

@section('content')
    <section class="bg-blue-50">
        <div class="w-full md:w-4/5 lg:w-2/3 mx-auto pt-5">
            <div class=" shadow-xl rounded-md bg-white sm:mr-2 m-4 p-2">

                <div class="row">

                    <div class="col-sm-6 text-center">
                        <p class="text-xl font-semibold text-orange-600">Current Serving</p>
                        <h1 class="text-2xl font-semibold text-blue-900">Token Number</h1>


                        <div
                            class="inline-block text-2xl font-semibold text-orange-600 border border-2 border-orange-600 rounded p-4 w-4/5 md:w-3/5 lg:w-1/2">
                            {{ $tickets[0]->number }}
                        </div>
                        <div>
                            <button value="" name="destination_id"
                                class="text-white mt-4 p-2 shadow-xl rounded-md bg-gradient-to-br from-sky-300 via-blue-700 to-sky-300 hover:from-pink-500  hover:via-red-900  hover:to-yellow-900 sm:ml-2 m-1">
                                NEXT
                            </button>
                            <button value="" name="destination_id"
                                class="text-white mt-4 p-2 shadow-xl rounded-md bg-gradient-to-br from-sky-300 via-blue-700 to-sky-300 hover:from-pink-500  hover:via-red-900  hover:to-yellow-900 sm:ml-2 m-1">
                                RECALL
                            </button>
                            <button value="" name="destination_id"
                                class="text-white mt-4 p-2 shadow-xl rounded-md bg-gradient-to-br from-sky-300 via-blue-700 to-sky-300 hover:from-pink-500  hover:via-red-900  hover:to-yellow-900 sm:ml-2 m-1">
                                TRANSFER
                            </button>
                            <button value="" name="destination_id"
                                class="text-white mt-4 p-2 shadow-xl rounded-md bg-gradient-to-br from-blue-300 via-blue-700 to-blue-300 hover:from-pink-500  hover:via-red-900  hover:to-yellow-900 sm:ml-2 m-1">
                                PAUSE
                            </button>
                            <button value="" name="destination_id"
                                class="text-white mt-4 p-2 shadow-xl rounded-md bg-gradient-to-br from-blue-300 via-blue-700 to-blue-300 hover:from-pink-500  hover:via-red-900  hover:to-yellow-900 sm:ml-2 m-1">
                                CLOSE
                            </button>
                        </div>

                    </div>

                    <div class="col-sm-6">
                        <div class="text-center">
                            <p class="font-semibold">
                                {{ ___('isp-access-dashboard-logged-in-title') }}
                            </p>

                            <p class=" text-sm text-gray-600 py-1">
                                {{ ___('isp-access-dashboard-logged-in-instruction') }}
                            </p>

                            <p class="font-bold text-xl text-center">
                            </p>
                        </div>

                        <div class="text-center">
                            <p class="font-semibold text-lg">
                                {{ ___('isp-access-dashboard-login-title') }}
                            </p>

                            <p class=" text-sm text-gray-400 py-1">
                                {{ ___('isp-access-dashboard-login-instruction') }}
                            </p>

                            <a id='package' href=""
                                class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                {{ ___('isp-access-dashboard-login-button') }}
                            </a>

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
@endsection
