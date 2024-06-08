$(document).ready(function () {
    $('#country').change(function () {
        // Get the selected value
        var country = $(this).val();

        if (country === "Nepal"){
            // $('#province').empty();
            // $("#district").empty();
            // $('#village').empty();
            // $('#ward_no').empty();
            // $('#street_address').val("");

            $("#province").val(null);
            $("#district").val(null);
            $("#village").val(null);
            $("#ward_no").val(null);
            $('#street_address').val("");
            // $("#nepal_detail_info_show").show();
            $("#nepal_detail_info_show").removeClass('d-none');
        }
        else{
            // $('#province').empty();
            // $("#district").empty();
            // $('#village').empty();
            // $('#ward_no').empty();
            // $('#street_address').val("");
            $("#province").val(null);
            $("#district").val(null);
            $("#village").val(null);
            $("#ward_no").val(null);
            $('#street_address').val("");
            // $("#nepal_detail_info_show").hide();
            $("#nepal_detail_info_show").addClass('d-none');
        }
    });


    $('#province').on('change', function () {
        var province = $(this).val();
        var _token = $('input[name="_token"]').val();
        $('#district').empty();
        $('#village').empty();
        $('#ward_no').empty();
        $('#district').append('<option style="display:none" disabled selected value> Select District </option>');
        $('#village').append('<option style="display:none" disabled selected value> Select Village </option>');
        $('#ward_no').append('<option style="display:none" disabled selected value> Select Ward </option>');
        // $("#district").val(null);
        // $("#village").val(null);
        // $("#ward_no").val(null);
        if (province) {
            $.ajax({
                type: 'POST',
                url: get_district_url,
                data: {province: province, _token: _token},
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    $('#district').empty();
                    $('#district').append('<option style="display:none" disabled selected value> Select District </option>');
                    $.each(data, function (key, value) {
                        $('#district').append('<option value="' + value.District + '">' + value.District + '</option>');
                        // $('#district').append('<option value="' + value.id + '">' + value.District + '</option>');
                    });
                },  error: function (error) {
                    console.error('Error:', error);
                }
            });
        } else {
            $('#district').empty();
            $('#village').empty();
            $('#ward_no').empty();
            $('#district').append('<option style="display:none" disabled selected value> Select District </option>');
            $('#village').append('<option style="display:none" disabled selected value> Select Village </option>');
            $('#ward_no').append('<option style="display:none" disabled selected value> Select Ward </option>');
            // $("#district").val(null);
            // $("#village").val(null);
            // $("#ward_no").val(null);

        }
    });

    $('#district').on('change', function () {
        var district = $(this).val();
        var _token = $('input[name="_token"]').val();
        $('#village').empty();
        $('#ward_no').empty();
        $('#village').append('<option style="display:none" disabled selected value> Select Village </option>');
        $('#ward_no').append('<option style="display:none" disabled selected value> Select Ward </option>');
        // $("#village").val(null);
        // $("#ward_no").val(null);
        if (district) {
            $.ajax({
                type: 'POST',
                url: get_villages_url,
                data: {district: district, _token: _token},
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    $('#village').empty();
                    $('#village').append('<option style="display:none" disabled selected value> Select Village </option>');
                    $.each(data, function (key, value) {
                        $('#village').append('<option value="' + value.Village + '">' + value.Village + '</option>');
                        // $('#village').append('<option value="' + value.id + '">' + value.Village + '</option>');
                    });
                },  error: function (error) {
                    console.error('Error:', error);
                }
            });
        } else {
            $('#village').empty();
            $('#ward_no').empty();
            $('#village').append('<option style="display:none" disabled selected value> Select Village </option>');
            $('#ward_no').append('<option style="display:none" disabled selected value> Select Ward </option>');
            // $("#village").val(null);
            // $("#ward_no").val(null);
        }
    });
    
    $('#village').on('change', function () {
        var village = $(this).val();
        var _token = $('input[name="_token"]').val();
        $('#ward_no').empty();
        $('#ward_no').append('<option style="display:none" disabled selected value> Select Ward </option>');
        // $("#ward_no").val(null);
        if (village) {
            $.ajax({
                type: 'POST',
                url: get_wards_url,
                data: {village: village, _token: _token},
                dataType: 'json',
                success: function (data) {
                    $('#ward_no').empty();
                    $('#ward_no').append('<option style="display:none" disabled selected value> Select Ward </option>');
                    $.each(data, function (key, value) {
                        $('#ward_no').append('<option value="' + value.Ward + '">' + value.Ward + '</option>');
                        // $('#ward_no').append('<option value="' + value.id + '">' + value.Ward + '</option>');
                    });
                },  error: function (error) {
                    console.error('Error:', error);
                }
            });
        } else {
            $('#ward_no').empty();
            $('#ward_no').append('<option style="display:none" disabled selected value> Select Ward </option>');
            // $("#ward_no").val(null);
        }
    });

});