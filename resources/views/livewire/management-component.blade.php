<div>
    @if($action=='receive' || $action=='received')
        @include('components.receiveforwardcomponent')
        @include('modal.officeaction')
    @endif

    @if($action=='check')
        @include('components.documentslist')
    @endif
</div>
