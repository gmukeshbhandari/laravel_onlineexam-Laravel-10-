$(document).ready(function() {
    $('#search_login').on('input', function() {
        var query = $(this).val();
  
        if (query.length >= 3) { // Perform search only if query length is at least 3 characters
            fetchSearchResults(query);
        } else {
            $('#search_login_details_result').empty(); // Clear search results if query is too short
            $('#original_login_details_table').show(); // Hide original table
            $('#original_login_details_table_per_page').removeClass('d-none');
            $('#original_login_details_table_next_previous').removeClass('d-none');
        }
    });
  });
  
  
  function fetchSearchResults(query) {
    $.ajax({
        url: account_details_route,
        type: 'GET',
        data: {
            search_login_details: query
        },
        success: function(response) {
            $('#original_login_details_table').hide(); // Hide original table
            $('#original_login_details_table_per_page').addClass('d-none'); 
            $('#original_login_details_table_next_previous').addClass('d-none'); 
            $('#search_login_details_result').html(response);
           
        },
        error: function(xhr) {
            $('#search_login_details_result').empty(); // Clear search results if query is too short
            $('#original_login_details_table').show(); // Hide original table
            $('#original_login_details_table_per_page').removeClass('d-none');
            $('#original_login_details_table_next_previous').removeClass('d-none');
            // $('#search_login_details_result').html('<div class="alert alert-danger">An error occurred while searching. Please try again later.</div>');
            // console.log(xhr.responseText);
        }
    });
  }

 