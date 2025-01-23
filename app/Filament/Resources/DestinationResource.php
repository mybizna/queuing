<?php

namespace Modules\Queuing\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Queuing\Models\Destination;

class DestinationResource extends BaseResource
{
    protected static ?string $model = Destination::class;

    protected static ?string $slug = 'queuing/destination';

    protected static ?string $navigationGroup = 'Queuing';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
}
