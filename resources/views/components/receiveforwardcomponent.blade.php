<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center" >
                        <h5>SUMMARY</h5>
                    </div>
                    <div class="card-body text-center">
                        <h2 class="display-4"><strong>{{$total}}</strong></h2>
                        @if($action=='receive')
                            <span>For Receive Documents</span>
                        @endif
                        @if($action=='received')
                            <span>Received Documents</span>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">
                        <h6>OPTION</h6>
                    </div>
                    <div class="card-body text-center">
                        <select class="form-select" wire:model="action">
                            <option value="receive">For Review Documents</option>
                            <option value="received">Received Documents</option>
                            <option value="check">Check Documents</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group input-group-sm mb-3">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Search Keyword</span>
                    <input type="text" class="form-control" wire:model.debounce.500ms="search">
                </div>
            </div>
        </div>
       
       

        @foreach($documents as $document)
            <div class="card mb-2" id="{{$document->id}}">
                <div class="card-body">
                    <h4><a href="{{url('document/'.$document->id.'/view')}}" target="_blank">{{$document->title}}</a></h4>
                    <p>
                        Document Type: {{$document->documenttype_id}} <br/>
                        Encoded last {{$document->created_at}} <br/>
                        Last Update: {{$document->updated_at}} <br/>
                        Status: {{$document->status}} <br/>
                    </p>
                    @if($action=='receive')
                        <button wire:loading.remove class="btn btn-success float-end" wire:click="handleClick({{$document->id}})"> <i class="fa fa-thumbs-up me-2"></i> 
                            Receive this Document 
                        </button>
                        @if(Auth::user()->office_id==7)
                            <a class="btn btn-secondary" target="_blank" href="{{url('qr/'.$document->id)}}">Print QR Code</a>
                        @endif
                        <button wire:loading wire:target="handleClick" class="btn btn-primary float-end" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Processing...</span>
                        </button>
                    @endif
                    @if($action=='received')
                        <button class="btn btn-primary float-end" wire:click.prevent="clickAction({{$document->id}})" data-bs-toggle="modal" data-bs-target="#staticBackdrop" > <i class="fa fa-share me-2"></i> 
                            Action
                        </button>
                    @endif

                </div>
            </div>
        @endforeach
        <div class="float-end mt-4">
            {{$documents->links()}}
        </div>
    </div>
</div>