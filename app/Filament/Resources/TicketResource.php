<?php

namespace Modules\Queuing\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Modules\Base\Filament\Resources\BaseResource;
use Modules\Base\Filament\Resources\Pages;
use Modules\Queuing\Models\Ticket;

class TicketResource extends BaseResource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $slug = 'queuing/ticket';

    protected static ?string $navigationGroup = 'Queuing';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('number')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('prefix')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('attendant_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('is_announced')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('is_closed')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('prefix')
                    ->searchable(),
                Tables\Columns\TextColumn::make('attendant_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('is_announced')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('is_closed')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {

        Pages\ListBase::setResource(static::class);

        return [
            'index' => Pages\ListBase::route('/'),
            'create' => Pages\CreateBase::route('/create'),
            'edit' => Pages\EditBase::route('/{record}/edit'),
        ];
    }
}
