@extends('front-end.masterpage.master')
@section('content')

<?php
    $total = $_GET['total'];
    $flight_class = $_GET['flight_class'];
    $time_from = $_GET['departure'];

 ?>

<!-- hiển thị thông báo lỗi -->
@if( count($errors) > 0)
	<div class="alert">
		<ul>
			@foreach($errors->all() as $error)
			    <li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
    <main> 
       <form role="form" method="get" action="{{ route('booking') }}">
       <input name="flight_class" type="hidden" value="{{ $flight_class }}">
       <input name="fl_depature" type="hidden" value="{{ $time_from }}">
       <input name="total" type="hidden" value="{{ $total }}">
     
       @if(count($flight_to)  == 0)
           <h2>Không tìm thấy chuyến bay nào </h2>
       @else
       <div class="container">
                <section>
                    <h2> {{ $data['get_city_from']->city_name . "(" . $data['get_city_from']->city_code . ")"  }}  <i class="glyphicon glyphicon-arrow-right"></i> 
                    {{ $data['get_city_to']->city_name . "(" . $data['get_city_to']->city_code . ")" }}</h2>
                @foreach($flight_to as $row)
                    <article>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4><strong><a href="flight-detail.html"> {{ $row->airways_name  }} </a></strong></h4>
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
                                                <div><span class="place"> {{ $row->city_from->city_name . " (" . $row->city_from->city_code . ")" }}    </span></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">To:</label>
                                                <div><big class="time"> <?php echo date("h:i", $d2);  ?> </big></div>

                                
                                                <div><span class="place">{{ $row->city_to->city_name . " (" . $row->city_to->city_code . ")" }}</span></div>
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
                                                <div><strong class="text-danger"> Transit</strong></div>
                                            </div>
                                            <div class="col-sm-3 text-right">
                                            <!-- tính giá tiền theo ngày đặt vé -->
                                            <?php 
                                                $fl_price = $row->flight_price;
                                                $date_now = date('Y-m-d');
                                                $day = (strtotime($time_from) - strtotime($date_now)) / (60 * 60 * 24);

                                                if($day >= 60) {
                                                    $fl_price = $fl_price - ($fl_price * 0.1);
                                                }
                                                else if ($day >= 30){
                                                    $fl_price = $fl_price - ($fl_price * 0.05);
                                                }
                                                else if ($day >= 14){
                                                    $fl_price = $fl_price + ($fl_price * 0.1);
                                                } else if ($day >= 7){
                                                    $fl_price = $fl_price + ($fl_price * 0.2);
                                                }
                                                else if ($day <= 1){
                                                    $fl_price = $fl_price + ($fl_price * 0.5);
                                                }

                                            ?>

                                                <h3 class="price text-danger"><strong><?php echo number_format($fl_price) ?> VNĐ</strong></h3>
                                                <input type="hidden" value="<?php echo number_format($fl_price) ?>" name = "fl_price">
                                                <div>
                                                <a href="{{ asset('flight-detail/'.$row->flight_id.'/'.$total.'/'.$flight_class.'/'.$time_from.'/'.$fl_price) }}" class="btn btn-link">See Detail</a>
                                                    <input id="rad_depature" name="flight_depature" value="{{ $row->flight_id }}"  type="radio" {{ old('flight_depature') == $row->flight_id ? 'checked' : ''}}  >
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <a href="" class="btn btn-primary">Choose</a> -->
                            <!-- {{ asset('flight-booking/'.$row->flight_id.'/'.$total.'/'.$flight_class.'/'.$time_from) }} -->
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
        @endif
    

    @if($flight_return != "")
        <?php if(count($flight_return)  == 0) { ?>
        <h2>Không tìm thấy chuyến bay khứ hồi</h2>
        <?php } else { ?>
            <div class="container">
                <section>
                <h2> {{ $data['get_city_from_re']->city_name . "(" . $data['get_city_from_re']->city_code . ")"  }}  <i class="glyphicon glyphicon-arrow-right"></i> 
                    {{ $data['get_city_to_re']->city_name . "(" . $data['get_city_to_re']->city_code . ")" }}</h2>
                @foreach($flight_return as $row)
                    <article>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4><strong><a href="flight-detail.html"> {{ $row->airways_name  }} </a></strong></h4>
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
                                                <div><span class="place"> {{ $data['get_city_from_re']->city_name . "(" . $data['get_city_from_re']->city_code . ")"  }}    </span></div>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="control-label">To:</label>
                                                <div><big class="time"> <?php echo date("h:i", $d2);  ?> </big></div>

                                
                                                <div><span class="place">{{ $data['get_city_from_re']->city_name . "(" . $data['get_city_from_re']->city_code . ")"  }}</span></div>
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
                                                <div><strong class="text-danger"> Transit</strong></div>
                                            </div>
                                                   <!-- tính giá tiền theo ngày đặt vé -->
                                            <?php 
                                                $fl_price = $row->flight_price;
                                                $date_now = date('Y-m-d');
                                                $date_re  = $_GET['return'];
                                                $day = (strtotime($date_re) - strtotime($date_now)) / (60 * 60 * 24);

                                                if($day >= 60) {
                                                    $fl_price = $fl_price - ($fl_price * 0.1);
                                                }
                                                else if ($day >= 30){
                                                    $fl_price = $fl_price - ($fl_price * 0.05);
                                                }
                                                else if ($day >= 14){
                                                    $fl_price = $fl_price + ($fl_price * 0.1);
                                                } else if ($day >= 7){
                                                    $fl_price = $fl_price + ($fl_price * 0.2);
                                                }
                                                else if ($day <= 1){
                                                    $fl_price = $fl_price + ($fl_price * 0.5);
                                                }

                                            ?>

                                            <div class="col-sm-3 text-right">
                                                <h3 class="price text-danger"><strong><?php echo number_format($fl_price)  ?>VNĐ</strong></h3>
                                                
                                                <div>
                                                <a href="{{ asset('flight-detail/'.$row->flight_id.'/'.$total.'/'.$flight_class.'/'.$time_from.'/'.$fl_price) }}" class="btn btn-link">See Detail</a>
                                                <!-- <a href="#" id="choose" onclick="BookFunction()" class="btn btn-primary">Choose</a> -->
                                                    <input id="rad_return" name="flight_return" value="{{ $row->flight_id }}" data-active = 1  type="radio" type="radio" {{ old('flight_return') == $row->flight_id ? 'checked' : ''}}>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <a href="" class="btn btn-primary">Choose</a> -->
                            <!-- {{ asset('flight-booking/'.$row->flight_id.'/'.$total.'/'.$flight_class.'/'.$time_from) }} -->
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

        <?php } ?>
        
    @else
        <input type="hidden" name="flight_return" value="0">
    @endif
   
    @if(count($flight_to)  != 0)
        <div class="btn-submit">
            <button type="submit" class="btn btn-primary"> Đặt vé </button>
        </div>
    @endif
  
 </form>
    </main>
  @endsection
