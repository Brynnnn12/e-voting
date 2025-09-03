<?php

namespace App\Filament\Resources\Kandidats;

use App\Filament\Resources\Kandidats\Pages\CreateKandidat;
use App\Filament\Resources\Kandidats\Pages\EditKandidat;
use App\Filament\Resources\Kandidats\Pages\ListKandidats;
use App\Filament\Resources\Kandidats\Schemas\KandidatForm;
use App\Filament\Resources\Kandidats\Tables\KandidatsTable;
use App\Models\Kandidat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KandidatResource extends Resource
{
    protected static ?string $model = Kandidat::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Kandidat';

    protected static ?string $navigationLabel = 'Data Kandidat';

    public static function form(Schema $schema): Schema
    {
        return KandidatForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KandidatsTable::configure($table);
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
            'index' => ListKandidats::route('/'),
            'create' => CreateKandidat::route('/create'),
            'edit' => EditKandidat::route('/{record}/edit'),
        ];
    }
}
