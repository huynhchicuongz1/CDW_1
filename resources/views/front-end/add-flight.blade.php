@extends('front-end.masterpage.master')
@section('content')
<main>
        <div class="container">
            <section>
                <h3>Add Flight</h3>              
                @if(isset($mess))
                    <p class="alert"> {{$mess}}  </p>
                @endif              
                <div class="panel panel-default">
                    <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form role="form" method="POST" action="{{ route('postFlight') }}" onsubmit="return validateForm_2();" >
                      @csrf
                            <div class="row">
                            <div class="col-sm-3">
                                    <h4 class="form-heading">1. Country</h4>
                                    <div class="form-group">
                                 
                                        <label class="control-label">Country From: </label>
										<select class="form-control" name="country_from" id="country_from">
                                        <!-- // trả về giá trị cũ của option -->
											<option>---Select Country--- </option>
                                            @foreach( $contry as $country )                                              
                                                @if (old('country_from') !=  "")                                          
                                                <option value="{{  $country->country_id }}" selected>{{  $country->country_name }}</option>
                                                @else
                                                    <option value="{{  $country->country_id }}">{{  $country->country_name }}</option>
                                                @endif
                                            @endforeach

										</select>                                       
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"> Country To: </label>
                                        <select class="form-control" name="country_to" id="country_to">
                                            <option>---Select Country--- </option>
                                            @foreach( $contry as $country )
                                            <option value="{{ $country->country_id }}" <?php echo (old("country_to") == $country->country_id ? "selected": ""); ?> >
                                                    {{ $country->country_name }}
                                                </option>
                                            @endforeach
										</select>       
                                    </div>
                                </div>
         
                                <div class="col-sm-3">
                                    <h4 class="form-heading">2. Flight Destination</h4>
                                    <div class="form-group">
                                        <label class="control-label">From: </label>
										<select class="form-control" name="from" id="from">
                                            <option>-- Select City --</option>
										</select>                                       
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">To: </label>
                                        <select class="form-control" name="to" id="to">
										    <option>-- Select City -- </option>
										</select>       
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Distance (Km): </label>
                                        <input  type="text" name="km" id="distance" class="form-control" placeholder="please enter distance (km)" >
										    
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                     <h4 class="form-heading">3. Airline</h4>
                                    <div class="form-group">
                                        <label class="control-label">Airline Name: </label>
                                        <select name="airline" id="airline" class="form-control">
                                            <option>---Chưa chọn Hãng Bay--- </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Transit: </label>
                                        <select name="transit" class="form-control">

                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                           
                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-3">
                                    <h4 class="form-heading">4. Date of Flight</h4>
                                    <div class="form-group">
                                        <label class="control-label">Departure: </label>
                                         <?php $date_now = date('Y-m-d\TH:i');
                                          ?>
                                        <input  type="datetime-local" name="departure" id="departure" value="<?php echo $date_now ?>" class="form-control"  class="datepicker">
                                    </div>
                            
                                    <div class="form-group" id="hide">
                                        <label class="control-label">Arrival date: </label>
                                        <input type="datetime-local" name="return" id="date_return" value="<?php echo $date_now?>" class="form-control">
                                    </div>
                                <div class="form-group">
                                        <button type="submit" name="btn_submit" class="btn btn-primary btn-block">Add Flights</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
</main>
@endsection