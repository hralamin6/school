<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class UserComponent extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    protected function getTableQuery(): Builder

    {
        return User::query();

    }



    protected function getTableColumns(): array

    {

        return [
            Tables\Columns\TextColumn::make('name'),
            Tables\Columns\TextColumn::make('email')->searchable(),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        ];
    }
//
//
//
//    protected function getTableFilters(): array
//
//    {
//
//        return [ ...];
//
//    }
//
//
//
//    protected function getTableActions(): array
//
//    {
//
//        return [ ...];
//
//    }

    public function render()
    {
        return view('livewire.admin.user-component');
    }
}
