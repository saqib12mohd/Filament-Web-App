<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make()
                ->schema([


                        TextInput::make('title')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('icon_class')
                        ->maxLength(255),

                    TextInput::make('short_desc')
                    ->label('Short Description')
                        ->required()
                        ->maxLength(255),

                    Select::make('status')
                    ->required()
                    ->options([
                        1 => 'Active',
                        0 => 'Block'
                    ]),

                    RichEditor::make('description')
                    ->disableToolbarButtons([
                        'attachFiles'
                    ])
                        ->columnSpanFull(),

                ])->columns(2),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('title')
                ->wrap()
                    ->searchable(),

                TextColumn::make('icon_class')
                ->wrap()
                    ->searchable(),

                TextColumn::make('short_desc')
                ->wrap()
                ->label('Short Description')
                    ->searchable(),

                // TextColumn::make('description')
                // ->wrap()
                //     ->searchable(),

                TextColumn::make('status')
                    ->numeric()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
