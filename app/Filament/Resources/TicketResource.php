<?php

namespace Modules\Queuing\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Queuing\Models\Ticket;

class TicketResource extends BaseResource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $slug = 'queuing/ticket';

    protected static ?string $navigationGroup = 'Queuing';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
}
