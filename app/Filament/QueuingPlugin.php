<?php

namespace Modules\Queuing\Filament;

use Coolsam\Modules\Concerns\ModuleFilamentPlugin;
use Filament\Contracts\Plugin;
use Filament\Panel;

class QueuingPlugin implements Plugin
{
    use ModuleFilamentPlugin;

    public function getModuleName(): string
    {
        return 'Queuing';
    }

    public function getId(): string
    {
        return 'queuing';
    }

    public function boot(Panel $panel): void
    {
        // TODO: Implement boot() method.
    }
}
