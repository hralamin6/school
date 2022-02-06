<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Filament\Tables;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class UserComponent extends Component
{
    public function render()
    {
        return view('livewire.admin.user-component');
    }
}
