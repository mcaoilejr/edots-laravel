<!-- Modal -->
<div  wire:ignore.self class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Action</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <select class="form-select" wire:model="action">
              <option value="forward">Forward</option>
              <option value="receive">Receive</option>
              <option value="Terminated">Terminate</option>
            </select>
          </div>
        
          @if($action=='forward')
            <div class="col-md-12 mt-3">
              <select class="form-select" wire:model="office_id">
                @foreach ($offices as $office)
                  <option value={{$office->id}}>{{ $office->name }}</option>
                @endforeach
              </select>
            </div>
          @endif
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" wire:click.prevent="handleClick">Execute</button>
      </div>
    </div>
  </div>
</div>