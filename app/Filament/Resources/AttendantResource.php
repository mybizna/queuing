<?php

namespace Modules\Queuing\Filament\Resources;

use Modules\Base\Filament\Resources\BaseResource;
use Modules\Queuing\Models\Attendant;

class AttendantResource extends BaseResource
{
    protected static ?string $model = Attendant::class;

    protected static ?string $slug = 'queuing/attendant';

    protected static ?string $navigationGroup = 'Queuing';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
}
