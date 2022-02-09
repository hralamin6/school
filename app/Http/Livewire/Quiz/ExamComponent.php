<?php

namespace App\Http\Livewire\Quiz;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ExamComponent extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $quiz, $name;
    public $ans=[];
    protected $queryString = [
        'page'
    ];
    public $selectedRows = [];
    public $selectPageRows = false;
    public $itemPerPage = 20;
    public $sameItems;
    public $date_time;
    protected $listeners = ['deleteMultiple', 'deleteSingle'];

    public function submit()
    {
        $this->quiz->answers()->delete();
        $this->quiz->results()->delete();
        $x = 0;
        foreach ($this->data as $i=> $question){
            if (isset($this->ans[$i])){
                $parts = explode('-', $this->ans[$i]);
                $q = Question::find($parts[0]);
                $ans = new Answer();
                $ans->user_id = auth()->id();
                $ans->quiz_id = $this->quiz->id;
                $ans->question_id = $q->id;
                $ans->ans_id = $parts[1];
                if (Question::find($parts[0])->answer == $parts[1]){
                    $x++;
                    $ans->is_correct = true;
                }else{
                    $ans->is_correct = false;
                }
                $ans->save();
            }
        }
        $this->quiz->results()->create([
            'user_id' => auth()->id(),
            'mark' => $x,
        ]);
        $this->alert('success', __('Data successfully created'));
        return redirect()->route('quiz.result', $this->quiz->id);
    }
    public function mount(Quiz  $quiz)
    {
//        $timestamp = strtotime( $quiz->date_time );
//        $now = strtotime( Carbon::now() );
//        dd($now);
//        dd($timestamp-$now);
//        $sdf =  date('d-m-Y', strtotime($user->from_date));
        $this->quiz = $quiz;
        $this->date_time = strtotime( $quiz->date_time );
    }
    public function getDataProperty()
    {
        return $this->quiz->questions()->inRandomOrder()->Paginate($this->itemPerPage);
    }

    public function loadData(Quiz $quiz)
    {
        $this->reset('name');
        $this->quiz = $quiz;
        $this->name = $quiz->name;
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
        ]);
        $data = Quiz::create($data);
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
    public function changeStatus(Quiz $quiz)
    {
        $quiz->status?$quiz->update(['status'=>0]):$quiz->update(['status'=>1]);
        $this->alert('success', 'Basic Alert');
        $this->emit('dataAdded');
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
    public function render()
    {
        $items = $this->data;
        $this->sameItems = $items->toArray();
        return view('livewire.quiz.exam-component', compact('items'));
    }

}
