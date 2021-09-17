<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Profile extends Component
{
    public $userId,$user,$medias;
    public function mount($id = NULL)
    {
        $this->userId = $id ? $id : auth()->id();
    }
    public function render()
    {
        $this->user = User::find($this->userId);
        $mediass = Media::get();
        $this->medias = $mediass->filter(function($media) {
            return $media->getCustomProperty('uploader') == $this->user->id;
        });
        return view('livewire.profile');
    }
}
