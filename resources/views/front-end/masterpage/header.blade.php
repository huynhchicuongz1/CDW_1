<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flights - Worldskills Travel</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/bootstrap/css/bootstrap.css')}}">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('/assets/style.css')}}">
    
    <style>
        .invalid-feedback {
            color: red;
        }
        .btn-submit {
            padding-left: 1150px ;
        }

        .info_card {
            display: none;
        }
        .alert {
            color: red;
        }
    </style>


<script type="text/javascript">

    // payment 
    function displayCard() {
    var x = document.getElementById("payment").value;
    if(x == "credit_card") {
        document.getElementById("info_card").style.display = "block";
    }
    else {
        document.getElementById("info_card").style.display = "none";
    }
    }


    function BookFunction1() {
    
    var checkbox =  document.getElementsByName("BlockInBound");
    for (var i = 0; i < checkbox.length; i++){
        if (checkbox[i].checked === true){
            document.getElementById("btn_choose").innerHTML = "Delay";
            document.getElementById("btn_choose").style.backgroundColor = "red";
            document.getElementById("choose").style.backgroundColor = "red";
        }
    }

    }


function change() {
    document.getElementById("firstName").value=""; 
    document.getElementById("lastName").value=""; 
    document.getElementById("phone").value=""; 
    document.getElementById("email").value=""; 
}

Date.prototype.today = function () { 
    return ((this.getDate() < 10)?"0":"") + this.getDate() +"-"+(((this.getMonth()+1) < 10)?"0":"") + (this.getMonth()+1) +"-"+ this.getFullYear();
}

// ẩn hiện 1 thẻ html
function myFunction() {
    
    document.getElementById("hide").style.display = "block";
    var newDate = new Date();
    var datetime = newDate.today();
    // lấy ngày hiện tại của hệ thống
    var fullDate = new Date() ;
    var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
    var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();

    document.getElementById("return").value = currentDate;
}
function myFunction1() {
    document.getElementById("hide").style.display = "none";
    document.getElementById("return").value = "";
}

</script>
   
</head>
<body>
<div class="wrapper">
    <header>
        <nav class="navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{ route('home') }}" class="navbar-brand">Worldskills Travel</a>
                </div>
                <div class="collapse navbar-collapse" id="main-navbar">
                    <ul class="nav navbar-nav navbar-right">
                         <!-- Authentication Links -->
                        
                         @guest
                        
                         <li><a href="">Welcom message</a></li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            
                        @else
                        <li><a href="{{ route('viewBook') }}">View My book</a></li>
                       
                            @if(Auth::user()->level == 1) 
                                <li><a href="{{ route('addFlight') }}">Add Flight</a></li>
                            
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Welcome {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                        <li><a href="{{ url('/') }}">Flights</a></li>
                        <li><a href="{{ route('listAirport') }}">Airports</a></li>
                        <li><a href="{{ route('listAirline') }}">Airline</a></li>
                      
                       <?php
                            if(Auth::check())
                            {                            
                        ?>
                            <li><a href="{{ url('getEdit') }}">Profile</a></li>
                            <?php } ?>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </header>