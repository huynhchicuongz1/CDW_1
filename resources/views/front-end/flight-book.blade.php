@extends('front-end.masterpage.master')
@section('content')
<main>
        <div class="container">
            <h2>Booking</h2>
            <div class="row">
                <div class="col-md-8">
                    <form role="form" action="{{ route('postBooking') }}" method="POST">
                    <input type="hidden" class="form-control" name="total" value="{{$total}}">
                    <input type="hidden" class="form-control" name="flight_depature" value="{{$_GET['flight_depature']}}">
                    <input type="hidden" class="form-control" name="flight_return" value="{{$_GET['flight_return']}}">
                    @csrf
                        <section>
                        <?php
                            if(Auth::check()){
                        ?>                      
                            <h3>1. Contact Information</h3>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                First Name:
                                            </label>
                                            <input type="text" id="firstName" value="{{ Auth::user()->name }}" class="form-control" disabled>
                                            <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}" name="lastName" >
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                Last Name:
                                            </label>
                                            <input type="text" id="lastName" value="{{ Auth::user()->name }}" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                Contact's Mobile phone number
                                            </label>
                                            <input type="tel" id="phone" value="{{ Auth::user()->user_phone }}" class="form-control" disabled>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                Contact's email address
                                            </label>
                                            <input type="email" id="email" name="user_email" value="{{ Auth::user()->email }}" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="text-right">
										<input type="button" id = "btn-clear" onclick="change()" class="btn btn-default" value="Clear all">
                                       <a href=""><button type="button" id = "btn-reset" class="btn btn-default">Reset</button></a> 
                                    </div>
                                </div>
                            </div>
                        <?php } 
                        else {
                        ?> 
                        
                        <h3> <?php if(isset($mess)){ echo $mess; } else { echo "Bạn chưa đăng nhập"; } ?></h3>
                        <div class="panel panel-default">
                                <div class="panel-body">
                                   
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="control-label">
                                                <a href="{{ route('login') }}">Đăng nhập</a> Hoặc <a href="{{ route('register') }}">Đăng ký</a>
                                            </label>
                                        </div>
                                     
                                    </div>

                                
                                </div>
                            </div>

                        <?php } ?>
                    
                        </section>
                        
                        <section>
                            <h3>2. Passenger(s) Details</h3>                     
                                @for($i = 0 ; $i <  $total ; $i++)                               
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
                                <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Passenger #{{$i+1}}</h4>
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <label class="control-label">Title:</label>
                                            <select class="form-control" name='passenger[{{$i}}][title]'>
                                                <option value="mr">Mr.</option>
                                                <option value="mrs">Mrs.</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <label class="control-label">First Name:</label>
                                            <input type="text" name='passenger[{{$i}}][first_name]' class="form-control" required>
                                        </div> 
                                        <div class="col-sm-6">
                                            <label class="control-label">Last Name:</label>
                                            <input type="text" name='passenger[{{$i}}][last_name]' class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @endfor
                        </section>
                        <section>
                       
                        <?php
                      
                        foreach ($flight_depature as $row) {
                         ?>
                            <h3>3.1 Price Details Depature</h3>
                            <div>
                                <h5>
                                    <strong class="airline">{{ $row->airways_name  }}</strong>
                                    <input type="hidden" class="form-control" name="airways_id_de" value="{{ $row->airways_id  }}">
                                    <p><span class="flight-class"><?php echo $flight_class ?></span></p>
                                </h5>
                                <!-- tính tiền ở đây nhé củ chuối -->
                                <?php 
                                                $fl_price = $row->flight_price;
                                                $date_now = date('Y-m-d');
                                                $day = (strtotime($fl_depature) - strtotime($date_now)) / (60 * 60 * 24);

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

                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="pull-left">
                                            <strong>Passengers Fare (x<?php echo $total ?>)</strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong name="total_price" > <?php echo number_format($fl_price) ?> VNĐ </strong>
                                        </div>
                                        <input type="hidden" class="form-control" name="fl_price" value="{{$fl_price * $total}}">
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="pull-left">
                                            <span>Tax</span>
                                        </div>
                                        <div class="pull-right">
                                            <span>Included</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="list-group-item list-group-item-info">
                                        <div class="pull-left">
                                            <strong>You Pay</strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong><?php echo number_format($fl_price * $total) ?> VNĐ </strong>
                                            <input type="hidden" class="form-control" name="total_price" value="{{$row->flight_price * $total}}">
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                </ul>

                            </div>
                            <?php } ?>

                        <!-- Giá của thằng thứ 2 -->
                    <?php if(count($flight_return) != 0) {
                        foreach ($flight_return as $row) {
                         ?>
                            <h3>3.2 Price Details Return</h3>
                            <div>
                                <h5>
                                    <strong class="airline">{{ $row->airways_name  }}</strong>
                                    <input type="hidden" class="form-control" name="airways_id_re" value="{{ $row->airways_id  }}">
                                    <p><span class="flight-class"><?php echo $flight_class ?></span></p>
                                </h5>
                                <!-- tính tiền ở đây nhé củ chuối -->
                                <?php 
                                                $fl_price_re = $row->flight_price;
                                                $date_now = date('Y-m-d');
                                                $day = (strtotime($fl_depature) - strtotime($date_now)) / (60 * 60 * 24);

                                                if($day >= 60) {
                                                    $fl_price_re = $fl_price_re - ($fl_price_re * 0.1);
                                                }
                                                else if ($day >= 30){
                                                    $fl_price_re = $fl_price_re - ($fl_price_re * 0.05);
                                                }
                                                else if ($day >= 14){
                                                    $fl_price_re = $fl_price_re + ($fl_price_re * 0.1);
                                                } else if ($day >= 7){
                                                    $fl_price_re = $fl_price_re + ($fl_price_re * 0.2);
                                                }
                                                else if ($day <= 1){
                                                    $fl_price_re = $fl_price_re + ($fl_price_re * 0.5);
                                                }

                                            ?>

                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="pull-left">
                                            <strong>Passengers Fare (x<?php echo $total ?>)</strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong name="total_price" > <?php echo number_format($fl_price_re) ?> VNĐ </strong>
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="pull-left">
                                            <span>Tax</span>
                                        </div>
                                        <div class="pull-right">
                                            <span>Included</span>
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                    <li class="list-group-item list-group-item-info">
                                        <div class="pull-left">
                                            <strong>You Pay</strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong><?php echo number_format($fl_price_re * $total) ?> VNĐ </strong>
                                            <input type="hidden" class="form-control" name="fl_price_re" value="{{$fl_price_re * $total}}">
                                        </div>
                                        <div class="clearfix"></div>
                                    </li>
                                </ul>

                            </div>
                            <?php } }?>


                        </section>
                        <section>
                            <h3>Payment</h3>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Payment Method:
                                        </label>
                                        <select class="form-control" name="payment" id="payment" onchange="displayCard()">
                                            <option value="transfer">Transfer</option>
                                            <option value="credit_card">Credit Card</option>
                                            <option value="paypal">Paypal</option>
                                        </select>
                                    </div>
                                 <div class="info_card" id="info_card">   
                                    <h4>Credit Card</h4>
                                    <div class="form-group">
                                        <label class="control-label">Card Number</label>
                                        <input type="number" name="card_number" class="form-control" placeholder="Digit card number">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10">
                                            <label class="control-label">Name on card:</label>
                                            <input type="text" name="card_name" class="form-control">
                                        </div>
                                        <div class="col-sm-2">
                                            <label class="control-label">CCV Code:</label>
                                            <input type="number" maxlength="3" name="ccv_code" class="form-control" placeholder="Digit CCV">
                                        </div>
                                    </div>
                                    </div>
                                </div> 
                            </div>
                        </section>
                        <section>
                            <div class="text-right">
                                <button type="submit" name="btn_submit" class="btn btn-primary">
                                    Continue to Booking
                                </button>
                            </div>
                        </section>
                    </form>
                </div>
            <?php foreach ($flight_depature as $row) { ?>
                <div class="col-md-4">
                    <h3>Flights Depature</h3>
                    <aside>
                    <?php 
                    // ngày đi                     
                        // cắt ngày giờ:
                        $date = $row->flight_time_from;
                        $d    = strtotime($date);
                        $date_to = $row->flight_time_to;
                        $d2    = strtotime($date_to);
                     ?>
                        <article>
                            <div>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5>
                                            <strong class="airline">{{ $row->airways_name  }}</strong>
                                            <p><span class="flight-class"><?php echo $flight_class ?></span></p>
                                        </h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div><big class="time"><?php echo date("h:i", $d); ?></big></div>
                                                        <div><small class="date">time from</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place"> {{ $data['get_city_from']->city_name . "(" . $data['get_city_from']->city_code . ")"  }}</span></div>
                                                        <div><small class="airport">
                                                        @if(isset($row->airport_city_from->airport_name))
                                                                        {{$row->airport_city_from->airport_name }}
                                                                    @else
                                                                        Airport
                                                                    @endif
                                                        </small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <i class="glyphicon glyphicon-arrow-down"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div><big class="time"><?php echo date("h:i", $d2); ?></big></div>
                                                        <div><small class="date">time to</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place">{{ $data['get_city_to']->city_name . "(" . $data['get_city_to']->city_code . ")" }}</span></div>
                                                        <div><small class="airport">
                                                        
                                                         @if(isset($row->airport_city_to->airport_name))
                                                                        {{$row->airport_city_to->airport_name }}
                                                                    @else
                                                                        Airport
                                                                    @endif
                                                        </small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>


                                    <!-- <li class="list-group-item list-group-item-warning">
                                        <ul>
                                            <li>Transit for 1h 30m in Doha (DOH)</li>
                                        </ul>
                                    </li> -->
                                  <!--   <li class="list-group-item">
                                        <h5>
                                            <strong class="airline">Qatar Airways QR-1052</strong>
                                            <p><span class="flight-class">Economy</span></p>
                                        </h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div><big class="time">00:50</big></div>
                                                        <div><small class="date">30 Apr 2017</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place">Doha (DOH)</span></div>
                                                        <div><small class="airport">Doha Hamad International Airport</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <i class="glyphicon glyphicon-arrow-down"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div><big class="time">02:55</big></div>
                                                        <div><small class="date">30 Apr 2017</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place">Abu Dhabi (AUH)</span></div>
                                                        <div><small class="airport">Abu Dhabi Intl</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li> -->
                                </ul>
                            </div>
                        </article>
                    </aside>
                </div>
            <?php } ?>


                <!-- Hiển thị thông tin chuyến bay chiều về -->
            <?php foreach ($flight_return as $row) { ?>
                <div class="col-md-4">
                    <h3>Flights Return</h3>
                    <aside>
                    <?php 
                    // ngày đi                     
                        // cắt ngày giờ:
                        $date = $row->flight_time_from;
                        $d    = strtotime($date);
                        $date_to = $row->flight_time_to;
                        $d2    = strtotime($date_to);
                         
                     ?>
                        <article>
                            <div>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5>
                                            <strong class="airline">{{ $row->airways_name  }}</strong>
                                            <p><span class="flight-class"><?php echo $flight_class ?></span></p>
                                        </h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div><big class="time"><?php echo date("h:i", $d); ?></big></div>
                                                        <div><small class="date">time from</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place"> {{ $data['get_city_from_re']->city_name . "(" . $data['get_city_from_re']->city_code . ")"  }} </span></div>
                                                        <div><small class="airport">{{ $row->airport_city_from->airport_name }}</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <i class="glyphicon glyphicon-arrow-down"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div><big class="time"><?php echo date("h:i", $d2); ?></big></div>
                                                        <div><small class="date">time to</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place"> {{ $data['get_city_to_re']->city_name . "(" . $data['get_city_to_re']->city_code . ")" }}</span></div>
                                                        <div><small class="airport"> {{ $row->airport_city_to->airport_name }}</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>


                                    <!-- <li class="list-group-item list-group-item-warning">
                                        <ul>
                                            <li>Transit for 1h 30m in Doha (DOH)</li>
                                        </ul>
                                    </li> -->
                                  <!--   <li class="list-group-item">
                                        <h5>
                                            <strong class="airline">Qatar Airways QR-1052</strong>
                                            <p><span class="flight-class">Economy</span></p>
                                        </h5>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div><big class="time">00:50</big></div>
                                                        <div><small class="date">30 Apr 2017</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place">Doha (DOH)</span></div>
                                                        <div><small class="airport">Doha Hamad International Airport</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <i class="glyphicon glyphicon-arrow-down"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div><big class="time">02:55</big></div>
                                                        <div><small class="date">30 Apr 2017</small></div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div><span class="place">Abu Dhabi (AUH)</span></div>
                                                        <div><small class="airport">Abu Dhabi Intl</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li> -->
                                </ul>
                            </div>
                        </article>
                    </aside>
                </div>
            <?php } ?>
             
            </div>
        </div>
        <br>
    </main>
 @endsection