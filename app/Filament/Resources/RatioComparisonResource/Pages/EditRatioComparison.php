<?php

namespace App\Filament\Resources\RatioComparisonResource\Pages;

use App\Filament\Resources\RatioComparisonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRatioComparison extends EditRecord
{
    protected static string $resource = RatioComparisonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
