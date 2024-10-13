<?php

namespace Modules\Queuing\Filament\Resources\TicketResource\Pages;

use Modules\Base\Filament\Resources\Pages\ListingBase;
use Modules\Queuing\Filament\Resources\TicketResource;

// Class List that extends ListBase
class Listing extends ListingBase
{
    protected static string $resource = TicketResource::class;
}
