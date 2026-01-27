<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make("Product Info")
                        ->description("Fill all the fields")
                        ->schema([
                            Group::make()
                                ->schema([
                                    TextInput::make("name")->required(),
                                    TextInput::make("sku")->required(),
                                ])->columns(2),
                            MarkdownEditor::make("description"),

                        ]),
                    Step::make("Pricing & Stock")
                        ->description("Fill all the fields")
                        ->schema([
                            Group::make()
                                ->schema([
                                    TextInput::make("price")->required(),
                                    TextInput::make("stock")->required(),
                                ])->columns(2)
                        ]),
                    Step::make("Media & Status")
                        ->description("Fill all the fields")
                        ->schema([
                            FileUpload::make("image")->disk("public")->directory("products"),
                            Checkbox::make("is_activated"),
                            Checkbox::make("is_featured")
                        ]),
                ])->columnSpanFull()
                // ->skippable()
                ->submitAction(
                    Action::make("save")
                    ->label("Save Product")
                    ->color("primary")
                    ->submit("save")
                )
            ]);
    }
}
