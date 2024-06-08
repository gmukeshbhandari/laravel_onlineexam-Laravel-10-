function getCheckboxValues_subjects_search() {
    Swal.fire({
        title: 'Are you sure?',
        text: "Delete all selected subjects? This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete them!'
    }).then((result) => {
        if (result.isConfirmed) {
            // If user clicks "Yes", call the actual function
            mass_delete_subjects_search();
        } else {
            // If user clicks "Cancel" or closes the dialog, do nothing
            // You can add additional behavior here if needed
        }
    });
}

function mass_delete_subjects_search() {
    let checkboxes = document.querySelectorAll('#search_subjects_results input[type=checkbox]');
    // let perPage = document.querySelector('input[name="per_page"]').value;
    // let page = document.querySelector('input[name="page"]').value;
   // console.log(checkboxes);
    let allUnchecked = true;
    checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
            allUnchecked = false;
            return; // Break the loop if at least one checkbox is checked
        }
    });

    if (allUnchecked) {
        return; //if all box are unchecked then stop and do not go to ajax function
    }

    let values = {};
    checkboxes.forEach(function (checkbox) {
        values[checkbox.name] = checkbox.checked;
    });

  //  console.log('Checkbox Values:', values);
    $.ajax({
        type: 'POST',
        url: mass_manage_subject,
        // dataType: 'json',
        data: {
            ticked_subjects_list: values
        },
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        success: function (result) {
            if (result.message === 'successful') {
                let not_deleted_subject_name = result.not_deleted_subject_name;
                let deleted_subject_name = result.deleted_subject_name;

                if (not_deleted_subject_name.length > 0)
                {
                    //let textToShow = 'Some Subject were not deleted which include: ' + not_deleted_subject_name;
                    let textToShow = 'Following subjects were not deleted which include:  <br>';
                    not_deleted_subject_name.forEach(function(subject, index){
                        textToShow += (index + 1) + ') ' + subject + '<br>';
                    });
                    $("#original_subjects_table").load(location.href + "#original_subjects_table",function(){
                        subject_event();
                         // Trigger the input event on #search_subjects
                        $('#search_subjects').trigger('input');
                    });
                    Swal.fire({
                        title: "Error!",
                        html: textToShow,
                        icon: "error"
                    });
                }
                else
                {
                    //$("#listofsubjectsadded").load(location.href + "#listofsubjectsadded");
                    // let textToShow = 'Deleted Subject are ' + deleted_subject_name;
                    let textToShow = 'Deleted Subjects are <br>';
                    deleted_subject_name.forEach(function(subject, index) {
                        textToShow += (index + 1) + ') ' + subject + '<br>';
                    });
                    $("#original_subjects_table").load(location.href + "#original_subjects_table",function(){
                        subject_event();
                         // Trigger the input event on #search_subjects
                        $('#search_subjects').trigger('input');
                    });
                    Swal.fire({
                        title: "Subjects are deleted!.",
                        html: textToShow,
                        icon: "success"
                    });
                }
            }
        },
        error: function (error) {
            console.error('Error processing checkboxes:', error);
        }
    });
}



function getCheckboxValues_subjects() {
    Swal.fire({
        title: 'Are you sure?',
        text: "Delete all selected subjects? This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete them!'
    }).then((result) => {
        if (result.isConfirmed) {
            // If user clicks "Yes", call the actual function
            mass_delete_subjects();
        } else {
            // If user clicks "Cancel" or closes the dialog, do nothing
            // You can add additional behavior here if needed
        }
    });
}


