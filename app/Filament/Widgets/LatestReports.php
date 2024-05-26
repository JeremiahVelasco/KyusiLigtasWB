<?php

namespace App\Filament\Widgets;

use App\Models\Report;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestReports extends BaseWidget
{
    public function table(Table $table): Table
    {

        return $table
            ->query(
                Report::query()
            )
            ->columns([
                TextColumn::make('id')
                    ->numeric()
                    ->label('Report ID')
                    ->grow(false)
                    ->searchable()
                    ->sortable(),
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
            ]);
    }
}
