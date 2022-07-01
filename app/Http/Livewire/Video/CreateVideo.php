<?php

namespace App\Http\Livewire\Video;

use App\Models\Video\Channel;
use App\Models\Video\Video;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateVideo extends Component
{

    use WithFileUploads;

    public Channel $channel;
    public Video $video;
    public $videoFile;

    public $test = "test";

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function render()
    {
        return view('livewire.video.create-video')
            ->extends('layouts.app');
    }

    public function fileCompleted()
    {
        dd('file upload completed');
    }

/*    public function upload()
    {

       $this->validate([
           'videoFile' => 'required|mimes:mp4|max:102400',
       ]);
    }*/
}
