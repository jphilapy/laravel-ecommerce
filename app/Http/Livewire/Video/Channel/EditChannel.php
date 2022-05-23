<?php

namespace App\Http\Livewire\Video\Channel;

use App\Models\Video\Channel;
use Livewire\Component;

class EditChannel extends Component
{
    public $channel;

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function render()
    {
        return view('livewire.video.channel.edit-channel');
    }
}
