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

    protected $rules = [
        'videoFile' => 'required|mimes:mp4|max:1228800'
    ];

    public function mount(Channel $channel)
    {
        $this->channel = $channel;
    }

    public function render()
    {
        return view('livewire.video.create-video');
    }

    public function fileCompleted()
    {

        // validation
        $this->validate();

        // save file
        $path = $this->videoFile->store('videos-temp');

        // create video record in db
                $this->video = $this->channel->videos()->create([
                    'title' => 'untitled',
                    'description' => 'none',
                    'uid' => uniqid(true),
                    'visibility' => 'private',
                    'path' => explode('/', $path)[1]
                ]);

        // redirect to edit route
                return redirect()->route('video.edit', [
                    'channel' => $this->channel,
                    'video' => $this->video,
                ]);
    }

    /*    public function upload()
        {

           $this->validate([
               'videoFile' => 'required|mimes:mp4|max:102400',
           ]);
        }*/
}
