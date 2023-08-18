@extends('base::app')

@section('content')
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <div id="app">
        @{{ message }}

        <section class="bg-blue-50">
            <div class="col-span-full mx-auto pt-5">
                <div class="sm:flex">
                    <div class="sm:flex-auto sm:col-span-6 text-center p-1">
                        <div class="col-span-full shadow-xl rounded-md bg-white p-2 mb-4">

                            <p class="text-xl font-semibold text-orange-600 mt-2">Current Serving</p>
                            <h1 class="text-2xl font-semibold text-blue-900 mt-2">Token Number</h1>

                            <div
                                class=" inline-block mt-6 text-6xl font-semibold text-orange-600 border border-2 border-orange-600 rounded p-4 w-4/5 md:w-3/5 lg:col-span-6">
                                @{{ top_ticket_str }}
                            </div>

                            <h1 class="text-4xl font-semibold text-blue-900 my-4">@{{ top_ticket.attendant_name }}</h1>
                            <span class="text-3xl font-semibold text-orange-600">@{{ current_time }}</span>
                        </div>
                    </div>

                    <div class="sm:flex-auto w-1/1 sm:col-span-6 p-1 hidden sm:block">
                        <div class="shadow-xl rounded-md bg-white p-1">
                            <iframe width="100%" height="310"
                                src="https://www.youtube.com/embed/4cPOoXRxNPY?&autoplay=1&mute=1"frameborder="0"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2  sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2">
                    <div v-for="ticket in tickets" class="h-full shadow-xl rounded-md bg-blue-900 text-center  mb-2 py-4">
                        <span class="text-4xl text-white font-semibold">@{{ ticket.number }}</span>
                        <p class="text-md text-white">@{{ ticket.attendant_name }}</p>
                    </div>
                </div>

            </div>


    </div>
    </section>


    </div>

    <script>
        const {
            createApp
        } = Vue

        createApp({
            watch: {
                top_ticket_str: function() {
                    this.playAudio();
                }
            },
            mounted() {
                setInterval(() => {
                    this.fetchTicketNumber();
                }, 10000);

                setInterval(() => {
                    this.setCurrentTime();
                }, 10000);



                this.playAudio();
            },
            methods: {
                //function for setting current time
                setCurrentTime() {
                    this.current_time = new Date().toLocaleTimeString();
                },

                fetchTicketNumber() {
                    console.log('Fetching ticket number');
                    /*fetch('/queuing/ticket-number')
                        .then(response => response.json())
                        .then(data => {
                            this.top_ticket_str = data.top_ticket_str;
                            this.top_ticket = data.top_ticket;
                            this.tickets = data.tickets;
                            this.completed_tickets = data.completed_tickets;
                            this.destinations = data.destinations;
                        });*/
                },

                playAudio() {

                    let top_ticket_str_split = this.top_ticket_str.toLowerCase().split('');
                    let top_ticket_end_split = this.top_ticket.attendant_name.toLowerCase().split(' ');

                    console.log(top_ticket_end_split);

                    // Generate a merged array for top_ticket_str and prefix_statement_arr
                    let top_ticket_str_arr = [
                        'ticket_number',
                        ...top_ticket_str_split,
                        'please_proceed',
                        ...top_ticket_end_split,
                    ];

                    console.log(top_ticket_str_arr);

                    let that = this;
                    let audioFiles = [];

                    const fetchFiles = async function(that, top_ticket_str_arr) {
                        for (let index = 0; index < top_ticket_str_arr.length; index++) {
                            const audioUrl = that.audio_url + top_ticket_str_arr[index] + '.mp3';

                            const response = await fetch(audioUrl);
                            const blob = await response.blob();

                            console.log(top_ticket_str_arr[index] + '.mp3');

                            const audioFile = new Audio();
                            audioFile.src = URL.createObjectURL(blob);
                            audioFiles.push(audioFile);
                        }
                    };

                    fetchFiles(that, top_ticket_str_arr).then(() => {
                            // All audio files have been fetched
                            console.log(audioFiles);

                            // Play the audio files sequentially
                            playAudioSequentially();

                        })
                        .catch(error => {
                            // Handle any errors that occur during fetching
                            console.error('Error fetching audio files:', error);
                        });


                    function playAudioSequentially() {
                        let index = 0;

                        function playNextAudio() {
                            if (index >= audioFiles.length) {
                                return; // All audio files have been played
                            }

                            const audioFile = audioFiles[index];
                            audioFile.addEventListener('ended', playNextAudio);
                            audioFile.play();

                            index++;
                        }

                        playNextAudio(); // Start playing the first audio file
                    }
                    return;


                    //loop through the array and load the audio files
                    /*for (let index = 0; index < top_ticket_str_arr.length; index++) {

                        const audioUrl = that.audio_url + top_ticket_str_arr[index] + '.mp3';

                        await fetch(audioUrl)
                            .then(response => response.blob())
                            .then(blob => {
                                const audioFile = new Audio(that.audio_url + character + '.mp3');
                                audioFile.addEventListener('ended', playNextAudio);
                                audioFile.src = URL.createObjectURL(blob);

                                audioFiles.push(audioFile);
                            });

                    }




                    function loadNextAudio() {
                        if (index >= top_ticket_str_arr.length) {
                            return; // All audio files have been loaded
                        }

                        const character = top_ticket_str_arr[index];
                        const audioUrl = that.audio_url + character + '.mp3';

                        fetch(audioUrl)
                            .then(response => response.blob())
                            .then(blob => {
                                const audioFile = new Audio();
                                audioFile.addEventListener('ended', playNextAudio);
                                audioFile.src = URL.createObjectURL(blob);
                            });

                        index++;
                    }



                    function playNextAudio(that, top_ticket_str_arr) {
                        if (index >= top_ticket_str_arr.length) {
                            return; // All audio files have been played
                        }

                        console.log(top_ticket_str_arr);

                        const character = top_ticket_str_arr[index];
                        console.log(that.audio_url + character + '.mp3');
                        const audioFile = new Audio(that.audio_url + character + '.mp3');

                        audioFile.addEventListener('ended', () => {
                            index++; // Move to the next audio file
                            playNextAudio(that, top_ticket_str_arr); // Play the next audio file
                        });

                        audioFile.play();
                    }

                    playNextAudio(that, top_ticket_str_arr); // Start playing the first audio file

                    */



                }
            },
            data() {
                return {
                    audio_url: '{{ url('/') }}/audio/joanna/',
                    current_time: new Date().toLocaleTimeString(),
                    top_ticket_str: "{!! $top_ticket_str !!}",
                    top_ticket: {!! json_encode($top_ticket) !!},
                    tickets: {!! json_encode($tickets) !!},
                    completed_tickets: {!! json_encode($completed_tickets) !!},
                    destinations: {!! json_encode($destinations) !!},
                }
            }
        }).mount('#app')
    </script>




    <div class="relative overflow-hidden mb-8">
        <div class="overflow-hidden px-3 py-10 flex justify-center">
            <div class="col-span-full max-w-xs login-card">

                <p class="text-center text-gray-500 text-xs">
                    &copy;2022 - {{ date('Y') }}. {{ ___('isp-copy-right') }}
                </p>
            </div>
        </div>
    </div>


    <script>
        // function for fetching ticket number from server via ajax fetch
        function fetchTicketNumber() {
            // fetch ticket number from server
            fetch('{{ url(route('queuing_ticket_fetch')) }}')
                .then(response => response.json())
                .then(data => {
                    // check if ticket number is not empty
                    if (data.ticket_number != '') {
                        // play audio for ticket number
                        playAudio(data.ticket_number, data.destination);
                        // update ticket number on dashboard
                        document.querySelector('.text-6xl').innerHTML = data.ticket_number;
                        // update counter number on dashboard
                        document.querySelector('.text-4xl').innerHTML = data.destination;
                    }
                });
        }


        //function for playing audio files for each ticket number letter based on ticket number and destination
        function playAudio(ticket_chars, destination) {

            // explode ticket number to array of characters
            ticketNumber = ticketNumber.split('');

            // loop list of characters in ticket number and play audio for each character
            for (const character of ticket_chars) {
                // get single audio file for each character saved at public/audio folder 
                const audioFile = new Audio(character);
                audioFile.play();
                console.log(`Playing audio for character ${character}`);
            }

        }
    </script>
@endsection
