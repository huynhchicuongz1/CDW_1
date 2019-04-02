// function changeCity(){
//     var from_city_id = document.getElementById("from").value;
//     var from_to_id   = document.getElementById("to").value

//     alert(from_city_id);
// }


function XacNhanXoa(msg)
{
	if(window.confirm(msg))
	{
		return true;
	}
	return false;
}

// validate
function validateForm() {
    //& validateTime()
        if (validateCity() & validateTime() & validatePerson()) {
            return true;
        }
        else {
            return false;
        }
    } 

    // total person
    function validatePerson() {
        var person = $('#total').val();
        if(isNaN(person) == true)
        {
            alert("số người không hợp lệ!");         
            return false;
        }
        else
        {
            return true;
        }          
    }

    // validay city
function validateCity() {
        var form = $('#from').val();
        var to = $('#to').val();
        if(form == to)
        {
            alert("ádasdải khác điểm đến, xin chọn lại!");         
        return false;
        }
        else
        {
            return true;
        }          
}
//departure
function validateTime() {
    var time_departure = $('#departure').val();
    var time_return    = $('#return').val();
    var addR           = $('#date_return').val();
    
    // lấy ngày hiện tại của hệ thống
    var fullDate = new Date() ;
    var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
    var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();

    // so sánh
    if(new Date(time_departure) < new Date(currentDate))
    {
        alert("Ngày khởi hành phải lớn hơn hoặc bằng ngày hiện tại, xin chọn lại!");           
        return false;
    }
    else if(new Date(time_return) < new Date(time_departure))
    {
        alert("Ngày khứ hồi phải lớn hơn hoặc bằng ngày đi, xin chọn lại!");           
        return false;
    }
    else if(new Date(addR) < new Date(time_departure))
    {
        alert("Ngày đến phải lớn hơn hoặc bằng ngày đi, xin chọn lại!");           
        return false;
    }
    else
    {                            
        return true;
    }          
}


// chọn 2 vé
function BookFunction() {
    
    var x = document.getElementById("choose").value;
    
    var y = $( "input" ).data("flightID");
    var active = $( "input" ).data("active");


    if(x == "Choose")
    {
        document.getElementById("choose").innerHTML = "Delay";
        document.getElementById("choose").style.backgroundColor = "red";
        y = 1;
    }
    else {
        document.getElementById("choose").innerHTML = "Choose";
        document.getElementById("choose").style.backgroundColor = "#337ab7";
    }
    
}


// payment 
function payment() {
    var x = document.getElementById("payment").value;
    if(x == "credit_card"){
        document.getElementById("info_card").style.display = "block";
    }
    else {
        document.getElementById("info_card").style.display = "none";
    }
}