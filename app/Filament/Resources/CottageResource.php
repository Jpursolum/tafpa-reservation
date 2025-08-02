<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CottageResource\Pages;
use App\Models\Cottage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CottageResource extends Resource
{
    protected static ?string $model = Cottage::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function getNavigationGroup(): ?string
    {
        return 'Floating Cottage Reservation';
    }

    public static function getNavigationLabel(): string
    {
        return 'For Posting';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Cottage Name')
                ->required()
                ->maxLength(100),

            Forms\Components\Textarea::make('description')
                ->label('Cottage Description')
                ->rows(3)
                ->maxLength(500),

            Forms\Components\TextInput::make('capacity')
                ->numeric()
                ->label('Capacity (pax)')
                ->required()
                ->suffix('person/s'),

            Forms\Components\TextInput::make('price_per_day')
                ->numeric()
                ->label('Price per Day')
                ->prefix('₱')
                ->required(),

            Forms\Components\Select::make('status')
                ->label('Availability Status')
                ->options([
                    'available' => 'Available',
                    'unavailable' => 'Unavailable',
                ])
                ->default('available'),

            Forms\Components\FileUpload::make('image')
                ->image()
                ->label('Cottage Photo')
                ->directory('cottages')
                ->imageEditor()
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Preview')
                    ->circular()
                    ->height(60),

                Tables\Columns\TextColumn::make('name')
                    ->label('Cottage Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('capacity')
                    ->label('Capacity')
                    ->suffix(' pax'),

                Tables\Columns\TextColumn::make('price_per_day')
                    ->label('Price')
                    ->money('PHP'),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'available',
                        'danger' => 'unavailable',
                    ])
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'available' => 'Available',
                        'unavailable' => 'Unavailable',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            // Add relation managers if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCottages::route('/'),
            'create' => Pages\CreateCottage::route('/create'),
            'edit' => Pages\EditCottage::route('/{record}/edit'),
        ];
    }
}
