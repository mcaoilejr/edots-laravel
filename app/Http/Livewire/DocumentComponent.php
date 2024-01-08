<?php

namespace App\Http\Livewire;

use App\Models\Office;
use Livewire\Component;
use App\Models\Document;
use App\Models\Documenttype;
use Livewire\WithPagination;
use App\Models\Documenthistory;
use Illuminate\Support\Facades\Auth;

class DocumentComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $code;
    public $title;
    public $documenttype_id="App for Leave/Return to Duty";
    public $status;
    public $document_id;

    public $selectedid;
    public $user_id;

    public $search;
    public $criteria='title';

    public $office_id=7;
    public $action="forward";

    protected $rules = [
      'title' => 'required',
      'documenttype_id' => 'required',
  ];

    public function mount(){
      $this->user_id = auth()->user()->id;
    }

    public function resetInputFields()
    {
        $this->code = '';
        $this->title = '';
        $this->documenttype_id = '';
        $this->status = '';
        $this->document_id = '';
    }

    public function generateRandomString($length = 6) {
      $characters = '123456789DEPEDKDHMCJR';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
    public function selectDocument($id){
        $this->selectedid = $id;
    }

    public function handleClick()
    {
        $rec = Document::find($this->selectedid);
        if($this->action=='forward'){
            $rec->forwardedto = $this->office_id;
            $rec->status = 'Forwarded';
            $rec->save();
            $history = new Documenthistory();
            $history->document_id = $this->selectedid;
            $history->user_id=Auth::user()->id;
            $history->action = 'Forwarded';
            $history->remarks = 'Forwarded to '.Office::find($this->office_id)->name;
            $history->save();
        }elseif($this->action=='receive'){
            $rec->receivedby = $this->office_id;
            $rec->status = 'Received';
            $rec->save();
            $history = new Documenthistory();
            $history->document_id = $this->selectedid;
            $history->user_id=Auth::user()->id;
            $history->action = 'Received';
            $history->remarks = 'Received by '.Office::find($this->office_id)->name;
            $history->save();
        }elseif($this->action=='cancel'){
            $rec->status = 'Cancelled';
            $rec->save();
            $history = new Documenthistory();
            $history->document_id = $this->selectedid;
            $history->user_id=Auth::user()->id;
            $history->action = 'Terminated';
            $history->remarks = 'Cancelled by '.Office::find($this->office_id)->name;
            $history->save();
        }elseif($this->action=='terminated'){
            $rec->status = 'Terminated';
            $rec->save();
            $history = new Documenthistory();
            $history->document_id = $this->selectedid;
            $history->user_id=Auth::user()->id;
            $history->action = 'Terminated';
            $history->remarks = 'Terminated by '.Office::find($this->office_id)->name;
            $history->save();
        }
        session()->flash('message', 'Processed!');
    }

    public function store()
    {
        $this->validate();
        //$documentcode = $this->generateRandomString();
        $documentcode = "";
        $i=0;
        do{
            $documentcode = $this->generateRandomString();
            $check = Document::where('documentcode', $documentcode)->get();
            $i = count($check);
        }while($i>0);

        $doc = new Document();
        $doc->documentcode = $documentcode;
        $doc->title = strtoupper(auth()->user()->name) .'-'. $this->title;
        $doc->documenttype_id = $this->documenttype_id;
        $doc->submittedby = Auth::user()->name;
        $doc->encodedby = Auth::user()->id;
        $doc->forwardedto = 0;
        $doc->receivedby = 7;
        $doc->status = 'Received';
        $doc->save();
        
        $doc = Document::where('documentcode',$documentcode)->get();
        $history = new Documenthistory();
        $history->document_id = $doc[0]->id;
        $history->user_id=7;
        $history->action = 'Forwarded';
        $history->remarks = $this->title.' submitted to records section.';
        $history->save();
        
        session()->flash('message', 'Successfully submitted!');
    }

    public function delete($id)
    {
        $rec = Document::find($id);
        $rec->delete();
        session()->flash('message', 'Submission Deleted');
    }

    public function edit($id)
    {
        $rec = Document::find($id);
        $this->code = $rec->code;
        $this->title = $rec->title;
        $this->documenttype_id = $rec->documenttype_id;
        $this->status = $rec->status;
        $this->document_id = $rec->id;
    }
    
    public function render()
    {
        $offices = Office::orderBy('name')->where('id','<',28)->get();
        if (Auth::user()->type == 'admin') {
          $rec = Document::where($this->criteria,'LIKE','%'.$this->search.'%')
                ->where('status','Received')
                ->where('receivedby','7')
                ->orderBy('created_at','DESC')
                ->paginate(25);
          $doctype = Documenttype::orderBy('name')->get();
          return view('livewire.documents.document-component',[
                      'documents' => $rec,
                      'doctypes' => $doctype,
                      'offices' => $offices
          ]);
        }else{
          $rec = Document::where('encodedby',$this->user_id)
                ->where($this->criteria,'LIKE','%'.$this->search.'%')
                ->orderBy('created_at')
                ->paginate(20);
          $doctype = Documenttype::orderBy('name')->get();
          return view('livewire.documents.document-component',[
                      'documents' => $rec,
                      'doctypes' => $doctype,
                      'offices' => $offices
          ]);
      }
    }
}
