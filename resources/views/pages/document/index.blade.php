@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white" >Document Title: {{ strtoupper($title) }} </div>

                <div class="card-body">
                  <ul>
                    @foreach ($details as $detail)
                      <li>[{{$detail->created_at}}] {{ $detail->remarks}}</li>
                    @endforeach
                  </ul>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

