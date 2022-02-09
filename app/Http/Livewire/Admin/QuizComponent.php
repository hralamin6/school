<?php

namespace App\Http\Livewire\Admin;

use App\Models\Quiz;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class QuizComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $quiz, $name, $total_question, $seconds_per_item, $date_time;
    protected $queryString = [
        'page'
    ];
    public $selectedRows = [];
    public $selectPageRows = false;
    public $itemPerPage = 5;
    protected $listeners = ['deleteMultiple', 'deleteSingle'];


    public function getDataProperty()
    {
        return Quiz::Paginate($this->itemPerPage);
    }

    public function loadData(Quiz $quiz)
    {
        $this->reset('name');
        $this->quiz = $quiz;
        $this->name = $quiz->name;
        $this->total_question = $quiz->total_question;
        $this->seconds_per_item = $quiz->seconds_per_item;
        $this->date_time = $quiz->date_time;
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
            'name' => ['required', 'min:2', 'max:33', Rule::unique('quizzes', 'name')->ignore($this->quiz['id'])],
            'total_question' => 'required',
            'seconds_per_item' => 'required',
            'date_time' => 'required'
        ]);
        $this->quiz->update($data);
        $this->emit('dataAdded', ['dataId' => 'item-id-'.$this->quiz->id]);
        $this->alert('success', __('Data updated successfully'));
        $this->reset('name');
    }
    public function saveData()
    {
        $data =  $this->validate([
            'name' => ['required', 'min:2', 'max:33', Rule::unique('quizzes', 'name')],
            'total_question' => 'required',
            'seconds_per_item' => 'required',
            'date_time' => 'required'
        ]);
        $data = Quiz::create($data);
        $this->goToPage($this->getDataProperty()->lastPage());
        $this->emit('dataAdded', ['dataId' => 'item-id-'.$data->id]);
        $this->alert('success', __('Data saved successfully'));
        $this->reset('name', 'total_question', 'seconds_per_item');
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
    public function changeStatus(Quiz $quiz)
    {
        $quiz->status?$quiz->update(['status'=>0]):$quiz->update(['status'=>1]);
        $this->alert('success', 'Basic Alert');
        $this->emit('dataAdded');
    }

    public function render()
    {

        $items = $this->data;
        return view('livewire.admin.quiz-component', compact('items'));
    }
    public function deleteMultiple()
    {
        Quiz::whereIn('id', $this->selectedRows)->delete();
        $this->selectPageRows = false;
        $this->selectedRows = [];
    }
    public function deleteSingle(Quiz $quiz)
    {
        $quiz->delete();
        $this->alert('success', __('Data deleted successfully'));
    }
}
