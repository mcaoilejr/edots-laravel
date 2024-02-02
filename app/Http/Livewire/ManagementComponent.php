<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Document;
use Auth;
use App\Models\Documenthistory;
use App\Models\Office;

use Livewire\WithPagination;

class ManagementComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $searchdoc;
    public $action = "receive";
    public $officeaction = "forward";
    public $office_id;
    public $remarks;
    public $category='title';

    public $isExecuted = false;

    public $selectedid;

    public function mount(){
        $this->search = "";
        $this->action = "receive";
    }

    public function clickAction($id){
        $this->selectedid = $id;
        $this->isExecuted = false;
    }

    public function handleModalClick()
    {
        $rec = Document::find($this->selectedid);
        if ($this->remarks=='') $this->remarks = 'No remarks.';

        if($this->officeaction=='forward'){
            $request = $this->validate([
                'office_id' => 'required',
            ]);
            $rec->forwardedto = $this->office_id;
            $rec->status = 'Forwarded';
            $rec->save();
            $history = new Documenthistory();
            $history->document_id = $this->selectedid;
            $history->user_id=Auth::user()->id;
            $history->action = 'Forwarded';
            $history->remarks = 'Forwarded to '.Office::find($this->office_id)->name.' - '.$this->remarks;
            $history->save();
            session()->flash('message', 'Successfully forwarded!');
            $this->remarks = '';
        }
        
        
        if($this->officeaction=='Terminated'){
            $rec->status = 'Terminated';
            $rec->save();
            $history = new Documenthistory();
            $history->document_id = $this->selectedid;
            $history->user_id=Auth::user()->id;
            $history->action = 'Terminated';
            $history->remarks = 'Terminated by '.Office::find(Auth::user()->office_id)->name.' - '.$this->remarks;
            $history->save();
            session()->flash('message', 'Successfully terminated!');
        }
        
        $this->isExecuted = true;
    }

    public function handleClick($id){
        $rec = Document::find($id);
        $rec->status = "Received";
        $rec->receivedby = Auth::user()->office_id;
        $rec->save();

        $history = new Documenthistory();
        $history->document_id = $id;
        $history->user_id=Auth::user()->id;
        $history->action = 'Received';
        $history->remarks = 'Confirmed by '.Office::find(Auth::user()->office_id)->name;
        $history->save();
    }

    public function render()
    {
        $offices = Office::orderBy('name')->where('id','<',28)->get();

        if ($this->action=='receive'){
            return view('livewire.management-component',[
                'documents'=>Document::where('forwardedto',Auth::user()->office_id)
                            ->where('status','Forwarded')
                            ->where('title','like','%'.$this->search.'%')
                            ->paginate(10),
                'total'=>Document::where('forwardedto',Auth::user()->office_id)
                            ->where('status','Forwarded')
                            ->count(),
                'offices'=>$offices
            ]);
        }
        if ($this->action=='received'){
            return view('livewire.management-component',[
                'documents'=>Document::where('receivedby',Auth::user()->office_id)
                            ->where('status','Received')
                            ->where('title','like','%'.$this->search.'%')
                            ->paginate(10),
                'total'=>Document::where('receivedby',Auth::user()->office_id)
                            ->where('status','Received')
                            ->count(),
                'offices'=>$offices
            ]);
        }

        if ($this->action=='check'){
            return view('livewire.management-component',[
                'documents'=>Document::select('id','documentcode','title','status')
                            ->where($this->category,'like','%'.$this->searchdoc.'%')
                            ->paginate(50),
                'total'=>Document::count(),
            ]);
        }
    }
}
