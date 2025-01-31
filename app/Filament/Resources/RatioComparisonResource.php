<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RatioComparisonResource\Pages;
use App\Filament\Resources\RatioComparisonResource\RelationManagers;
use App\Models\RatioComparison;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RatioComparisonResource extends Resource
{
    protected static ?string $model = RatioComparison::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('BaseImageURL')
                    ->required(),
                Forms\Components\TextInput::make('CachePath')
                    ->required(),
                Forms\Components\DateTimePicker::make('DYNMC_DRS_FileDate')
                    ->required(),
                Forms\Components\TextInput::make('DYNMC_DRS_FileID')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('DYNMC_PixelH')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('DYNMC_PixelW')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('DYNMC_Ratio')
                    ->numeric(),
                Forms\Components\DateTimePicker::make('EnteredDate')
                    ->required(),
                Forms\Components\TextInput::make('FileID')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('FileName')
                    ->required(),
                Forms\Components\TextInput::make('MediaMasterID')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('PRDWORK_BaseImageURL')
                    ->required(),
                Forms\Components\DateTimePicker::make('PRDWORK_DRS_FileDate')
                    ->required(),
                Forms\Components\TextInput::make('PRDWORK_DRS_File_ID')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('PRDWORK_FileID')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('PRDWORK_FileName')
                    ->required(),
                Forms\Components\TextInput::make('PRDWORK_MediaMasterID')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('PRDWORK_PixelH')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('PRDWORK_PixelW')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('PRDWORK_Ratio')
                    ->numeric(),
                Forms\Components\TextInput::make('PRDWORK_RenditionNumber')
                    ->required(),
                Forms\Components\TextInput::make('Path')
                    ->required(),
                Forms\Components\TextInput::make('RenditionNumber')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('RatioDifference', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('BaseImageURL')
                    ->getStateUsing(function (RatioComparison $record) {
                        return $record->BaseImageURL;
                    })
                    ->extraImgAttributes(['class' => 'max-h-32 !max-w-32'])
                    ->label('DYNMC Image'),
                Tables\Columns\ImageColumn::make('PRDWORK_BaseImageURL')
                    ->getStateUsing(function (RatioComparison $record) {
                        return $record->PRDWORK_BaseImageURL;
                    })
                    ->extraImgAttributes(['class' => 'max-h-32 !max-w-32'])
                    ->label('PRDWORK Image'),
                Tables\Columns\TextColumn::make('RatioDifference')
                    ->sortable()
                    ->label('Ratio Difference'),
                Tables\Columns\TextColumn::make('CachePath')
                    ->searchable()
                    ->label('Cache Path'),
                Tables\Columns\TextColumn::make('DYNMC_DRS_FileDate')
                    ->dateTime()
                    ->sortable()
                    ->label('DYNMC File Date'),
                Tables\Columns\TextColumn::make('DYNMC_DRS_FileID')
                    ->numeric()
                    ->sortable()
                    ->label('DYNMC File ID'),
                Tables\Columns\TextColumn::make('DYNMC_PixelH')
                    ->numeric()
                    ->sortable()
                    ->label('DYNMC Height (px)'),
                Tables\Columns\TextColumn::make('DYNMC_PixelW')
                    ->numeric()
                    ->sortable()
                    ->label('DYNMC Width (px)'),
                Tables\Columns\TextColumn::make('DYNMC_Ratio')
                    ->numeric()
                    ->sortable()
                    ->label('DYNMC Ratio'),
                Tables\Columns\TextColumn::make('EnteredDate')
                    ->dateTime()
                    ->sortable()
                    ->label('Date Entered'),
                Tables\Columns\TextColumn::make('FileID')
                    ->numeric()
                    ->sortable()
                    ->label('File ID'),
                Tables\Columns\TextColumn::make('FileName')
                    ->searchable()
                    ->label('File Name'),
                Tables\Columns\TextColumn::make('MediaMasterID')
                    ->numeric()
                    ->sortable()
                    ->label('Media Master ID'),
                Tables\Columns\TextColumn::make('PRDWORK_DRS_FileDate')
                    ->dateTime()
                    ->sortable()
                    ->label('PRDWORK File Date'),
                Tables\Columns\TextColumn::make('PRDWORK_DRS_File_ID')
                    ->numeric()
                    ->sortable()
                    ->label('PRDWORK File ID'),
                Tables\Columns\TextColumn::make('PRDWORK_FileID')
                    ->numeric()
                    ->sortable()
                    ->label('PRDWORK File ID'),
                Tables\Columns\TextColumn::make('PRDWORK_FileName')
                    ->searchable()
                    ->label('PRDWORK File Name'),
                Tables\Columns\TextColumn::make('PRDWORK_MediaMasterID')
                    ->numeric()
                    ->sortable()
                    ->label('PRDWORK Media Master ID'),
                Tables\Columns\TextColumn::make('PRDWORK_PixelH')
                    ->numeric()
                    ->sortable()
                    ->label('PRDWORK Height (px)'),
                Tables\Columns\TextColumn::make('PRDWORK_PixelW')
                    ->numeric()
                    ->sortable()
                    ->label('PRDWORK Width (px)'),
                Tables\Columns\TextColumn::make('PRDWORK_Ratio')
                    ->numeric()
                    ->sortable()
                    ->label('PRDWORK Ratio'),
                Tables\Columns\TextColumn::make('PRDWORK_RenditionNumber')
                    ->searchable()
                    ->label('PRDWORK Rendition Number'),
                Tables\Columns\TextColumn::make('Path')
                    ->searchable()
                    ->label('Path'),
                Tables\Columns\TextColumn::make('RenditionNumber')
                    ->searchable()
                    ->label('Rendition Number'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Created At'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Updated At'),
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
            'index' => Pages\ListRatioComparisons::route('/'),
            'create' => Pages\CreateRatioComparison::route('/create'),
            'edit' => Pages\EditRatioComparison::route('/{record}/edit'),
        ];
    }
}
