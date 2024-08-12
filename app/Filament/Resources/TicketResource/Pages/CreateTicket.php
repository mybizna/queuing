<?php

namespace Modules\Queuing\Filament\Resources\TicketResource\Pages;

use Modules\Queuing\Filament\Resources\TicketResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;
}
