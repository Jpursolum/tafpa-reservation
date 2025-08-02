<?php

namespace App\Filament\Resources\CartBannerResource\Pages;

use App\Filament\Resources\CartBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCartBanner extends EditRecord
{
    protected static string $resource = CartBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
