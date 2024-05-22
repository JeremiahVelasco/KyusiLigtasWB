<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Filament\Resources\ReportResource\RelationManagers;
use App\Filament\Resources\ReportResource\Widgets\StatsOverview;
use App\Models\Report;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Report ID')
                    ->grow(false)
                    ->searchable(),
                TextColumn::make('status')
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
                TextColumn::make('created_at')
                    ->grow(false)
                    ->label('Date & Time')
                    ->dateTime()
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
        ];
    }
}
