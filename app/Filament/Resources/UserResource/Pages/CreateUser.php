<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Forms;
use App\Filament\Resources\UserResource;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    use Forms\Concerns\InteractsWithForms;
    protected static string $resource = UserResource::class;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required(),
                // ...
            ]);
    }
}
