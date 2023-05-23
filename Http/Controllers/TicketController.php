<?php

namespace Modules\Queuing\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Base\Http\Controllers\BaseController;
use Modules\Queuing\Classes\PrintTicket;
use Modules\Queuing\Entities\Attendant;
use Modules\Queuing\Entities\Destination;
use Modules\Queuing\Entities\Ticket;
use Modules\Queuing\Entities\TicketLog;

class TicketController extends BaseController
{
    public function ticket(Request $request)
    {
        $prefix = 'Ticket/' . date('Y') . '/' . date('m') . '/' . date('d');

        $destinations = Destination::get();
        $tickets = Ticket::where('prefix', $prefix)
            ->where('is_closed', false)->orderBy('id')->get();
        $completed_tickets = Ticket::where('prefix', $prefix)
            ->where('is_closed', true)->count();

        $data = [
            'tickets' => $tickets,
            'completed_tickets' => $completed_tickets,
            'destinations' => $destinations,
        ];

        return response()
            ->view('queuing::ticket-dashboard', $data)
            ->header('pragma', 'no-cache')
            ->header('Cache-Control', 'no-store,no-cache, must-revalidate, post-check=0, pre-check=0');
    }

    public function move(Request $request)
    {
        $prefix = 'Ticket/' . date('Y') . '/' . date('m') . '/' . date('d');

        $attendant_id = '';
        $reset = $request->get('reset');

        if (!$reset) {
            $r_attendant_id = $request->get('attendant_id');
            $s_attendant_id = $request->session()->get('queuing_ticket_attendant_id');
            $attendant_id = ($r_attendant_id) ? $r_attendant_id : $s_attendant_id;
        }

        $destinations = Destination::get();
        foreach ($destinations as $key => $destination) {
            $attendants = Attendant::where('destination_id', $destination->id)->orderBy('name')->get();
            $destination->attendants = $attendants;
            $destination->counter = $attendants->count();
        }

        $destinations = $destinations->sortBy([['counter', 'asc']]);

        $tickets_qry = Ticket::where('prefix', $prefix)
            ->where('is_closed', false)->orderBy('id');

        $completed_tickets_qry = Ticket::where('prefix', $prefix)
            ->where('is_closed', true);

        if ($attendant_id) {
            $tickets_qry->where('attendant_id', $attendant_id);
            $completed_tickets_qry->where('attendant_id', $attendant_id);
            $request->session()->put('queuing_ticket_attendant_id', $attendant_id);
        }

        $tickets = $tickets_qry->get();
        $completed_tickets = $completed_tickets_qry->count();

        $main_ticket = ($tickets->isNotEmpty()) ? $tickets[0] : (object) [];

        $data = [
            'main_ticket' => $main_ticket,
            'attendant_id' => $attendant_id,
            'tickets' => $tickets,
            'completed_tickets' => $completed_tickets,
            'destinations' => $destinations,
        ];

        return response()
            ->view('queuing::ticket-move', $data)
            ->header('pragma', 'no-cache')
            ->header('Cache-Control', 'no-store,no-cache, must-revalidate, post-check=0, pre-check=0');
    }

    public function savemove(Request $request)
    {
        $data = $request->all();

        $destination_id = '';
        $attendant_id = '';

        $move = $data['move'];
        $ticket_id = $data['ticket_id'];

        $ticket = Ticket::where('id', $ticket_id)->first();

        if (str_starts_with($move, 'transfer')) {
            $move_arr = explode('_', $move);
            $move = $move_arr[0];

            if (count($move_arr) == 3) {
                $destination_id = $move_arr[1];
                $attendant_id = $move_arr[2];
            }

            if (count($move_arr) == 2) {
                $destination_id = $move_arr[1];
            }

            if ($attendant_id == '') {
                $attendant_id = $this->getAttendant($destination_id);
            }
        }

        if ($move == 'next') {
            $ticket->is_announced = true;
            $ticket->is_closed = true;
            $ticket->save();
        } else if ($move == 'transfer') {
            $ticket->is_announced = false;
            $ticket->attendant_id = $attendant_id;
            $ticket->save();

            TicketLog::create([
                'ticket_id' => $ticket_id,
                'attendant_id' => $attendant_id,
            ]);
        } else if ($move == 'previous') {
            $tmp_attendant_id = $this->getPreviousAttendant($ticket_id, $attendant_id);

            if ($tmp_attendant_id != $attendant_id) {
                $ticket->is_announced = false;
                $ticket->attendant_id = $attendant_id;
                $ticket->save();

                TicketLog::create([
                    'ticket_id' => $ticket_id,
                    'attendant_id' => $attendant_id,
                ]);
            }
        } else if ($move == 'recall') {
            $ticket->is_announced = false;
            $ticket->save();
        } else if ($move == 'pause') {
        } else if ($move == 'close') {
        }

        return redirect()
            ->route('queuing_ticket_move')
            ->header('pragma', 'no-cache')
            ->header('Cache-Control', 'no-store,no-cache, must-revalidate, post-check=0, pre-check=0');
    }

    public function create(Request $request)
    {
        $destinations = Destination::get();

        $data = [
            'destinations' => $destinations,
        ];

        return response()
            ->view('queuing::ticket-create', $data)
            ->header('pragma', 'no-cache')
            ->header('Cache-Control', 'no-store,no-cache, must-revalidate, post-check=0, pre-check=0');
    }

    public function save(Request $request)
    {
        $data = $request->all();

        $padding = 5;
        $prefix = 'Ticket/' . date('Y') . '/' . date('m') . '/' . date('d');

        $invoice_count = Ticket::where('prefix', $prefix)->count() + 1;
        $invoice_count_str = (string) $invoice_count;

        $padding = $padding - strlen($invoice_count_str);

        $data['number'] = str_pad($invoice_count_str, $padding, "0", STR_PAD_LEFT);
        $data['prefix'] = $prefix;
        $data['attendant_id'] = $this->getAttendant($data['destination_id']);

        Ticket::create($data);
        TicketLog::create($data);

        $print_ticket = new PrintTicket();
        $print_ticket->print($data['number']);

        exit;

        /*
        return redirect()
        ->route('queuing_ticket')
        ->header('pragma', 'no-cache')
        ->header('Cache-Control', 'no-store,no-cache, must-revalidate, post-check=0, pre-check=0');
        */
    }

    private function getPreviousAttendant($ticket_id, $attendant_id)
    {
        $ticket_log = TicketLog::where('ticket_id', $ticket_id)
            ->where('attendant_id', '<>', $attendant_id)
            ->orderByDesc('id')
            ->first();

        return (empty($ticket_logs)) ? $attendant_id : $ticket_log->attendant_id;

    }

    private function getAttendant($destination_id)
    {
        $attendant_id = '';
        $counter = 100000;
        $prefix = 'Ticket/' . date('Y') . '/' . date('m') . '/' . date('d');
        $attendants = Attendant::where('destination_id', $destination_id)->get();

        foreach ($attendants as $key => $attendant) {
            $tmp_counter = Ticket::where('attendant_id', $attendant->id)
                ->where('prefix', $prefix)
                ->where('is_closed', false)
                ->count();

            if ($tmp_counter < $counter) {
                $counter = $tmp_counter;
                $attendant_id = $attendant->id;
            }

        }

        return $attendant_id;
    }
}
