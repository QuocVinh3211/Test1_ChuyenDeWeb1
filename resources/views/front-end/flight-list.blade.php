@extends('front-end.masterpage.master')
@section('content')

<?php
    $total = $_GET['total'];
    $flight_class = $_GET['flight_class'];
    $time_from = $_GET['departure'];
 ?>

    <main> 
       
       <div class="container">
                <section>
                    <h2> Danh sách các chuyến bay chiều về  <i class="glyphicon glyphicon-arrow-right"></i> </h2>
                @foreach($search as $row)
                    <article>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4><strong><a href="flight-detail.html"> {{ $row->airways_id }} </a></strong></h4>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <label class="control-label">From:</label>
                                                <?php
                                                    $date = $row->flight_time_from;
                                                    $d    = strtotime($date);
                                                    $date_to = $row->flight_time_to;
                                                    $d2    = strtotime($date_to);
                                                 ?>
                                                <div><big class="time"> <?php echo date("h:i", $d);  ?> </big></div>
                                                <div><span class="place"> <?php echo $row->flight_city_from  ?> </span></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">To:</label>
                                                <div><big class="time"> <?php echo date("h:i", $d2);  ?> </big></div>
                                                <div><span class="place"><?php echo $row->flight_city_to  ?></span></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">Duration:</label>
                                                <div><big class="time">
                                                <?php

                                                 $date1 = $row->flight_time_from;
                                                 $date2 = $row->flight_time_to;
                                                 $diff = abs(strtotime($date2) - strtotime($date1));
                                                 $years = floor($diff / (365*60*60*24));
                                                 $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                 $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24) / (60*60*24));
                                                 $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                                                 $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60) / 60);

                                                  echo $hours." h ".$minutes." m";
                                                 ?> 
                                                </big></div>
                                                <div><strong class="text-danger"><?php echo $row->flight_transit  ?> Transit</strong></div>
                                            </div>
                                            <div class="col-sm-3 text-right">
                                                <h3 class="price text-danger"><strong>IDR <?php echo $row->flight_price  ?></strong></h3>
                                                <div>
                                                <a href="{{ asset('flight-detail/'.$row->flight_id.'/'.$total.'/'.$flight_class.'/'.$time_from) }}" class="btn btn-link">See Detail</a>
                                                    <a href="" class="btn btn-primary">Choose</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
                    <div class="text-center">
                        <ul class="pagination">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">&lsaquo;</a></li>
                            <li class="active"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">&rsaquo;</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </section>
            </div>
           
    </main>
  @endsection