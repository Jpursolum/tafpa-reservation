<?php

namespace App\Filament\Resources\CartBannerResource\Pages;

use App\Filament\Resources\CartBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCartBanners extends ListRecords
{
    protected static string $resource = CartBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
