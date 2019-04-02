// validate
function validateForm_2() {
    //& validateTime()
        if (validateCity() & validateTime() & validateKm()) {
            return true;
        }
        else {
            return false;
        }
    }

function validateCity() {
        var form = $('#from').val();
        var to = $('#to').val();

        if(form == to)
        {
        alert("Điểm khởi hành phải khác điểm đến, xin chọn lại!");         
        return false;
        }
        else
        {
            return true;
        }          
}
    // validate số km
    function validateKm() {
        var distance = $('#distance').val();

        if((distance === ''))
        {
            alert("Khoảng cách không được để trống");         
            return false;
        }
        else if(isNaN(distance) == true)
        {
            alert("Nhập khoảng cách không hợp lệ, vui lòng nhập lại");         
            return false;
        }

        else if(distance <= 0) {
            alert("Nhập khoảng cách phải lớn hơn 0");         
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
