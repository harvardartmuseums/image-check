<?php

namespace App\Filament\Resources\RatioComparisonResource\Pages;

use App\Filament\Resources\RatioComparisonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRatioComparisons extends ListRecords
{
    protected static string $resource = RatioComparisonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
