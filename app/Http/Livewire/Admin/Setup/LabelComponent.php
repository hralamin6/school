<?php

namespace App\Http\Livewire\Admin\Setup;

use App\Models\Label;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class LabelComponent extends Component

{
    use WithPagination;
    use LivewireAlert;
    public $state = [];
    public $label;
//    protected $queryString = ['status'];
    public $selectedRows = [];
    public $selectPageRows = false;
    protected $listeners = ['deleteMultiple', 'deleteSingle'];


    public function deleteMultiple()
    {
        Label::whereIn('id', $this->selectedRows)->delete();
        $this->selectPageRows = false;
        $this->selectedRows = [];
    }
    public function deleteSingle(Label $label)
    {
        $label->delete();
        $this->alert('success', __('Data deleted successfully'));
    }

    public function loadData(Label $label)
    {
        $this->label = $label;
        $this->state = $label->toArray();
    }

    public function editData()
    {
        Validator::make( $this->state, [
            'name' => ['required', 'min:2', 'max:33', Rule::unique('labels', 'name')->ignore($this->state['id'])],
        ])->validate();
        $this->label->update($this->state);
        $this->goToPage($this->getDataProperty()->lastPage());
        $this->emit('dataAdded', ['dataId' => 'item-id-'.$this->label->id]);
        $this->alert('success', __('Data updated successfully'));
        $this->reset('state');
    }
    public function saveData()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        Validator::make( $this->state, [
                'name' => 'required|unique:labels|max:22',
            ])->validate();
        $data = Label::create($this->state, ['status' => 1]);
//        $this->goToPage($this->getDataProperty()->lastPage());
        $this->emit('dataAdded', ['dataId' => 'item-id-'.$data->id]);
        $this->alert('success', __('Data saved successfully'));
        $this->reset('state');

    }

    public function updatedSelectPageRows($value)
    {
//dd($value);
        if ($value) {
            $this->selectedRows = $this->data->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
//            $this->selectedRows=[];
//            $this->selectedPageRows=false;
            $this->reset('selectedRows', 'selectPageRows');
        }

    }
    public function changeStatus(Label $label)
    {
        $label->status?$label->update(['status'=>0]):$label->update(['status'=>1]);
        $this->alert('success', 'Basic Alert');
    }

    public function getDataProperty()
    {
        return Label::Paginate(40);
    }

    public function render()
    {
        $items = $this->data;
        return view('livewire.admin.setup.label-component', compact('items'));
    }
}
