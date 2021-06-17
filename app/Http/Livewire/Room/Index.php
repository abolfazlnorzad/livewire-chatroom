<?php

namespace App\Http\Livewire\Room;

use App\Models\Room;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $listeners = [
        'roomAdd'=>'$refresh',
        'echo-private:room.added,RoomAdded'=>'$refresh'
    ];



    public function render()
    {
        $rooms = Room::query()->latest()->paginate();
        return view('livewire.room.index', compact('rooms'));
    }
}
