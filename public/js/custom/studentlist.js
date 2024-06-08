
function getCheckboxValues_search() {
    // let checkboxes = document.querySelectorAll('input[type=checkbox]');
    let checkboxes = document.querySelectorAll('#search_students_results input[type=checkbox]');
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

    //console.log(values['liam45'])
    // console.log('Checkbox Values:', values);

    $.ajax({
        type: 'POST',
        url: mass_inactivate_activate,
        // dataType: 'json',
        data: {
            ticked_student_list: values
        },
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        success: function (result) {
            if (result.message === 'successful') {
                // Reload the current page
                // location.reload();
                // var newUrl = 'http://oe.test/admin/studentlist?per_page=' + result.per_page + '&page=' + result.page;
                // var newUrl = '/admin/studentlist?per_page=' + result.per_page + '&page=' + result.page;
                var newUrl = student_list_route + '?per_page=' + result.per_page + '&page=' + result.page;
                window.location.href = newUrl;
            }
        },
        error: function (error) {
            console.error('Error processing checkboxes:', error);
        }
    });
}



function getCheckboxValues() {
    let checkboxes = document.querySelectorAll('input[type=checkbox]');
    let perPage = document.querySelector('input[name="per_page"]').value;
    let page = document.querySelector('input[name="page"]').value;
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

    //console.log(values['liam45'])
    // console.log('Checkbox Values:', values);

    $.ajax({
        type: 'POST',
        url: mass_inactivate_activate,
        // dataType: 'json',
        data: {
            ticked_student_list: values,
            per_page:perPage,
            page:page
        },
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        success: function (result) {
            if (result.message === 'successful') {
                // Reload the current page
                // location.reload();
                // var newUrl = 'http://oe.test/admin/studentlist?per_page=' + result.per_page + '&page=' + result.page;
                // var newUrl = '/admin/studentlist?per_page=' + result.per_page + '&page=' + result.page;
                 var newUrl = student_list_route + '?per_page=' + result.per_page + '&page=' + result.page;
                
                window.location.href = newUrl;
            }
        },
        error: function (error) {
            console.error('Error processing checkboxes:', error);
        }
    });
}



$(document).ready(function() {

    $('#search_student').on('input', function() {
        let query = $(this).val().trim();
        //let query = $('#search_student').val().trim();
        
        if (query.length >= 3) {
            fetchSearchResults(query)
        }
        else {
            $('#search_students_results').empty(); // Clear search results if query is too short
            $('#original_student_table').show(); // Hide original table
            $('#original_student_table_per_page').removeClass('d-none');
            $('#original_student_table_next_previous').removeClass('d-none');
        }
    });
});


function fetchSearchResults(query) {
            $.ajax({
                url: student_list_route,
                type: 'GET',
                data: {
                    search_student: query
                },
                success: function(response)
                {
                    $('#original_student_table').hide(); // Hide original table
                    $('#original_student_table_per_page').addClass('d-none');
                    $('#original_student_table_next_previous').addClass('d-none'); 
                    $('#search_students_results').html(response); 
                },
                error: function(xhr)
                {
                    $('#search_students_results').empty(); // Clear search results if query is too short
                    $('#original_student_table').show(); // Hide original table
                    $('#original_student_table_per_page').removeClass('d-none');
                    $('#original_student_table_next_previous').removeClass('d-none');
                    console.log(xhr.responseText);
                }
            });
}
