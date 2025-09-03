<?php

namespace App\Filament\Resources\Votings;

use App\Filament\Resources\Votings\Pages\ListVotings;
use App\Filament\Resources\Votings\Tables\VotingsTable;
use App\Models\Voting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;


class VotingResource extends Resource
{
    protected static ?string $model = Voting::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'Voting';



    protected static ?string $navigationLabel = 'Data Voting';

    public static function table(Table $table): Table
    {
        return VotingsTable::configure($table);
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
            'index' => ListVotings::route('/'),
        ];
    }
}
