<?php

namespace App\Http\Livewire;

use App\Events\MessageSentEvent;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class MessageComponent extends Component
{
    use WithFileUploads;
    public $body;
    public $image;
    public $selectedConversation;

    public function mount()
    {
        $this->selectedConversation = Conversation::query()
            ->where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->orderBy('updated_at', 'desc')
            ->firstOrFail();
    }

    public function viewMessage($conversationId)
    {
        $this->selectedConversation = Conversation::findOrFail($conversationId);
    }
    public function updated($value)
    {
        $this->validateOnly($value,[
            'body'=>'required|max:999'
        ]);

    }
    public function addMessage()
    {
        $this->validate([
            'body'=>'required|max:999',
            'image'=>'nullable|image|max:555'
        ]);
        $message = $this->selectedConversation->messages()->create([
            'user_id'=>auth()->id(),
            'body'=>$this->body,
        ]);
        $this->selectedConversation->touch();
        if (($this->image)) {
            $message->addMedia($this->image->getRealPath())->toMediaCollection('message');
        }
        broadcast(new MessageSentEvent($message))->toOthers();
        $this->viewMessage($this->selectedConversation->id);
        $this->emit('dataAdded', ['dataId' => $this->selectedConversation->id]);

        $this->dispatchBrowserEvent('scrollHeight');

        $this->reset('body', 'image');
    }

    public function deleteMessage(Message $message)
    {
        $message->delete();
        $this->viewMessage($this->selectedConversation->id);
    }

    public function render()
    {
        $last_message = $this->selectedConversation->messages->last();
        if ($last_message){
            if ($this->selectedConversation!=null && $last_message->user_id!=Auth::id()){
                foreach ($this->selectedConversation->messages->where('status',0) as $message){
                    $message->update(['status'=>1]);
                }
            }

        }
        $conversations = Conversation::query()
            ->where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->orderBy('updated_at', 'desc')
            ->get();

//        dd($this->selectedConversation->messages()->whereStatus(0)->count());

        return view('livewire.message-component', [
            'conversations' => $conversations
        ]);
    }

}
