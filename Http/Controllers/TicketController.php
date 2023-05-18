<?php

namespace Modules\Queuing\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Base\Http\Controllers\BaseController;
use Modules\Queuing\Entities\Attendant;
use Modules\Queuing\Entities\Destination;
use Modules\Queuing\Entities\Ticket;

class TicketController extends BaseController
{
    public function ticket(Request $request)
    {
        $prefix = 'Ticket/' . date('Y') . '/' . date('m');

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
        $prefix = 'Ticket/' . date('Y') . '/' . date('m');
        
        $destinations = Destination::get();
        foreach ($destinations as $key => $destination) {
            $attendants = Attendant::where('destination_id',$destination->id)->get();
            $destination->attendants = $attendants;
        }

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
            ->view('queuing::ticket-move', $data)
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
        $prefix = 'Ticket/' . date('Y') . '/' . date('m');

        $invoice_count = Ticket::where('prefix', $prefix)->count() + 1;
        $invoice_count_str = (string) $invoice_count;

        $padding = $padding - strlen($invoice_count_str);

        $data['number'] = str_pad($invoice_count_str, $padding, "0", STR_PAD_LEFT);

        $data['prefix'] = $prefix;

        Ticket::create($data);

        return redirect()
            ->route('queuing_ticket')
            ->header('pragma', 'no-cache')
            ->header('Cache-Control', 'no-store,no-cache, must-revalidate, post-check=0, pre-check=0');
    }
}
