<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SnippetResource\Pages;
use App\Models\Snippet;
use App\Models\Category;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Dotswan\FilamentCodeEditor\Fields\CodeEditor;

class SnippetResource extends Resource
{
    protected static ?string $model = Snippet::class;

    protected static ?string $navigationIcon = 'heroicon-m-code-bracket';
    public static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->default(fn () => Auth::id()),
                Forms\Components\TextInput::make('title')
                    ->live(onBlur: true) // or true for real-time updates
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state));
                    })
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->readOnly()
                    ->maxLength(255),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->options(Category::all()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
                Forms\Components\Repeater::make('downloadLink')
                    ->relationship()
                    ->collapsed()
                    ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Button')
                    ->cloneable()
                    ->defaultItems(0)
                    ->reorderable()
                    ->schema([
                        Forms\Components\TextInput::make('title')->required(),
                        Forms\Components\TextInput::make('url')->required()->url(),
                    ])
                    ->label('Download Links')
                    ->columnSpanFull(),
                CodeEditor::make('code')
                    ->minHeight(300)
                    ->darkModeTheme('basic-dark')
                    ->lightModeTheme('basic-light')
                    ->columnSpanFull(),
                CodeEditor::make('html')
                    ->minHeight(300)
                    ->darkModeTheme('basic-dark')
                    ->lightModeTheme('basic-light')
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('disabled')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable(),
                Tables\Columns\IconColumn::make('disabled')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name'), // if using Eloquent relationship
                // OR manually if not using relationship
                // ->options(Category::pluck('name', 'id')->toArray())
            ])
            ->actions(actions: [
                Tables\Actions\EditAction::make()
                    ->label(''),
                Tables\Actions\DeleteAction::make()
                    ->label(''),

                // 🔁 Duplicate action
                Tables\Actions\Action::make('duplicate')
                    ->label('')
                    ->icon('heroicon-o-document-duplicate')
                    ->action(function (Snippet $record) {
                        $new = $record->replicate(); // copy all fields
                        $new->title .= ' (Copy)'; // tweak name or slug
                        $new->slug = Str::slug($new->title); // adjust slug if needed
                        $new->save();
                    })
                    ->requiresConfirmation()
                    ->color('gray')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);

        return $table;
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSnippets::route('/'),
            'create' => Pages\CreateSnippet::route('/create'),
            'edit' => Pages\EditSnippet::route('/{record}/edit'),
        ];
    }
}
