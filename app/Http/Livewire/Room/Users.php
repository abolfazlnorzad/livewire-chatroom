<?php

namespace App\Http\Livewire\Room;

use App\Models\Room;
use Livewire\Component;

class Users extends Component
{
    public Room $room;
    public $users;

    public function mount()
    {
        $this->users = collect([]);
    }

    public function getListeners()
    {
        return [
            "echo-presence:room.added-{$this->room->id},here" => "handleHere",
            "echo-presence:room.added-{$this->room->id},joining" => "handleJoining",
            "echo-presence:room.added-{$this->room->id},leaving" => "handleLeaving",
        ];
    }

    public function handleHere($users)
    {
        $this->users =collect($users);
    }

    public function handleJoining($user)
    {
        $this->users->push($user);
    }

    public function handleLeaving($user)
    {
        $this->users = $this->users->filter(function ($u) use ($user) {
            return $u['id'] !== $user['id'];
        });
    }


    public function render()
    {
        return view('livewire.room.users');
    }
}
