<?php

namespace Modules\Queuing\Filament\Resources\TicketLogResource\Pages;

use Modules\Base\Filament\Resources\Pages\ListingBase;
use Modules\Queuing\Filament\Resources\TicketLogResource;

// Class List that extends ListBase
class Listing extends ListingBase
{
    protected static string $resource = TicketLogResource::class;
}
