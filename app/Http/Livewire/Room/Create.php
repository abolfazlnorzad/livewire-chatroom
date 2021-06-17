<?php

namespace App\Http\Livewire\Room;

use App\Events\RoomAdded;
use App\Models\Room;
use Livewire\Component;
use function Livewire\str;

class Create extends Component
{

    public $name;

    protected $rules = [
        'name' => 'required|min:3'
    ];

    public function updated($name)
    {
        $this->validateOnly($name);
    }

    public function createRoom()
    {
        $this->validate();
        $newRoom = Room::query()->create([
            'name' => $this->name,
            'slug' => str_replace(' ','_',$this->name),
            'user_id' => auth()->id()
        ]);
        $this->emit('roomAdd');
        broadcast(new RoomAdded())->toOthers();

        $this->name = null;
    }
    public function render()
    {
        return view('livewire.room.create');
    }
}
