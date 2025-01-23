<?php

namespace Modules\Queuing\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Queuing\Models\TicketLog;

class TicketLogResource extends BaseResource
{
    protected static ?string $model = TicketLog::class;

    protected static ?string $slug = 'queuing/ticket/log';

    protected static ?string $navigationGroup = 'Queuing';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
}
