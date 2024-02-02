<div class="container" wire:poll.keep-alive>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center h4 text-secondary">Details</div>

                <div class="row m-2">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body bg-success text-white">
                                <h2>{{number_format($totalDocuments,0)}}</h2>
                                <p>Total Documents</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body bg-success text-white">
                                <h2>{{number_format($encoded,0)}}</h2>
                                <p>New Encoded Documents</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body bg-success text-white">
                                <h2>{{number_format($totalTerminated,0)}}</h2>
                                <p>Terminated Documents</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header text-center h4 text-secondary">Latest Econded Documents</div>

                <div class="row m-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-bod">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Document Date</th>
                                            <th>Document ID</th>
                                            <th>Title</th>
                                            <th>Type</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($latestDocuments as $document)
                                        <tr>
                                            <td>{{$document->created_at}}</td>
                                            <td>{{$document->documentcode}}</td>
                                            <td>{{$document->title}}</td>
                                            <td>{{$document->documenttype_id}}</td>
                                            
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
  
                </div>
            </div>
        </div>
    </div>
</div>
