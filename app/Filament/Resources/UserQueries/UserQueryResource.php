<?php

namespace App\Filament\Resources\UserQueries;

use App\Models\UserQuery;

use BackedEnum;

use Filament\Resources\Resource;

use Filament\Schemas\Schema;
use Filament\Tables\Table;

use Filament\Support\Icons\Heroicon;

use App\Filament\Resources\UserQueries\Pages\CreateUserQuery;
use App\Filament\Resources\UserQueries\Pages\EditUserQuery;
use App\Filament\Resources\UserQueries\Pages\ListUserQueries;

use App\Filament\Resources\UserQueries\Schemas\UserQueryForm;
use App\Filament\Resources\UserQueries\Tables\UserQueriesTable;

class UserQueryResource extends Resource
{
    protected static ?string $model = UserQuery::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedChatBubbleLeftRight;

    protected static ?string $navigationLabel =
        'AI User Queries';

    protected static ?string $recordTitleAttribute =
        'user_name';

    public static function form(Schema $schema): Schema
    {
        return UserQueryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserQueriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [

            'index' =>
                ListUserQueries::route('/'),

            'create' =>
                CreateUserQuery::route('/create'),

            'edit' =>
                EditUserQuery::route('/{record}/edit'),

        ];
    }
}