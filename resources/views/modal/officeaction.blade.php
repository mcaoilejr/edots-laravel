<!-- Modal -->
<div  wire:ignore.self class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Action</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        @if(session()->has('message'))
          <div class="alert alert-success">
            {{ session('message') }}
          </div>
        @endif
        
        @error('office_id')
            <div class="row mt-1 mb-1">
                <div class="col-md-12">
                  <div class="alert alert-danger">No office has been selected. Please select an office when forwarding a document.</div> 
                </div>
            </div>
        @enderror
        @if(!$isExecuted)
            <div class="row">
              <div class="col-md-12">
                <select class="form-select" wire:model="officeaction">
                  <option value="forward">Forward</option>
                  <option value="Terminated">Terminate</option>
                </select>               
              </div>           
              @if($officeaction=='forward')
                <div class="col-md-12 mt-3">
                  <select class="form-select" wire:model="office_id" required>
                    <option value="">Select</option>
                    @foreach ($offices as $office)
                      <option value={{$office->id}}>{{ $office->name }}</option>
                    @endforeach
                  </select>
                </div>
              @endif
              <div class="col-md-12 mt-3">
                <textarea class="form-control" wire:model="remarks" placeholder="Remarks"></textarea>
              </div>
            </div>
          </div>
        @endif
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            @if(!$isExecuted)
              <button type="button" class="btn btn-primary" wire:click.prevent="handleModalClick">Execute</button>
            @endif
          </div>
        
    </div>
  </div>
</div>