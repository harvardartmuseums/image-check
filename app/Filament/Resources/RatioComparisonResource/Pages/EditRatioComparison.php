<?php

namespace App\Filament\Resources\RatioComparisonResource\Pages;

use App\Filament\Resources\RatioComparisonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Pages\Concerns\CanPaginateEditRecord;
use App\Filament\Resources\Actions\PreviousAction;
use App\Filament\Resources\Actions\NextAction;

class EditRatioComparison extends EditRecord
{
    use CanPaginateEditRecord;

    protected static string $resource = RatioComparisonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            PreviousAction::make(),
            NextAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
