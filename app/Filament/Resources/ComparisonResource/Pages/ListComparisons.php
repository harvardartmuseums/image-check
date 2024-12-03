<?php

namespace App\Filament\Resources\ComparisonResource\Pages;

use App\Filament\Resources\ComparisonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComparisons extends ListRecords
{
    protected static string $resource = ComparisonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
