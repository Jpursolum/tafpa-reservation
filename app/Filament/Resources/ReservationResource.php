<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Client Reservations';
    protected static ?string $navigationGroup = 'For Posting';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('full_name')
                    ->label('Full Name')
                    ->required()
                    ->disabled(),

                Forms\Components\TextInput::make('guests')
                    ->label('Number of Guests')
                    ->numeric()
                    ->minValue(1)
                    ->disabled(),

                Forms\Components\TextInput::make('address')
                    ->label('Address')
                    ->disabled(),

                Forms\Components\TextInput::make('contact_number')
                    ->label('Contact Number')
                    ->tel()
                    ->disabled(),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->disabled(),

                Forms\Components\DatePicker::make('reserve_date')
                    ->label('Reservation Date')
                    ->disabled(),

                Forms\Components\Select::make('status')
                    ->label('Reservation Status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'cancelled' => 'Cancelled',
                        'paid' => 'Paid',
                    ])
                    ->required()
                    ->native(false),

                Forms\Components\FileUpload::make('gcash_receipt')
                    ->label('GCash Receipt')
                    ->directory('receipts')
                    ->image()
                    ->imagePreviewHeight('150')
                    ->visibility('private'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('cottage.name')
                    ->label('Cottage')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('reserve_date')
                    ->label('Date')
                    ->date()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary' => 'pending',
                        'success' => 'approved',
                        'danger' => 'cancelled',
                        'warning' => 'paid',
                    ])
                    ->sortable(),

                Tables\Columns\ImageColumn::make('gcash_receipt')
                    ->label('GCash Receipt')
                    ->disk('public')
                    ->height(100)
                    ->visibility('private'),
            ])
            ->defaultSort('reserve_date', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
