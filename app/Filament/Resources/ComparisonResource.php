<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComparisonResource\Pages;
use App\Filament\Resources\ComparisonResource\RelationManagers;
use App\Models\Comparison;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComparisonResource extends Resource
{
    protected static ?string $model = Comparison::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('MediaMasterID')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('EnteredDate')
                    ->required(),
                Forms\Components\TextInput::make('RenditionNumber')
                    ->required(),
                Forms\Components\TextInput::make('FileID')
                    ->required(),
                Forms\Components\TextInput::make('Path')
                    ->required(),
                Forms\Components\TextInput::make('FileName')
                    ->required(),
                Forms\Components\TextInput::make('CachePath')
                    ->required(),
                Forms\Components\TextInput::make('CachePath1')
                    ->required(),
                Forms\Components\TextInput::make('CachePath2')
                    ->required(),
                Forms\Components\TextInput::make('BaseImageURL')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('CachePath1')
                ->getStateUsing(function (Comparison $record) {
                    return $record->CachePath1;
                })
                ->height(128),
                Tables\Columns\ImageColumn::make('CachePath2')
                    ->getStateUsing(function (Comparison $record) {
                        return $record->CachePath2;
                    })
                    ->height(128),
                Tables\Columns\ImageColumn::make('BaseImageURL')
                    ->getStateUsing(function (Comparison $record) {
                        return $record->BaseImageURL;
                    })
                    ->height(128),
                Tables\Columns\TextColumn::make('MediaMasterID')
                    ->sortable()
                    ->label('Media Master ID'),
                Tables\Columns\TextColumn::make('EnteredDate')
                    ->dateTime()
                    ->sortable()
                    ->label('Entered Date'),
                Tables\Columns\TextColumn::make('RenditionNumber')
                    ->searchable()
                    ->label('Rendition Number'),
                Tables\Columns\TextColumn::make('FileID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Path')
                    ->searchable(),
                Tables\Columns\TextColumn::make('FileName')
                    ->searchable(),
                Tables\Columns\TextColumn::make('CachePath')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComparisons::route('/'),
            'create' => Pages\CreateComparison::route('/create'),
            'edit' => Pages\EditComparison::route('/{record}/edit'),
        ];
    }
}
