<?php

namespace App\Filament\Widgets;

use App\Models\Report;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LiveReports extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                // TODO : check if this is sustainable
                Report::where('status', 'Pending')
                    ->orWhere('status', 'In Progress')
                    ->latest()
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
                TextColumn::make('date')
                    ->searchable()
                    ->grow(false)
                    ->sortable(),
                TextColumn::make('time')
                    ->grow(false)
                    ->sortable(),
            ]);
    }
}
