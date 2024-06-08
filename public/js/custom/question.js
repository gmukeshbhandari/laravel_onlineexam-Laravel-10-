$('#faculty_list_for_question').on('change', function () {
    var faculty_id = $(this).val();
    var _token = $('input[name="_token"]').val();
    $('#subject_id').empty();
    $('#subject_id').append('<option style="display:none" disabled selected value> Select Subject </option>');
    // $("#subject_id").val(null);
    if (faculty_list_for_question) {
        $.ajax({
            type: 'POST',
            url: get_subject_url,
            data: {faculty_id: faculty_id, _token: _token},
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                $('#subject_id').empty();
                $('#subject_id').append('<option style="display:none" disabled selected value> Select Subject </option>');
                $.each(data, function (key, value) {
                    // $('#subject_id').append('<option value="' + value.id + '">' + value.Subject_Name + '</option>');
                    // $('#subject_id').append('<option data-subjectname="' + value.Subject_Name + '"  value="' + value.id + '">' + value.Subject_Name + '</option>');
                    $('#subject_id').append('<option value="' + value.id + '">' + value.Subject_Name + '</option>');
                });
            },  error: function (error) {
                console.error('Error:', error);
            }
        });
    } else {
        $('#subject_id').empty();
        $('#subject_id').append('<option style="display:none" disabled selected value> Select Subject </option>');
        // $("#subject_id").val(null);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // $('#add_question').on('submit', function (e) {
    //     e.preventDefault();
       
    //     this.submit(); 
    // });
});

