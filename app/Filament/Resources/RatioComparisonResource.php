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
use Webbingbrasil\FilamentAdvancedFilter\Filters\NumberFilter;


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
                Forms\Components\TextInput::make('MediaStatusID')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('FileName')
                    ->required(),
                Forms\Components\TextInput::make('mediastatusid')
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
                Forms\Components\TextInput::make('Improvement_Factor')
                    ->required(),
                Forms\Components\TextInput::make('Object_URL')
                    ->required(),
                Forms\Components\TextInput::make('Object_Number')
                    ->required(),
                Forms\Components\TextInput::make('Object_ID')
                    ->required(),
                Forms\Components\TextInput::make('Object_ImagePermissionLevel')
                    ->required(),
                Forms\Components\TextInput::make('Object_AccessLevel')
                    ->required(),
                Forms\Components\TextInput::make('Object_IsImagePrimaryDisplay')
                    ->required(),
                Forms\Components\TextInput::make('Object_ImageRank')
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
                        return $record->BaseImageURL . ':IMAGE/full/!200,200/0/default.jpg';
                    })                 
                    ->url(function (RatioComparison $record) {
                        return $record->BaseImageURL;
                    })
                    ->openUrlInNewTab()
                    ->extraImgAttributes(['class' => 'max-h-60 !max-w-60'])
                    ->label('DYNMC Image'),
                Tables\Columns\ImageColumn::make('PRDWORK_BaseImageURL')
                    ->getStateUsing(function (RatioComparison $record) {
                        return $record->PRDWORK_BaseImageURL . ':IMAGE/full/!200,200/0/default.jpg';
                    })                    
                    ->url(function (RatioComparison $record) {
                        return $record->PRDWORK_BaseImageURL;
                    })
                    ->openUrlInNewTab()
                    ->extraImgAttributes(['class' => 'max-h-60 !max-w-60'])
                    ->label('PRDWORK Image'),
                Tables\Columns\TextColumn::make('RatioDifference')
                    ->sortable()
                    ->label('Ratio Difference'),
                Tables\Columns\TextColumn::make('Improvement_Factor')
                    ->numeric()
                    ->sortable()
                    ->label('Improvement Factor'),                          
                Tables\Columns\TextColumn::make('CachePath')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Cache Path'),
                Tables\Columns\TextColumn::make('DYNMC_DRS_FileDate')
                    ->dateTime('Y-m-d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('DYNMC File Date'),
                Tables\Columns\TextColumn::make('DYNMC_DRS_FileID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('DYNMC File ID'),
                Tables\Columns\TextColumn::make('DYNMC_PixelH')
                    ->getStateUsing(function (RatioComparison $record) {
                        return $record->DYNMC_PixelH . 'x' . $record->DYNMC_PixelW;
                    })       
                    ->label('DYNMC HxW'),                    
                Tables\Columns\TextColumn::make('DYNMC_PixelW')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('DYNMC Width (px)'),
                Tables\Columns\TextColumn::make('DYNMC_Ratio')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('DYNMC Ratio'),
                Tables\Columns\TextColumn::make('mediastatusid')
                    ->numeric()
                    ->sortable()
                    ->label('Media Status ID'),
                Tables\Columns\TextColumn::make('EnteredDate')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('DYNMC Date Entered'),
                Tables\Columns\TextColumn::make('FileID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('File ID'),
                Tables\Columns\TextColumn::make('FileName')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('DYNMC File Name'),
                Tables\Columns\TextColumn::make('MediaMasterID')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Media Master ID'),
                Tables\Columns\TextColumn::make('PRDWORK_DRS_FileDate')
                    ->dateTime('Y-m-d')
                    ->sortable()
                    ->label('PRDWORK File Date'),
                Tables\Columns\TextColumn::make('PRDWORK_DRS_File_ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('PRDWORK DRS File ID'),
                Tables\Columns\TextColumn::make('PRDWORK_FileID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('PRDWORK File ID'),
                Tables\Columns\TextColumn::make('PRDWORK_FileName')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('PRDWORK File Name'),
                Tables\Columns\TextColumn::make('PRDWORK_Mime_Type')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('PRDWORK Mime Type'),                    
                Tables\Columns\TextColumn::make('PRDWORK_MediaMasterID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('PRDWORK Media Master ID'),
                Tables\Columns\TextColumn::make('PRDWORK_PixelH')
                    ->getStateUsing(function (RatioComparison $record) {
                        return $record->PRDWORK_PixelH . 'x' . $record->PRDWORK_PixelW;
                    })       
                    ->label('PRDWORK HxW'),
                Tables\Columns\TextColumn::make('PRDWORK_PixelW')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('PRDWORK Width (px)'),
                Tables\Columns\TextColumn::make('PRDWORK_Ratio')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('PRDWORK Ratio'),
                Tables\Columns\TextColumn::make('PRDWORK_RenditionNumber')
                    ->searchable()
                    ->label('PRDWORK Rendition Number'),
                Tables\Columns\TextColumn::make('Path')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
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
                Tables\Columns\TextColumn::make('Object_Number')
                    ->url(function (RatioComparison $record) {
                        return $record->Object_URL;
                    })
                    ->openUrlInNewTab()
                    ->searchable()
                    ->label('Object Number'),
                Tables\Columns\TextColumn::make('Object_ImagePermissionLevel')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Image Permission Level'),
                Tables\Columns\TextColumn::make('Object_AccessLevel')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Object Access Level'),
                Tables\Columns\TextColumn::make('Object_IsImagePrimaryDisplay')
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->label('Is Primary Display'),  
                Tables\Columns\TextColumn::make('Object_ImageRank')
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->label('Image Rank'),                                                  
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('mediastatusid')
                    ->options([
                        '0' => 'Not Assigned',
                        '2' => 'Disqualified',
                        '4' => 'Approved (public)',
                        '5' => 'Approved (study only)',
                    ])
                    ->label('Media Status'),
                Tables\Filters\SelectFilter::make('PRDWORK_Mime_Type')
                    ->options([
                        'image/jpeg' => 'image/jpeg',
                        'image/jp2' => 'image/jp2',
                    ])
                    ->label('PRDWORK Mime Type'),                    
                Tables\Filters\SelectFilter::make('Object_ImagePermissionLevel')
                    ->options([
                        '-1' => 'Not Applicable',
                        '0' => 'No Restrictions',
                        '1' => 'Thumbnail Only',
                        '2' => 'Do not publish!',
                    ])
                    ->label('Image Permission Level'),      
                Tables\Filters\SelectFilter::make('Object_AccessLevel')
                    ->options([
                        '-1' => 'Not Applicable',
                        '0' => 'Private',
                        '1' => 'Public',
                    ])
                    ->label('Object Access Level'),       
                Tables\Filters\SelectFilter::make('Object_IsImagePrimaryDisplay')
                    ->options([
                        '-1' => 'Not Applicable',
                        '0' => 'No',
                        '1' => 'Yes',
                    ])
                    ->label('Is Primary Display'),                                                             
                NumberFilter::make('RatioDifference')
                    ->debounce(1000),
                NumberFilter::make('Improvement_Factor')
                    ->debounce(1000),
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
