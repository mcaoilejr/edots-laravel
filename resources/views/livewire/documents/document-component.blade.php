<div>
    <div class="row" x-data="{ open: false }">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="div">List of Documents : Account User ID :{{ $this->user_id}}</div>
            @if(Auth::user()->type != 'admin')
            <div x-show="!open"><button class="btn btn-danger" x-show="!open" @click="open = true"><i class="fa fa-add me-2"></i>Add New Document</button></div>
            <div x-show="open"><button class="btn btn-danger" x-show="open" @click="open = false"><i class="fa fa-hide me-2"></i>Hide</button></div>
            @endif
          </div>
          <div class="card-body">
            @if(session()->has('message'))
            <div class="alert alert-success">
              {{ session('message') }}
            </div>
            @endif
            <div class="row" x-show="open" x-transition.scale.80>
              <div class="col-md-12">
                @include('pages.registered.create')
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="input-group mb-3">
                  <select class="form-select" wire:model.lazy="criteria">
                    <option value="title">Title</option>
                    <option value="documentcode">Code</option>
                  </select>
                </div>
              </div>
              <div class="col-md-10">
                <div class="input-group mb-3">
                  <input type="text" wire:model="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                  <span class="input-group-text" >search</span>
                </div>
              </div>
            </div>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Code</th>
                  <th>Title</th>
                  <th>Document Type</th>
                  @if(Auth::user()->type!='admin')<th>Recent Status</th>@endif
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($documents as $document)
                <tr>
                  <td>{{ date ('d/M/Y', strtotime($document->created_at)) }}</td>
                  <td>{{ $document->documentcode }}</td>
                  <td>{{ $document->title }}</td>
                  <td>{{ $document->documenttype_id }}</td>
                  @if(Auth::user()->type!='admin')<td>{{ $document->status }}</td>@endif
                  <td>
                    <a href={{url("/document/$document->id/view")}} class="text-primary"  target="_blank">Details</a>
                    @if(Auth::user()->type!='admin' && $document->forwardedto==0) | 
                      <a href="#" class="text-danger" wire:click="delete({{ $document->id }})" >Cancel</a>
                    @elseif (Auth::user()->type!='admin' && $document->forwardedto>0)
                      <span class="text-secondary">[Submitted]</span>
                    @endif
                    @if(Auth::user()->type=='admin')| <a href="#" class="text-danger" wire:click.prevent="selectDocument({{$document->id}})" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >Process</a> @endif
                   
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $documents->links() }}
          </div>
        </div>
      </div>
    </div>
    @include('modal.adminaction')
</div>
