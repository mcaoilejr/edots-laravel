<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center" >
                        <h5>SUMMARY</h5>
                    </div>
                    <div class="card-body text-center">
                        <h2 class="display-4"><strong>{{number_format($total,0)}}</strong></h2>
                        @if($action=='check')
                            <span>Total Recorded Documents</span>
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
            <div class="col-md-3">
                <div class="input-group input-group-sm mb-3">
                    <select class="form-select" wire:model="category">
                        <option value="title">Title</option>
                        <option value="documentcode">Document Code</option>
                    </select>
                </div>
            </div>
            <div class="col-md-9">
                <div class="input-group input-group-sm mb-3">
                    <input type="text" class="form-control" wire:model.debounce.500ms="searchdoc" placeholder="Search {{ucfirst($category)}}">
                </div>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Document Code</th>
                            <th>Title</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documents as $document)
                            <tr>
                                <td>{{$document->documentcode}}</td>
                                <td><a href="{{url('document/'.$document->id.'/view')}}" target="_blank">{{$document->title}}</a></td>
                                <td>{{$document->status}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
                <span class="float-end">{{$documents->links()}}</span>
            </div>
        </div>
       

        
    </div>
</div>