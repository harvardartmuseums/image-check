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
use App\Forms\Components\ImagePreview;
use Spatie\TagsInput\TagsInput;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Forms\Components\SpatieTagsInput;
use Spatie\Tags\Tag;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Collection;

class RatioComparisonResource extends Resource
{
    protected static ?string $model = RatioComparison::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                ImagePreview::make('Images')->columnSpanFull(),
                SpatieTagsInput::make('tags')->columnSpanFull(),
                Forms\Components\MarkdownEditor::make('note')->columnSpanFull(),
                Forms\Components\TextInput::make('Object_URL')
                    ->required()
                    ->readonly()
                    ->label('Object URL'),
                Forms\Components\TextInput::make('Object_Number')
                    ->required()
                    ->readonly()
                    ->label('Object Number'),
                Forms\Components\TextInput::make('RenditionNumber')
                    ->required()
                    ->readonly()
                    ->label('Rendition Number'),
                Forms\Components\TextInput::make('BaseImageURL')
                    ->required()
                    ->readonly()
                    ->label('DYNMC Image'),
                Forms\Components\TextInput::make('CachePath')
                    ->required()
                    ->readonly()
                    ->label('Cache Path'),
                Forms\Components\DateTimePicker::make('DYNMC_DRS_FileDate')
                    ->required()
                    ->readonly()
                    ->label('DYNMC File Date'),
                Forms\Components\TextInput::make('DYNMC_DRS_FileID')
                    ->required()
                    ->numeric()
                    ->readonly()
                    ->label('DYNMC File ID'),
                Forms\Components\TextInput::make('DYNMC_PixelH')
                    ->required()
                    ->numeric()
                    ->readonly()
                    ->label('DYNMC Height (px)'),
                Forms\Components\TextInput::make('DYNMC_PixelW')
                    ->required()
                    ->numeric()
                    ->readonly()
                    ->label('DYNMC Width (px)'),
                Forms\Components\TextInput::make('DYNMC_Ratio')
                    ->numeric()
                    ->readonly()
                    ->label('DYNMC Ratio'),
                Forms\Components\DateTimePicker::make('EnteredDate')
                    ->required()
                    ->readonly()
                    ->label('DYNMC Date Entered'),
                Forms\Components\TextInput::make('FileID')
                    ->required()
                    ->numeric()
                    ->readonly()
                    ->label('File ID'),
                Forms\Components\TextInput::make('MediaStatusID')
                    ->numeric()
                    ->readonly()
                    ->label('Media Status ID'),
                Forms\Components\TextInput::make('FileName')
                    ->required()
                    ->readonly()
                    ->label('DYNMC File Name'),
                Forms\Components\TextInput::make('mediastatusid')
                    ->required()
                    ->numeric()
                    ->readonly()
                    ->label('Media Status ID'),
                Forms\Components\TextInput::make('PRDWORK_BaseImageURL')
                    ->required()
                    ->readonly()
                    ->label('PRDWORK Image'),
                Forms\Components\DateTimePicker::make('PRDWORK_DRS_FileDate')
                    ->required()
                    ->readonly()
                    ->label('PRDWORK File Date'),
                Forms\Components\TextInput::make('PRDWORK_DRS_File_ID')
                    ->required()
                    ->numeric()
                    ->readonly()
                    ->label('PRDWORK DRS File ID'),
                Forms\Components\TextInput::make('PRDWORK_FileID')
                    ->required()
                    ->numeric()
                    ->readonly()
                    ->label('PRDWORK File ID'),
                Forms\Components\TextInput::make('PRDWORK_FileName')
                    ->required()
                    ->readonly()
                    ->label('PRDWORK File Name'),
                Forms\Components\TextInput::make('PRDWORK_MediaMasterID')
                    ->required()
                    ->numeric()
                    ->readonly()
                    ->label('PRDWORK Media Master ID'),
                Forms\Components\TextInput::make('PRDWORK_PixelH')
                    ->required()
                    ->numeric()
                    ->readonly()
                    ->label('PRDWORK Height (px)'),
                Forms\Components\TextInput::make('PRDWORK_PixelW')
                    ->required()
                    ->numeric()
                    ->readonly()
                    ->label('PRDWORK Width (px)'),
                Forms\Components\TextInput::make('PRDWORK_Ratio')
                    ->numeric()
                    ->readonly()
                    ->label('PRDWORK Ratio'),
                Forms\Components\TextInput::make('PRDWORK_RenditionNumber')
                    ->required()
                    ->readonly()
                    ->label('PRDWORK Rendition Number'),
                Forms\Components\TextInput::make('Path')
                    ->required()
                    ->readonly()
                    ->label('Path'),
                Forms\Components\TextInput::make('Improvement_Factor')
                    ->required()
                    ->readonly()
                    ->label('Improvement Factor'),
                Forms\Components\TextInput::make('Object_ID')
                    ->required()
                    ->readonly()
                    ->label('Object ID'),
                Forms\Components\TextInput::make('Object_ImagePermissionLevel')
                    ->required()
                    ->readonly()
                    ->label('Image Permission Level'),
                Forms\Components\TextInput::make('Object_AccessLevel')
                    ->required()
                    ->readonly()
                    ->label('Object Access Level'),
                Forms\Components\TextInput::make('Object_IsImagePrimaryDisplay')
                    ->required()
                    ->readonly()
                    ->label('Is Primary Display'),
                Forms\Components\TextInput::make('Object_ImageRank')
                    ->required()
                    ->readonly()
                    ->label('Image Rank'),

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
                SpatieTagsColumn::make('tags'),
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
                SelectFilter::make('tags')
                    ->multiple()
                    ->options(Tag::all()->pluck('name', 'name'))
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when($data['values'], function (Builder $query, $data): Builder {

                            return $query->withAnyTags($data);
                        });
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                Tables\Actions\BulkAction::make('tag')
                ->form([
                    Forms\Components\SpatieTagsInput::make('tags')->dehydrated(true),
                ])
                ->action(function (Collection $records, array $data): void {
                    foreach($records as $record){
                        $record->syncTags(array_values($data['tags']));
                    }
                })
                ->icon('heroicon-o-tag'),
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
