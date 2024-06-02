<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Filament\Resources\ReportResource\RelationManagers;
use App\Filament\Resources\ReportResource\Widgets\IncidentLineGraph;
use App\Filament\Resources\ReportResource\Widgets\StatsOverview;
use App\Models\Report;
use Cheesegrits\FilamentGoogleMaps\Fields\Geocomplete;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Filament\Forms\Components\FileUpload;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'In Progress' => 'In Progress',
                        'Resolved' => 'Resolved',
                        'Cancelled' => 'Cancelled'
                    ]),
                TextInput::make('date')
                    ->readOnly(),
                TextInput::make('time')
                    ->readOnly(),
                TextInput::make('citizen_id')
                    ->readOnly(),
                Select::make('department')
                    ->options([
                        'Fire' => 'Fire',
                        'Medical' => 'Medical',
                    ]),
                Select::make('category')
                    ->options([
                        'Emergency Report' => 'Emergency Report',
                        'Incident Report' => 'Incident Report',
                    ]),
                TextInput::make('station'),
                Textarea::make('message')
                    ->readOnly(),
                FileUpload::make('video'),
                FileUpload::make('recording'),
                Geocomplete::make('location')
                    ->isLocation()
                    ->geocodeOnLoad(),
                Map::make('location')
                    ->label('Pinned location'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->numeric()
                    ->label('Report ID')
                    ->grow(false)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable()
                    ->grow(false)
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'danger',
                        'In Progress' => 'warning',
                        'Resolved' => 'success',
                        'Cancelled' => 'gray',
                    }),
                TextColumn::make('department')
                    ->grow(false)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category')
                    ->grow(false)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('station')
                    ->grow(false)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date')
                    ->searchable()
                    ->grow(false)
                    ->sortable(),
                TextColumn::make('time')
                    ->grow(false)
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'In Progress' => 'In Progress',
                        'Resolved' => 'Resolved',
                        'Cancelled' => 'Cancelled'
                    ]),
                SelectFilter::make('department')
                    ->options([
                        'Medical' => 'Medical',
                        'Fire' => 'Fire',
                    ]),
                SelectFilter::make('category')
                    ->options([
                        'Emergency Report' => 'Emergency Report',
                        'Incident Report' => 'Incident Report',
                    ])
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
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            StatsOverview::class,
            IncidentLineGraph::class,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'Pending')->count();
    }
}
