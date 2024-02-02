@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white" >Welcome {{ strtoupper(Auth::user()->name) }} !</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(Auth::user()->type=='user')
                        <livewire:receive-component />
                    @endif
                    @if(Auth::user()->type=='office')
                        <livewire:management-component />
                    @endif
                    @if(Auth::user()->type=='admin')
                        <livewire:receive-component />
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

