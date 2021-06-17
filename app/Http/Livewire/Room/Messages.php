<?php

namespace App\Http\Livewire\Room;

use App\Models\Message;
use Livewire\Component;

class Messages extends Component
{
    public $messages;
    public $room;

    public function mount($messages, $room)
    {
        $this->messages = $messages;
        $this->room = $room;
    }

    public function getListeners()
    {
        return [
            'message.added' => 'addNewMsg',
            "echo-private:room.added-{$this->room->id},MessageAdded" => "addNewMessageFromBroadcasting"
        ];
    }

    public function addNewMsg($messageId)
    {

        $this->messages->prepend(Message::find($messageId));
    }

    public function addNewMessageFromBroadcasting($payload)
    {

        $this->addNewMsg($payload['message']['id']);
    }


    public function render()
    {
        return view('livewire.room.messages');
    }
}
