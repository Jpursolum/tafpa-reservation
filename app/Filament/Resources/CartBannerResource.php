<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CartBannerResource\Pages;
use App\Models\CartBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\DateTimeColumn;

class CartBannerResource extends Resource
{
    protected static ?string $model = CartBanner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Cart Banner';
    protected static ?string $pluralModelLabel = 'Cart Banners';
    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('title')
                ->label('Main Title')
                ->required()
                ->maxLength(100),

            TextInput::make('subtitle')
                ->label('Sub Title')
                ->required()
                ->maxLength(100),

            Textarea::make('description')
                ->label('Description')
                ->rows(4)
                ->required(),

            TextInput::make('discount_text')
                ->label('Discount Text')
                ->helperText('Example: 30% OFF per kg')
                ->required(),

            FileUpload::make('image')
                ->label('Banner Image')
                ->directory('banners')
                ->image()
                ->imageEditor()
                ->required(),

            DateTimePicker::make('countdown_until')
                ->label('Countdown Deadline')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Banner')
                    ->width(80)
                    ->height(50),

                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('discount_text')
                    ->label('Discount'),

                TextColumn::make('countdown_until')
    ->label('Ends At')
    ->dateTime()
    ->sortable(),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCartBanners::route('/'),
            'create' => Pages\CreateCartBanner::route('/create'),
            'edit' => Pages\EditCartBanner::route('/{record}/edit'),
        ];
    }
}
