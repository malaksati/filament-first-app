<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make("Tabs")
                    ->tabs([
                        Tab::make("Product Info")
                            ->icon(Heroicon::InformationCircle)
                            ->schema([
                                TextEntry::make("id")
                                    ->label("Product ID")
                                    ->weight("bold")
                                    ->color("succes"),
                                TextEntry::make("name")
                                    ->label("Product Name")
                                    ->weight("bold")
                                    ->color("succes"),
                                TextEntry::make("sku")
                                    ->label("Product SKU")
                                    ->weight("bold")
                                    ->badge(),
                                TextEntry::make("description")
                                    ->label("Product Description")
                                    ->weight("bold"),
                                TextEntry::make("created_at")
                                    ->label("Product Creation Date")
                                    ->weight("bold")
                                    ->color("info")
                                    ->date('d/m/Y'),
                            ]),
                        Tab::make("Price & Stock")
                            ->icon(Heroicon::CurrencyDollar)
                            ->schema([
                                TextEntry::make("price")
                                    ->label("Product Price")
                                    ->weight("bold"),
                                TextEntry::make("stock")
                                    ->label("Product Stock")
                                    ->weight("bold"),
                            ]),
                        Tab::make("Media & Status")
                            ->icon(Heroicon::Photo)
                            ->schema([
                                ImageEntry::make("image")
                                    ->label("Product Image")->disk('public')->visibility('public'),
                                IconEntry::make("is_activated")
                                    ->label("Is Activate?")->boolean(),
                                IconEntry::make("is_featured")
                                    ->label("Is Feature?")->boolean(),
                            ])
                    ])
                // ->vertical()
            ]);
    }
}
