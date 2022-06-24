<?php

namespace App\Http\Livewire\Video\Channel;

use App\Models\Video\Channel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditChannel extends Component
{
    use AuthorizesRequests;

    public $channel;
    protected function rules (){
        return [
            'channel.name' =>'required|max:255|unique:channels,name,' . $this->channel->id,
            'channel.slug' =>'required|max:255|unique:channels,slug,' . $this->channel->slug,
            'channel.description' =>'nullable|max:1000',
        ];
    }


    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function render()
    {
        return view('livewire.video.channel.edit-channel');
    }

    public function update()
    {
        $this->authorize('update', $this->channel);

        $this->validate();
        $this->channel->update([
            'name'=>$this->channel->name,
            'slug'=>$this->channel->slug,
            'description'=>$this->channel->description,
        ]);

        session()->flash('message', 'Channel updated');
        return redirect()->route('channel.edit', ['channel'=>$this->channel->slug]);
    }
}
