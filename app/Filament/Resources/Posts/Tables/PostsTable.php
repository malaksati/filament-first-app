<?php

namespace App\Filament\Resources\Posts\Tables;

use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ReplicateAction;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

use function Laravel\Prompts\text;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("id")->label("ID")->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('title')->sortable()->searchable()->toggleable(),
                TextColumn::make('slug')->sortable()->searchable()->toggleable(),
                TextColumn::make("category.name")->sortable()->searchable()->toggleable(),
                ColorColumn::make("color")->toggleable(),
                ImageColumn::make("image")->disk('public')->visibility('public')->toggleable(),
                TextColumn::make("created_at")->label("Creation Date")->datetime()->sortable()->toggleable(),
                TextColumn::make("tags")->label("Tags")->toggleable(isToggledHiddenByDefault:true),
                IconColumn::make("published")->boolean()->toggleable(isToggledHiddenByDefault:true),
            ])
            ->defaultSort("title", "asc")
            ->filters([
                Filter::make("created_at")
                    ->label("Created Date")
                    ->schema([
                        DatePicker::make("created_at")
                            ->label("Select Date:")
                    ])
                    ->query(function ($query, $date) {
                        return $query
                            ->when($date && isset($date['created_at']), function ($q, $data) {
                                $q->whereDate('created_at', $data['created_at']);
                            });
                    }),
                SelectFilter::make("category_id")
                ->label("Select Category")
                ->relationship("category","name")
                ->preload()
            ])
            ->recordActions([
                DeleteAction::make(),
                EditAction::make(),
                ReplicateAction::make(),
                Action::make("Status")
                ->label("Status Change")
                ->icon(Heroicon::Pencil)
                ->schema([
                    Checkbox::make("published")
                ])
                ->action(function(array $data, Post $record){
                    $record->published = $data['published'];
                    $record->save();
                }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
