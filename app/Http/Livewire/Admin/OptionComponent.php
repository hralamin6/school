<?php

namespace App\Http\Livewire\Admin;

use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class OptionComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $quiz,$question, $option, $name, $is_ans;
    protected $queryString = [
        'page'
    ];

    public function mount(Quiz  $quiz, Question $question)
    {
        $this->quiz = $quiz;
        $this->question = $question;
    }
    public $selectedRows = [];
    public $selectPageRows = false;
    public $itemPerPage = 5;
    protected $listeners = ['deleteMultiple', 'deleteSingle'];


    public function getDataProperty()
    {
        return $this->question->options()->paginate($this->itemPerPage)->withQueryString();
    }

    public function loadData(Option $option)
    {
        $this->reset('name');
        $this->option = $option;
        $this->name = $option->name;
        $this->emit('openEditModal');
    }
    public function trueAnswer(Option $option)
    {
        $this->question->update(['answer'=>$option->id]);
        $this->alert('success', __('Data updated successfully'));
    }

    public function openModal()
    {
        $this->reset('name');
        $this->emit('openModal');

    }
    public function editData()
    {
        $data = $this->validate([
            'name' => ['required', 'min:2', 'max:33', Rule::unique('options', 'name')->ignore($this->option['id'])],
        ]);
        $this->option->update($data);
        $this->emit('dataAdded', ['dataId' => 'item-id-'.$this->option->id]);
        $this->alert('success', __('Data updated successfully'));
        $this->reset('name');
    }
    public function saveData()
    {
        $data =  $this->validate([
            'name' => ['required', 'min:2', 'max:33', Rule::unique('options', 'name')],
        ]);
        $data = $this->question->options()->create(['name' => $this->name]);
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
    public function changeStatus(Option $option)
    {
        $option->status?$option->update(['status'=>0]):$option->update(['status'=>1]);
        $this->alert('success', 'Basic Alert');
        $this->emit('dataAdded');
    }

    public function render()
    {
        $items = $this->data;
//        dd($items);
        return view('livewire.admin.option-component', compact('items'));
    }
    public function deleteMultiple()
    {
        Option::whereIn('id', $this->selectedRows)->delete();
        $this->selectPageRows = false;
        $this->selectedRows = [];
    }
    public function deleteSingle(Option $option)
    {
        $option->delete();
        $this->alert('success', __('Data deleted successfully'));
    }
}
