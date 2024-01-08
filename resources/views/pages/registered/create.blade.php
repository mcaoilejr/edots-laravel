<div class="card mb-4">
  <div class="card-header">
    <h3 class="card-title">Add New Document</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-8">
        <div class="mb-3">
          <label for="title" class="form-label">Document Title</label>
          <input type="text" class="form-control" id="title" wire:model.lazy="title">
          <small class="small"></small>
        </div>
        <div class="mb-3">
          <label for="doctype" class="form-label">Document Type</label>
          <select name="" id="" class="form-select" wire:model="documenttype_id">
            @foreach ($doctypes as $doctype)
              <option value="{{ $doctype->name }}">{{ $doctype->name }}</option>
            @endforeach
          </select>
        </div>
        <button wire:click="store" class="btn btn-primary float-end">Submit</button>
      </div>
    </div>
  </div>
</div>