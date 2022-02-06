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
    public $label, $name;
    protected $queryString = [
        'page'
    ];
    public $selectedRows = [];
    public $selectPageRows = false;
    public $itemPerPage = 5;
    protected $listeners = ['deleteMultiple', 'deleteSingle'];


    public function getDataProperty()
    {
        return Label::Paginate($this->itemPerPage);
    }

    public function loadData(Label $label)
    {
        $this->reset('name');
        $this->label = $label;
        $this->name = $label->name;
        $this->emit('openEditModal');
    }

    public function openModal()
    {
        $this->reset('name');
        $this->emit('openModal');

    }
    public function editData()
    {
       $data = $this->validate([
            'name' => ['required', 'min:2', 'max:33', Rule::unique('labels', 'name')->ignore($this->label['id'])],
        ]);
        $this->label->update($data);
        $this->emit('dataAdded', ['dataId' => 'item-id-'.$this->label->id]);
        $this->alert('success', __('Data updated successfully'));
        $this->reset('name');
    }
    public function saveData()
    {
        $data =  $this->validate([
            'name' => ['required', 'min:2', 'max:33', Rule::unique('labels', 'name')],
        ]);
        $data = Label::create($data);
        $this->goToPage($this->getDataProperty()->lastPage());
        $this->emit('dataAdded', ['dataId' => 'item-id-'.$data->id]);
        $this->alert('success', __('Data saved successfully'));
        $this->reset('name');
    }

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->data->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset('selectedRows', 'selectPageRows');
        }
    }
    public function changeStatus(Label $label)
    {
        $label->status?$label->update(['status'=>0]):$label->update(['status'=>1]);
        $this->alert('success', 'Basic Alert');
        $this->emit('dataAdded');
    }

    public function render()
    {
        $items = $this->data;
        return view('livewire.admin.setup.label-component', compact('items'));
    }
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

}
