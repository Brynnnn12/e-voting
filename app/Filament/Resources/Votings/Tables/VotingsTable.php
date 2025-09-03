<?php

namespace App\Filament\Resources\Votings\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VotingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Pemilih')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('kandidat.nama')
                    ->label('Kandidat Dipilih')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('pemilihan.nama')
                    ->label('Pemilihan')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Waktu Voting')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                // Filter bisa ditambahkan di sini jika diperlukan
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                // Admin hanya bisa melihat data, tidak ada actions
            ])
            ->toolbarActions([
                // Admin hanya bisa melihat data, tidak ada bulk actions
            ]);
    }
}
