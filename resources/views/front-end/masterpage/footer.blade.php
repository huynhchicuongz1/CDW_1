<footer>
    <div class="container">
        <p class="text-center">
            Copyright &copy; 2017 | All Right Reserved
        </p>
    </div>
</footer>
</div>
<!--scripts-->
<script type="text/javascript" src=" {{ URL::asset('/assets/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('/assets/myfunction.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('/assets/myfunction-2.js')}}"></script>
<script>
    // ========= load thành phố theo nước
    $(document).ready(function() {


        // ======= Load sân bay theo tỉnh --- 
        $('#province').on('change', function() {
            var ID = $(this).val();
            if (ID) {
                $.ajax({
                    url: 'loadAirport/' + ID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('article').empty();
                            // $('#airport').focus;
                            $.each(data, function(key, value) {

                                $('article').append(
                                    ' <div class="panel panel-default">' +
                                    '<div class="panel-body">' +
                                    '<div class="row">' +
                                    '<div class="col-md-12">' +
                                    '<div class="row">' +
                                    '<div class="col-sm-3">' +
                                    '<label class="control-label">' + value.airport_name + '</label>' + '</div>' +
                                    ' <div class="col-sm-3">' +
                                    '<label class="control-label">' + value.airport_code + '</label>' + '</div>' +
                                    ' </div>' + '</div>' + ' </div>' + ' </div>' + ' </div>'

                                );
                            });
                        } else {
                            $('#airport').empty();
                        }
                    }
                });
            } else {
                $('#airport').empty();
            }
        });



        // ============== load thành phố
        $('#country_from').on('change', function() {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    url: 'findCityByCountry/' + countryID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        //console.log(data);
                        if (data) {
                            $('#from').empty();
                            $('#from').focus;
                            $.each(data, function(key, value) {
                                $('select[name="from"]').append('<option value="' + value.city_id + '">' + value.city_name + '</option>');
                            });
                        } else {
                            $('#from').empty();
                        }
                    }
                });
            } else {
                $('#city').empty();
            }
        });

        // load thành phố theo nước - 2
        $('#country_to').on('change', function() {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    url: 'findCityByCountry/' + countryID,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        //console.log(data);
                        if (data) {
                            $('#to').empty();
                            $('#to').focus;
                            $.each(data, function(key, value) {
                                $('select[name="to"]').append('<option value="' + value.city_id + '">' + value.city_name + '</option>');
                            });
                        } else {
                            $('#to').empty();
                        }
                    }
                });
            } else {
                $('#to').empty();
            }
        });

        // load hãng bay 
        $('#to').on('change', function() {
            var id_from = $('#country_from').val();
            var id_to = $('#country_to').val();
            if (id_from) {
                $.ajax({
                    url: 'findAirline/' + id_from + '/' + id_to,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        //console.log(data);
                        if (data) {
                            $('#airline').empty();
                            $('#airline').focus;
                            $.each(data, function(key, value) {
                                $('select[name="airline"]').append('<option value="' + value.airways_id + '">' + value.airways_name + '</option>');
                            });
                        } else {
                            $('#airline').empty();
                        }
                    }
                });
            } else {
                $('#airline').empty();
            }
        });

        // load hãng bay  2
        $('#from').on('change', function() {
            var id_from = $('#country_from').val();
            var id_to = $('#country_to').val();
            if (id_from) {
                $.ajax({
                    url: 'findAirline/' + id_from + '/' + id_to,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: function(data) {
                        //console.log(data);
                        if (data) {
                            $('#airline').empty();
                            $('#airline').focus;
                            $.each(data, function(key, value) {
                                $('select[name="airline"]').append('<option value="' + value.airways_id + '">' + value.airways_name + '</option>');
                            });
                        } else {
                            $('#airline').empty();
                        }
                    }
                });
            } else {
                $('#airline').empty();
            }
        });

    });
</script>
</body>

</html> 