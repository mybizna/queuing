<?php

namespace Modules\Queuing\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Base\Http\Controllers\BaseController;
use Modules\Queuing\Entities\Destination;
use Modules\Queuing\Entities\Ticket;

class TicketController extends BaseController
{
    public function ticket(Request $request)
    {
        $prefix = 'Ticket/' . date('Y') . '/' . date('m') ;

        $tickets = Ticket::where('prefix', $prefix)->get();
        $destinations = Destination::get();

        $data = [
            'tickets' => $tickets,
            'destinations' => $destinations,
        ];

        return response()
            ->view('queuing::ticket-dashboard', $data)
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
        $prefix = 'Ticket/' . date('Y') . '/' . date('m') ;

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
