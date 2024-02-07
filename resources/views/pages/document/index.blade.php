@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white" >Document Title: {{ strtoupper($title) }} </div>
                  <?php $prev=""; $dat1="";$dat2="";$first=""; $last=""?>
                <div class="card-body">
                  <ul>
                    @foreach ($details as $detail)
                      <?php
                            if(strcmp($prev, "") == 0){
                                $dat1= $prev;
                                $dat2= $detail->created_at;
                                $first= $detail->created_at;
                            }
                            
                            else{
                                $dat1= $detail->created_at;
                                $dat2= $detail->created_at;
                               
                            }
      
                            $prev = $detail->created_at;
                            $last = $detail->created_at;

                        ?>

                        <?php 
                          $datetime1 = new DateTime($dat1);
                          $datetime2 = new DateTime($dat2);
                          $interval = $datetime1->diff($datetime2);
                          $days = $interval->format('%a');//now do whatever you like with $days
                        ?>

                      <li class="mb-2"><span class="text-secondary">[{{$detail->created_at}}] </span>{{ $detail->remarks}} </li>
                    @endforeach
                  </ul>
                <hr />
                <?php 
                  $datetime1 = new DateTime($first);
                  $datetime2 = new DateTime($last);
                  $interval = $datetime1->diff($datetime2);
                  $days = $interval->format('%a');//now do whatever you like with $days
                ?>
                <p>Document Processing Time: No. of Days: <strong>{{$days}} days</strong> | No. of Hours: <strong>{{ number_format($days*24,2) }} Hours </strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

