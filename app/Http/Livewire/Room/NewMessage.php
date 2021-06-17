<?php

namespace App\Http\Livewire\Room;

use App\Events\MessageAdded;
use App\Models\Room;
use Livewire\Component;

class NewMessage extends Component
{

    public Room $room;
    public $message;


    protected $rules = [
        'message' => 'required|min:3'
    ];

    public function sendNewMessage()
    {
        $this->validate();
        $msg = $this->room->messages()->create([
            'body' => $this->message,
            'user_id' => auth()->id(),
        ]);
        $this->message = null;
        $this->emit('message.added', $msg->id);
        broadcast(new MessageAdded($this->room,$msg))->toOthers();
    }

    public function render()
    {
        return view('livewire.room.new-message');
    }
}
