<?php

namespace App\Filament\Resources\FilamentAdminResource\Widgets;

use Filament\Widgets\ChartWidget;

class TaskSummary extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
