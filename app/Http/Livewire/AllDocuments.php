<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AllDocuments extends Component
{
    use WithFileUploads,WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $bp,$title,$document,$newBP,$editId,$editDoc,$deleteFile,$deleteId;
    
    public function uploadDocument()
    {
        $this->validate([
            'document' => 'required',
            'title' => 'required'
        ]);
        $extension = $this->document->extension();
        $path = Str::slug($this->title,'_').'_'.now()->timestamp.'.'.$extension;
        User::find(1)->addMedia($this->document->getRealPath())
                        ->withCustomProperties(['docTitle' => $this->title])
                        ->usingFileName($path)
                        ->usingName($path)
                        ->toMediaCollection('documents');
        $this->reset('title','document');
        $this->dispatchBrowserEvent('closeModal');
    }
    public function uploadBP()
    {
        $this->validate([
            'newBP' => 'required',
        ]);
        $extension = $this->newBP->extension();
        $path = 'business_policy_'.now()->timestamp.'.'.$extension;
        User::find(1)->addMedia($this->newBP->getRealPath())
                        ->usingFileName($path)
                        ->usingName($path)
                        ->toMediaCollection('bp');
        $this->reset('newBP');
        $this->dispatchBrowserEvent('closeModal');
    }
    public function editBP()
    {
        $this->validate([
            'newBP' => 'required',
        ]);
        Media::where('collection_name','bp')->delete();
        $extension = $this->newBP->extension();
        $path = 'business_policy_'.now()->timestamp.'.'.$extension;
        User::find(1)->addMedia($this->newBP->getRealPath())
                        ->usingFileName($path)
                        ->usingName($path)
                        ->toMediaCollection('bp');
        $this->reset('newBP');
        $this->dispatchBrowserEvent('closeModal');
    }
    public function deleteBP()
    {
        Media::where('collection_name','bp')->delete();
        $this->dispatchBrowserEvent('closeModal');
    }
    public function deleteDoc($docId)
    {
        $this->reset('deleteId','deleteFile');
        $this->deleteId = $docId;
        $this->deleteFile = Media::find($this->deleteId);
        $this->dispatchBrowserEvent('deleteDocModal');
    }
    public function deleteDocument()
    {
        $this->deleteFile->delete();
        $this->reset('deleteFile','deleteId');
        $this->dispatchBrowserEvent('closeModal');
    }
    public function editDoc($docId)
    {
        $this->reset('editDoc','document','title','editId');
        $this->editId = $docId;
        $file = Media::find($this->editId);
        $this->editDoc['title'] = $file->getCustomProperty('docTitle');
        $this->title = $this->editDoc['title'];
        $this->editDoc['created_at'] = $file->created_at;
        $this->dispatchBrowserEvent('editDocModal');
    }
    public function editDocument()
    {
        $this->validate([
            'document' => 'required',
            'title' => 'required'
        ]);
        $extension = $this->document->extension();
        $path = Str::slug($this->title,'_').'_'.now()->timestamp.'.'.$extension;
        $media = User::find(1)->addMedia($this->document->getRealPath())
                        ->withCustomProperties(['docTitle' => $this->title])
                        ->usingFileName($path)
                        ->usingName($path)
                        ->toMediaCollection('documents');
        $media->created_at = $this->editDoc['created_at'];
        $media->updated_at = $this->editDoc['created_at'];
        $media->save();
        Media::find($this->editId)->delete();
        $this->reset('editDoc','document','title','editId');
        $this->dispatchBrowserEvent('closeModal');
    }
    public function render()
    {
        $this->bp = Media::where('collection_name','bp')->first();
        $documents = Media::where('collection_name','documents')->orderBy('created_at','DESC')->paginate(10);
        return view('livewire.all-documents',compact('documents'));
    }
}