function mass_delete_subjects() {
    let checkboxes = document.querySelectorAll('input[type=checkbox]');
    // let perPage = document.querySelector('input[name="per_page"]').value;
    // let page = document.querySelector('input[name="page"]').value;
    // console.log(checkboxes);
    let allUnchecked = true;

    checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
            allUnchecked = false;
            return; // Break the loop if at least one checkbox is checked
        }
    });

    if (allUnchecked) {
        return; //if all box are unchecked then stop and do not go to ajax function
    }

    let values = {};
    checkboxes.forEach(function (checkbox) {
        values[checkbox.name] = checkbox.checked;
    });

    // console.log('Checkbox Values:', values);
    $.ajax({
        type: 'POST',
        url: mass_manage_subject,
        // dataType: 'json',
        data: {
            ticked_subjects_list: values
        },
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        success: function (result) {
            if (result.message === 'successful') {
                let not_deleted_subject_name = result.not_deleted_subject_name;
                let deleted_subject_name = result.deleted_subject_name;

                if (not_deleted_subject_name.length > 0)
                {
                    // let textToShow = 'Some Subject were not deleted which include: ' + not_deleted_subject_name;
                    let textToShow = 'Following subjects were not deleted which include:  <br>';
                    not_deleted_subject_name.forEach(function(subject, index){
                        textToShow += (index + 1) + ') ' + subject + '<br>';
                    });
                    $("#original_subjects_table").load(location.href + "#original_subjects_table",function(){
                        subject_event();
                         // Trigger the input event on #search_subjects
                        $('#search_subjects').trigger('input');
                    });
                    Swal.fire({
                        title: "Error!",
                        html: textToShow,
                        icon: "error"
                    });
                }
                else
                {
                    // $("#listofsubjectsadded").load(location.href + "#listofsubjectsadded");
                    //let textToShow = 'Deleted Subject are ' + deleted_subject_name;
                    let textToShow = 'Deleted Subjects are <br>';
                    deleted_subject_name.forEach(function(subject, index) {
                        textToShow += (index + 1) + ') ' + subject + '<br>';
                    });
                    $("#original_subjects_table").load(location.href + "#original_subjects_table",function(){
                        subject_event();
                         // Trigger the input event on #search_subjects
                        $('#search_subjects').trigger('input');
                    });
                    Swal.fire({
                        title: "Subjects are deleted!.",
                        html: textToShow,
                        icon: "success"
                    });
                }
            }
        },
        error: function (error) {
            console.error('Error processing checkboxes:', error);
        }
    });
}


function subject_event()
    {
            $('#search_subjects').on('input', function() {
                let query = $(this).val().trim();
                //let query = $('#search_subjects').val().trim();
                // console.log('Query = ' + query);
                // console.log('Query Length = ' + query.length);
                if (query.length >= 3) {
                    fetchSearchResults(query)
                }
                else {
                    $('#search_subjects_results').empty(); // Clear search results if query is too short
                    $('#search_subjects_results').addClass('d-none');
                    $('#original_subjects_table').removeClass('d-none'); // Hide original table
                    // $('#original_subject_table_per_page').removeClass('d-none');
                    // $('#original_subject_table_next_previous').removeClass('d-none');
                }
            });
    }


function fetchSearchResults(query) {
    $.ajax({
        url: admin_manage_subject,
        type: 'GET',
        data: {
            search_subjects: query
        },
        success: function(response)
        {
            $('#original_subjects_table').addClass('d-none'); // Hide original table
            // $('#original_subject_table_per_page').addClass('d-none');
            // $('#original_subject_table_next_previous').addClass('d-none');
            $('#search_subjects_results').html(response);
            $('#search_subjects_results').removeClass('d-none');
            setupEventListeners_old_subjects();
        },
        error: function(xhr)
        {
            $('#search_subjects_results').empty(); // Clear search results if query is too short
            $('#search_subjects_results').addClass('d-none');
            $('#original_subjects_table').removeClass('d-none'); // Hide original table
            // $('#original_subject_table_per_page').removeClass('d-none');
            // $('#original_subject_table_next_previous').removeClass('d-none');
            console.log(xhr.responseText);
        }
    });
}


    //Show Old Subject Names
    function showOldSubjectNames(divId) {
        const divContent = document.getElementById(divId).innerHTML;

        Swal.fire({
            html: divContent,
            showCloseButton: true,
            focusConfirm: false,
        });
    }

    // Add event listeners for each anchor tag

    function setupEventListeners_old_subjects() {
        const anchor_tags_old_subject_names = document.querySelectorAll('.show_old_subjects');
        anchor_tags_old_subject_names.forEach(function(anchor) {
            anchor.addEventListener('click', function(event) {
                event.preventDefault();
                const divId = this.getAttribute('data-target');
                showOldSubjectNames(divId);
            });
        });
    }

    function reloadTableAndSetupListeners() {
        $.ajax({
            url: admin_manage_subject,
            type: 'GET',
            success: function(response) {
               console.log(response);
               let updatedTableHtml = $(response).find('table.table.table-hover.caption-top').html();
               if (updatedTableHtml) {
                $('#original_subjects_table').html(updatedTableHtml);
                   setupEventListeners_old_subjects();
                   $('#search_subjects').trigger('input');
               } else {
                   console.error("Failed to update table content: Table HTML not found in the response.");
               }
                // console.log(updatedTableHtml);
                // $('#original_subjects_table').html(updatedTableHtml);
                // setupEventListeners_old_subjects();
                // $('#search_subjects').trigger('input');
                // Update pagination information
                //$('#original_subject_table_next_previous').html($(response).find('#original_subject_table_next_previous').html());
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }



document.addEventListener('DOMContentLoaded', function() {
    subject_event();
    setupEventListeners_old_subjects();

    document.querySelectorAll('.manage-question-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            // Get the associated subject_id from the button's data attribute
            const subjectId = this.getAttribute('data-subject-id');

            // Find the form associated with this button
            const form = document.getElementById('form_' + subjectId);
            // Submit the form
            form.submit();
        });
    });

    document.querySelectorAll('.manage-question-search-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            // Get the associated subject_id from the button's data attribute
            const subjectId = this.getAttribute('data-search-subject-id');

            // Find the form associated with this button
            const form = document.getElementById('form_search' + subjectId);
            // Submit the form
            form.submit();
        });
    });


    $('#add_subject').on('submit', function (e) {
        e.preventDefault();

        $('#faculty_selection_error').addClass('text-danger');
        $('#subject_name_error').addClass('text-danger');
        $('#full_marks_error').addClass('text-danger');
        $('#exam_duration_error').addClass('text-danger');
        $('#pass_marks_error').addClass('text-danger');
        $('#final_error').removeClass('text-success');

        $('#final_error').removeClass('is-valid border border-success border-2');

        $('#faculty_list').removeClass('is-invalid');
        $('#subject_name').removeClass('is-invalid');
        $('#full_marks').removeClass('is-invalid');
        $('#exam_duration').removeClass('is-invalid');
        $('#pass_marks').removeClass('is-invalid');

        $("#faculty_selection_error").text('');
        $("#subject_name_error").text('');
        $("#full_marks_error").text('');
        $("#exam_duration_error").text('');
        $("#pass_marks_error").text('');
        $("#final_error").text('');

        let faculty_id = $('#faculty_list').val();
        let subject_name =  $('#subject_name').val().trim();
        let full_marks =  $('#full_marks').val();
        let exam_duration =  $('#exam_duration').val();
        let pass_marks =  $('#pass_marks').val();
        let _token = $('input[name="_token"]').val();
        // let per_page =  $('#per_page').val();
        // let page =  $('#page').val();
        $.ajax({
                type: 'POST',
                url: add_subject_route,
                data: {_token:_token,faculty_id:faculty_id,subject_name:subject_name,full_marks:full_marks,exam_duration:exam_duration,pass_marks:pass_marks},
                dataType: 'json',
                success: function(result)
                {
                    if (result.msg === "Subject Added Successfully.")
                    {
                        $('#final_error').addClass('is-valid border border-success border-2');
                        $('#subject_name').addClass('is-valid border border-success border-2');
                        $('#faculty_list').addClass('is-valid border border-success border-2');
                        if (full_marks) {
                            $('#full_marks').addClass('is-valid border border-success border-2');
                        }
                        if (pass_marks) {
                            $('#pass_marks').addClass('is-valid border border-success border-2');
                        }
                        if (exam_duration) {
                            $('#exam_duration').addClass('is-valid border border-success border-2');
                        }
                        $('#faculty_selection_error').removeClass('text-danger');
                        $('#subject_name_error').removeClass('text-danger');
                        $('#full_marks_error').removeClass('text-danger');
                        $('#exam_duration_error').removeClass('text-danger');
                        $('#pass_marks_error').removeClass('text-danger');

                        $('#final_error').addClass('text-success');
                        $('#final_error').text(result.msg);

                        if(result.subject_count === "Greater than 0")
                        {
                            $('#original_subjects_table').html($(result).find('#original_subjects_table').html());
                            $('#search_subjects').trigger('input');
                        }
                        if(result.subject_count === "Equals to 0")
                        {
                            location.reload();
                        }
                        // setTimeout(function() {
                        //     $('#final_error').removeClass('is-valid border border-success border-2');
                        //     $('#final_error').removeClass('text-success');
                        //     $('#subject_name').removeClass('is-valid border border-success border-2');
                        //     $('#faculty_list').removeClass('is-valid border border-success border-2');
                        //     if (full_marks) {
                        //         $('#full_marks').removeClass('is-valid border border-success border-2');
                        //     }
                        //     if (pass_marks) {
                        //         $('#pass_marks').removeClass('is-valid border border-success border-2');
                        //     }
                        //     if (exam_duration) {
                        //         $('#exam_duration').removeClass('is-valid border border-success border-2');
                        //     }
                        //     $("#final_error").text('');
                        //     $("#faculty_list").val(null);
                        //     $('#subject_name').val('');
                        //     $('#full_marks').val('');
                        //     $('#pass_marks').val('');
                        //     $('#exam_duration').val('');

                        //     }, 3000);

                            $('#final_error').removeClass('is-valid border border-success border-2');
                            $('#final_error').removeClass('text-success');
                            $('#subject_name').removeClass('is-valid border border-success border-2');
                            $('#faculty_list').removeClass('is-valid border border-success border-2');
                            if (full_marks) {
                                $('#full_marks').removeClass('is-valid border border-success border-2');
                            }
                            if (pass_marks) {
                                $('#pass_marks').removeClass('is-valid border border-success border-2');
                            }
                            if (exam_duration) {
                                $('#exam_duration').removeClass('is-valid border border-success border-2');
                            }
                            $("#final_error").text('');
                            $("#faculty_list").val(null);
                            $('#subject_name').val('');
                            $('#full_marks').val('');
                            $('#pass_marks').val('');
                            $('#exam_duration').val('');

                        Swal.fire({
                            title: "Subject added successfully.",
                            text: "",
                            icon: "success"
                        });

                    }
                    if(result.msg === "Something went wrong.")
                    {
                        $('#subject_name').addClass('is-invalid');
                        $('#subject_name_error').addClass('text-danger');
                        $('#subject_name_error').text(result.msg);
                    }
                },
                error: function(error)
                {
                    if (error.responseJSON && error.responseJSON.errors)
                    {

                        let errors = error.responseJSON.errors;
                        // console.log(errors)
                        if (errors.hasOwnProperty('faculty_id'))
                        {
                            $('#faculty_list').addClass('is-invalid');
                            $("#faculty_selection_error").empty();
                            $.each(errors['faculty_id'], function(index, errorMessage) {
                            $("#faculty_selection_error").append('<div>' + errorMessage + '</div>');
                            });
                        }

                        if (errors.hasOwnProperty('subject_name'))
                        {
                            $('#subject_name').addClass('is-invalid');
                            $("#subject_name_error").empty();
                            $.each(errors['subject_name'], function(index, errorMessage) {
                            $("#subject_name_error").append('<div>' + errorMessage + '</div>');
                            });
                        }

                        if (errors.hasOwnProperty('full_marks'))
                        {
                            $('#full_marks').addClass('is-invalid');
                            $("#full_marks_error").empty();
                            $.each(errors['full_marks'], function(index, errorMessage) {
                            $("#full_marks_error").append('<div>' + errorMessage + '</div>');
                            });
                        }

                        if (errors.hasOwnProperty('exam_duration'))
                        {
                            $('#exam_duration').addClass('is-invalid');
                            $("#exam_duration_error").empty();
                            $.each(errors['exam_duration'], function(index, errorMessage) {
                            $("#exam_duration_error").append('<div>' + errorMessage + '</div>');
                            });
                        }

                        if (errors.hasOwnProperty('pass_marks'))
                        {
                            $('#pass_marks').addClass('is-invalid');
                            $("#pass_marks_error").empty();
                            $.each(errors['pass_marks'], function(index, errorMessage) {
                            $("#pass_marks_error").append('<div>' + errorMessage + '</div>');
                            });
                        }

                    }
                }
        });
    });

    $(document).on('click', '.edit_subject', function(e) {
        e.preventDefault();
        e.stopPropagation();


        let url_edit = $(this).attr('href');
        let faculty_id = $(this).data('facultyid');
        let faculty_name = $(this).data('facultyname');
        let subject_name = $(this).data('name');
        let _token =  document.head.querySelector('meta[name="csrf-token"]').content;

        Swal.fire({
            title: 'Update Subject Name of ' + subject_name + '<br>(under faculty ' + faculty_name + ')',
            input: 'text',
            inputValue: subject_name,
            showCancelButton: true,
            confirmButtonText: 'Update',
            showLoaderOnConfirm: true,
            inputAttributes: {
                maxlength: 100,
                required:true
            },
            preConfirm: (new_subject_name) => {
                // Send AJAX request to update faculty name
                return $.ajax({
                    url: url_edit,
                    type: 'POST',
                    data: {
                        _token: _token,
                        new_subject_name: new_subject_name,
                        old_subject_name: subject_name,
                        faculty_id: faculty_id
                    },
                    success: function(response){

                        if(response.message === "successful")
                        {
                            if(response.subject_count === "Greater than 0")
                            {
                              //  $("#listofsubjectsadded").load(location.href + " #listofsubjectsadded");

                            //   $("#original_subjects_table").load(location.href + "#original_subjects_table",function(){
                            //     subject_event();
                            //     setupEventListeners_old_subjects();
                            //      // Trigger the input event on #search_subjects
                            //     $('#search_subjects').trigger('input');
                            // });

                       // $('#original_subjects_table').html($(response).find('#original_subjects_table').html());
                           // $('#original_subjects_table').html(response);
                        //    console.log('a');

                           $('#search_subjects').trigger('input');

                            }
                            if(response.subject_count === "Equals to 0")
                            {
                               // $("#listofsubjectsadded").load(location.href + " #listofsubjectsadded");
                                location.reload();
                                // $("#original_subjects_table").load(location.href + "#original_subjects_table",function(){
                                //     subject_event();
                                //     setupEventListeners_old_subjects();
                                //      // Trigger the input event on #search_subjects
                                //     $('#search_subjects').trigger('input');
                                // });
                            }
                            Swal.fire({
                                title: "Updated!",
                                text: "Subject name updated successfully.",
                                icon: "success"
                            });
                        }
                        else if(response.message === "Something went wrong.")
                        {
                          // $("#listofsubjectsadded").load(location.href + " #listofsubjectsadded");
                        //    $("#original_subjects_table").load(location.href + "#original_subjects_table",function(){
                        //     subject_event();
                        //     setupEventListeners_old_subjects();
                        //      // Trigger the input event on #search_subjects
                        //     $('#search_subjects').trigger('input');
                        // });
                        $('#original_subjects_table').html($(result).find('#original_subjects_table').html());
                        $('#search_subjects').trigger('input');

                            Swal.fire({
                                title: "Error!",
                                text: "An error occurred while updating the subject name",
                                icon: "error"
                            });
                        }
                        else if(response.message === "subject_not_found")
                        {
                           //$("#listofsubjectsadded").load(location.href + " #listofsubjectsadded");
                        //    $("#original_subjects_table").load(location.href + "#original_subjects_table",function(){
                        //     subject_event();
                        //     setupEventListeners_old_subjects();
                        //      // Trigger the input event on #search_subjects
                        //     $('#search_subjects').trigger('input');
                        // });
                        $('#original_subjects_table').html($(result).find('#original_subjects_table').html());
                        $('#search_subjects').trigger('input');

                            Swal.fire({
                                title: "Error!",
                                text: "Subject not found",
                                icon: "error"
                            });
                        }
                    },
                    error: function(xhr, status, error){

                        // if (error.status === 422)
                        // {
                        //     errors = error.responseJSON.errors;
                        //     if (errors.hasOwnProperty('new_subject_name'))
                        //     {
                        //         Swal.fire('Error', errors['new_subject_name'], 'error');
                        //     }
                        // }

                          //console.log(xhr.responseText);
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            let errorMessage = Object.values(xhr.responseJSON.errors.new_subject_name).join('<br>');
                           // Swal.fire('Error', errorMessage, 'error');
                            Swal.showValidationMessage(errorMessage);
                        }  else {
                            let errorMessage = 'Failed to update subject name.';
                            Swal.showValidationMessage(errorMessage);
                        }
                    }
                }).catch(error => {
                     //console.log(error);
                });
            }
        });
        });



    $(document).on('click', '.delete_subject', function(e) {
        e.preventDefault();
        e.stopPropagation();

        // var link = $(this);
        let url = $(this).attr('href');
        let subject_name = $(this).data('name');

          Swal.fire({
              title: "Delete " + subject_name + "\nAre you sure?",
              text: "You will not be able to recover this action!",
              icon: "warning",
              showCancelButton: true,
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes, delete it!",
          }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                      url: url,
                      type: 'get',
                      // data: {_token: csrf_token},
                      // dataType: 'json',
                      success: function(result) {

                        $('#final_error').removeClass('is-valid border border-success border-2');
                        $('#subject_name').removeClass('is-valid border border-success border-2');
                        $('#faculty_list').removeClass('is-valid border border-success border-2');
                        $('#faculty_list').removeClass('is-invalid');
                        $('#subject_name').removeClass('is-invalid');
                        $('#full_marks').removeClass('is-invalid');
                        $('#exam_duration').removeClass('is-invalid');
                        $('#pass_marks').removeClass('is-invalid');

                        $("#faculty_selection_error").text('');
                        $("#subject_name_error").text('');
                        $("#full_marks_error").text('');
                        $("#exam_duration_error").text('');
                        $("#pass_marks_error").text('');
                        $("#final_error").text('');

                        $("#final_error").text('');
                        $("#faculty_list").val(null);
                        $('#subject_name').val('');
                        $('#full_marks').val('');
                        $('#pass_marks').val('');
                        $('#exam_duration').val('');

                        $('#subject_name').removeClass('is-invalid');
                        $('#subject_name').removeClass('is-valid border border-success border-2');
                        $('#subject_name_error').removeClass('text-danger');
                        $("#subject_name_error").empty();
                        $('#subject_name').val('');
                          if(result.message === "successful")
                          {
                              // $("#listofsubjectsadded").load(location.href + "#listofsubjectsadded");
                              // Swal.fire({
                              //     title: "Deleted!",
                              //     text: "Subject has been deleted.",
                              //     icon: "success"
                              // })
                              if(result.subject_count === "Greater than 0")
                              {
                            $('#original_subjects_table').html($(result).find('#original_subjects_table').html());
                            $('#search_subjects').trigger('input');
                                //reloadTableAndSetupListeners();

                                  //$("#listofsubjectsadded").load(location.href + "#listofsubjectsadded");
                                //   $("#original_subjects_table").load(location.href + "#original_subjects_table",function(){

                                //     setupEventListeners_old_subjects();
                                //      // Trigger the input event on #search_subjects
                                //     $('#search_subjects').trigger('input');
                                // });

                              }
                              if(result.subject_count === "Equals to 0")
                              {
                                  location.reload();
                                 //$("#listofsubjectsadded").load(location.href + "#listofsubjectsadded");
                                //   $("#original_subjects_table").load(location.href + "#original_subjects_table",function(){
                                //     subject_event();
                                //      // Trigger the input event on #search_subjects
                                //     $('#search_subjects').trigger('input');
                                // });
                              }
                              Swal.fire({
                                  title: "Deleted!",
                                  text: "Subject has been deleted.",
                                  icon: "success"
                              })
                          }
                          else if(result.message === "Something went wrong.")
                          {
                            //$("#listofsubjectsadded").load(location.href + " #listofsubjectsadded");
                            $("#original_subjects_table").load(location.href + "#original_subjects_table",function(){

                                setupEventListeners_old_subjects();
                                 // Trigger the input event on #search_subjects
                                $('#search_subjects').trigger('input');
                            });
                              Swal.fire({
                                  title: "Error!",
                                  text: "An error occurred while deleting the subject.",
                                  icon: "error"
                              });
                          }
                          else if(result.message === "subject_not_found")
                          {
                           // $("#listofsubjectsadded").load(location.href + " #listofsubjectsadded");
                            $("#original_subjects_table").load(location.href + "#original_subjects_table",function(){

                                setupEventListeners_old_subjects();
                                 // Trigger the input event on #search_subjects
                                $('#search_subjects').trigger('input');
                            });

                              Swal.fire({
                                  title: "Error!",
                                  text: "Subject not found",
                                  icon: "error"
                              });
                          }
                          // link.remove();
                      },
                      error: function(xhr, status, error) {
                        $('#final_error').removeClass('is-valid border border-success border-2');
                        $('#subject_name').removeClass('is-valid border border-success border-2');
                        $('#faculty_list').removeClass('is-valid border border-success border-2');
                        $('#faculty_list').removeClass('is-invalid');
                        $('#subject_name').removeClass('is-invalid');
                        $('#full_marks').removeClass('is-invalid');
                        $('#exam_duration').removeClass('is-invalid');
                        $('#pass_marks').removeClass('is-invalid');

                        $("#faculty_selection_error").text('');
                        $("#subject_name_error").text('');
                        $("#full_marks_error").text('');
                        $("#exam_duration_error").text('');
                        $("#pass_marks_error").text('');
                        $("#final_error").text('');

                        $("#final_error").text('');
                        $("#faculty_list").val(null);
                        $('#subject_name').val('');
                        $('#full_marks').val('');
                        $('#pass_marks').val('');
                        $('#exam_duration').val('');

                        $('#subject_name').removeClass('is-invalid');
                        $('#subject_name').removeClass('is-valid border border-success border-2');
                        $('#subject_name_error').removeClass('text-danger');
                        $("#subject_name_error").empty();
                        $('#subject_name').val('');
                          Swal.fire({
                              title: "Error!",
                              text: "An error occurred while deleting the subject.",
                              icon: "error"
                          });
                      }
                  });
              }
          });
      });

});
