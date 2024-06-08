function getCheckboxValues(){
    Swal.fire({
        title: 'Are you sure?',
        text: "Delete all selected faculties? This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete them!'
    }).then((result) => {
        if (result.isConfirmed) {
            // If user clicks "Yes", call the actual function
            mass_delete_faculties();
        } else {
            // If user clicks "Cancel" or closes the dialog, do nothing
            // You can add additional behavior here if needed
        }
    });
}

function mass_delete_faculties() {
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
        url: mass_manage,
        // dataType: 'json',
        data: {
            ticked_faculties_list: values
        },
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        success: function (result) {
            if (result.message === 'successful') {
                // let newUrl = faculty_route_list + '?per_page=' + result.per_page + '&page=' + result.page;
                let not_deleted_faculty_name = result.not_deleted_faculty_name;
                let deleted_faculty_name = result.deleted_faculty_name;

                if (not_deleted_faculty_name.length > 0)
                {
                    //var textToShow = 'Following faculties were not deleted which include: <br>' + not_deleted_faculty_name;
                    let textToShow = 'Following faculties were not deleted which include:  <br>';
                    not_deleted_faculty_name.forEach(function(faculty, index) {
                        textToShow += (index + 1) + ') ' + faculty + '<br>';
                    });
                    //console.log(not_deleted_faculty_name);
                    $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded");
                    Swal.fire({
                        title: "Error!",
                        html: textToShow,
                        icon: "error"
                    });
                }
                else
                {
                    // let textToShow = 'Deleted Subject are <br>' + deleted_faculty_name;
                    let textToShow = 'Deleted Faculties are <br>';
                    deleted_faculty_name.forEach(function(faculty, index) {
                        textToShow += (index + 1) + ') ' + faculty + '<br>';
                    });
                    $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded");
                    Swal.fire({
                        title: "Faculties are deleted!.",
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

// Function to sort table
function sortTable(columnIndex) {
    let table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById("listoffaculties_sort");
    switching = true;
    // Set the sorting direction to ascending
    dir = "fa-sort-up";
    // Loop until no switching has been done
    while (switching) {
      switching = false;
      rows = table.rows;
      // Loop through all table rows (except the first, which contains table headers)
      for (i = 1; i < (rows.length - 1); i++) {
        shouldSwitch = false;
        // Get the two elements you want to compare
        x = rows[i].getElementsByTagName("td")[columnIndex];
       // console.log('x = \n');
        //console.log(x);
        y = rows[i + 1].getElementsByTagName("td")[columnIndex];
       // console.log('\n\n');
       // console.log('y = \n');
        //console.log(y);
        // Check if the two rows should switch place
        if (dir === "fa-sort-up") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            shouldSwitch = true;
            break;
          }
        } else if (dir === "fa-sort-down") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            shouldSwitch = true;
            break;
          }
        }
    }
      if (shouldSwitch) {
        // If a switch has been marked, make the switch and mark that a switch has been done
        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
        switching = true;
        // Increase the switch count to stop the loop after a certain number of iterations
        switchcount++;
      } else {
        // If no switching has been done and the direction is ascending, set the direction to descending and run the loop again
        if (switchcount === 0 && dir === "fa-sort-up") {
          dir = "fa-sort-down";
          switching = true;
        }
      }
    }
      // Save the current sort state in localStorage
    //   localStorage.setItem("sortColumnIndex", columnIndex);
    //   localStorage.setItem("sortDirection", dir);
    // Add sorting arrow to the sorted column header
    addSortingArrow(table.rows[0].getElementsByTagName("th")[columnIndex],dir);
  }

  function addSortingArrow(header,direction) {
    // Remove sorting arrow from all headers
    let headers = document.getElementsByTagName("th");
    for (var i = 0; i < headers.length; i++) {
        let icons = document.querySelectorAll("th i.fa-sort, th i.fa-sort-up, th i.fa-sort-down");
        icons.forEach(function(icon) {
            icon.classList.remove("fa-sort", "fa-sort-up", "fa-sort-down");
            icon.classList.add(direction);
          });

    }
    //header.classList.add(direction);
  }

document.addEventListener('DOMContentLoaded', function() {

    //Show Old Faculty Names
        function showOldFacultyNames(divId) {
            const divContent = document.getElementById(divId).innerHTML;

            Swal.fire({
                html: divContent,
                showCloseButton: true,
                focusConfirm: false,
            });
        }


        // Add event listeners for each anchor tag


            const anchor_tags_old_faculty_names = document.querySelectorAll('.show_old_faculties');
            anchor_tags_old_faculty_names.forEach(function(anchor) {
                anchor.addEventListener('click', function(event) {
                    event.preventDefault();
                    const divId = this.getAttribute('data-target');
                    showOldFacultyNames(divId);
                });
            });


     // Function to setup event listeners
     function setupEventListeners_old_faculties() {
        const anchor_tags_old_faculty_names = document.querySelectorAll('.show_old_faculties');
        anchor_tags_old_faculty_names.forEach(function(anchor) {
            anchor.addEventListener('click', function(event) {
                event.preventDefault();
                const divId = this.getAttribute('data-target');
                showOldFacultyNames(divId);
            });
        });
    }


    function setupEventListeners_subject() {
        const anchor_tags_subjects = document.querySelectorAll('.show_subjects');

        anchor_tags_subjects.forEach(function(anchor) {
            anchor.addEventListener('click', function(event) {
                event.preventDefault();
                const divId = this.getAttribute('data-target');
                showSubjectNames(divId);
            });
        });
    }

        // Show Subjects
        function showSubjectNames(divId) {
            const divContent = document.getElementById(divId).innerHTML;

            Swal.fire({
                html: divContent,
                showCloseButton: true,
                focusConfirm: false,
            });
        }

        // Add event listeners for each anchor tag
        const anchor_tags_subjects = document.querySelectorAll('.show_subjects');

        anchor_tags_subjects.forEach(function(anchor) {
            anchor.addEventListener('click', function(event) {
                event.preventDefault();
                const divId = this.getAttribute('data-target');
                showSubjectNames(divId);
            });
        });


    $('#add_faculty').on('submit', function (event) {
            event.preventDefault();
            $('#faculty_name_error').addClass('text-danger');
            $('#faculty_name').removeClass('is-invalid');
            $('#faculty_name').removeClass('is-valid border border-success border-2');
            $("#faculty_name_error").empty();
            let faculty_name = $('#faculty_name').val().trim();
            let _token = $('input[name="_token"]').val();

            $.ajax({
                    type: 'POST',
                    url: add_faculty_route,
                    data: {_token:_token,faculty_name:faculty_name},
                    dataType: 'json',
                    success: function(result)
                    {
                        if (result.msg === "Faculty Added Successfully.")
                        {
                            $('#faculty_name').addClass('is-valid border border-success border-2');
                            $('#faculty_name_error').removeClass('text-danger');
                            $('#faculty_name_error').addClass('text-success');
                            $('#faculty_name_error').text(result.msg);
                            // $('#faculty_name').val('');

                            if(result.subject_count === "Greater than 0")
                            {
                                $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded");
                                // $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded", function() {
                                //     //sortTable(localStorage.getItem("sortColumnIndex"));
                                //     let columnIndex = localStorage.getItem("sortColumnIndex");
                                //     if (columnIndex !== null) {
                                //       // Restore the sorting state
                                //       sortTable(parseInt(columnIndex));
                                //     }
                                // });
                            }
                            if(result.subject_count === "Equals to 0")
                            {
                                location.reload();
                            }

                            // setTimeout(function() {
                            //     $( "#faculty_name_error" ).empty();
                            //     $('#faculty_name').val('');
                            //     $('#faculty_name').removeClass('is-valid border border-success border-2');
                            //     }, 3000)
                            $( "#faculty_name_error" ).empty();
                            $('#faculty_name').val('');
                            $('#faculty_name').removeClass('is-valid border border-success border-2');
                                Swal.fire({
                                    title: "Faculty added successfully.",
                                    text: "",
                                    icon: "success"
                                });
                        }
                        if(result.msg === "Something went wrong.")
                        {
                            $('#faculty_name').addClass('is-invalid');
                            $('#faculty_name_error').addClass('text-danger');
                            $('#faculty_name_error').text(result.msg);
                        }
                    },
                    error: function(error)
                    {
                        if (error.responseJSON && error.responseJSON.errors)
                        {
                            let errors = error.responseJSON.errors;
                            if (errors.faculty_name)
                            {
                                $('#faculty_name').addClass('is-invalid');
                                $('#faculty_name_error').text(errors.faculty_name[0]);
                            }
                        }
                    }
            });
        });

        $(document).on('click', '.edit_faculty', function(e) {
            e.preventDefault();
            e.stopPropagation();


            let url_edit = $(this).attr('href');
            let faculty_name = $(this).data('name');
            let _token =  document.head.querySelector('meta[name="csrf-token"]').content;


            Swal.fire({
                title: 'Update Faculty Name of ' + faculty_name,
                input: 'text',
                inputValue: faculty_name,
                showCancelButton: true,
                confirmButtonText: 'Update',
                showLoaderOnConfirm: true,
                inputAttributes: {
                    maxlength: 100,
                    required:true
                },
                preConfirm: (new_faculty_name) => {
                    // Send AJAX request to update faculty name
                    return $.ajax({
                        url: url_edit,
                        type: 'POST',
                        data: {
                            _token: _token,
                            new_faculty_name: new_faculty_name,
                            old_faculty_name: faculty_name,
                        },
                        success: function(response){

                            if(response.message === "successful")
                            {
                                if(response.subject_count === "Greater than 0")
                                {
                                    // $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded");
                                    $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded", function() {
                                        setupEventListeners_old_faculties(); // Reattach event listeners after content is loaded
                                        setupEventListeners_subject();
                                    });
                                }
                                if(response.subject_count === "Equals to 0")
                                {
                                    $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded", function() {
                                        setupEventListeners_old_faculties(); // Reattach event listeners after content is loaded
                                        setupEventListeners_subject();
                                    });
                                     //$("#listoffacultiesadded").load(location.href + " #listoffacultiesadded");
                                    // location.reload();
                                }
                                Swal.fire({
                                    title: "Updated!",
                                    text: "Faculty name updated successfully.",
                                    icon: "success"
                                });

                            }
                            else if(response.message === "Something went wrong.")
                            {
                            //   $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded");
                            $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded", function() {
                                setupEventListeners_old_faculties(); // Reattach event listeners after content is loaded
                                setupEventListeners_subject();
                            });
                                Swal.fire({
                                    title: "Error!",
                                    text: "An error occurred while updating the faculty name",
                                    icon: "error"
                                });
                            }
                            else if(response.message === "faculty_not_found")
                            {
                            //   $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded");
                            $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded", function() {
                                setupEventListeners_old_faculties(); // Reattach event listeners after content is loaded
                                setupEventListeners_subject();
                            });
                                Swal.fire({
                                    title: "Error!",
                                    text: "Faculty not found",
                                    icon: "error"
                                });
                            }
                        },
                        error: function(xhr, status, error){

                            // if (error.status === 422)
                            // {
                            //     errors = error.responseJSON.errors;
                            //     if (errors.hasOwnProperty('new_faculty_name'))
                            //     {
                            //         Swal.fire('Error', errors['new_faculty_name'], 'error');
                            //     }
                            // }

                              //console.log(xhr.responseText);
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                let errorMessage = Object.values(xhr.responseJSON.errors.new_faculty_name).join('<br>');
                               // Swal.fire('Error', errorMessage, 'error');
                                Swal.showValidationMessage(errorMessage);
                            }  else {
                                let errorMessage = 'Failed to update faculty name.';
                                Swal.showValidationMessage(errorMessage);
                            }
                        }
                    }).catch(error => {
                         //console.log(error);
                    });
                }
            });
            });




        $(document).on('click', '.delete_faculty', function(e) {
            e.preventDefault();
            e.stopPropagation();

            // var link = $(this);
            let url = $(this).attr('href');
            let faculty_name = $(this).data('name');

              Swal.fire({
                  title: "Delete " + faculty_name + "\nAre you sure?",
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
                              $('#faculty_name').removeClass('is-invalid');
                              $('#faculty_name').removeClass('is-valid border border-success border-2');
                              $('#faculty_name_error').removeClass('text-danger');
                              $("#faculty_name_error").empty();
                              $('#faculty_name').val('');
                              if(result.message === "successful")
                              {
                                  // $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded");
                                  // Swal.fire({
                                  //     title: "Deleted!",
                                  //     text: "Faculty has been deleted.",
                                  //     icon: "success"
                                  // })
                                  if(result.subject_count === "Greater than 0")
                                  {
                                      $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded");
                                  }
                                  if(result.subject_count === "Equals to 0")
                                  {
                                      $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded");
                                      // location.reload();
                                  }
                                  Swal.fire({
                                      title: "Deleted!",
                                      text: "Faculty has been deleted.",
                                      icon: "success"
                                  })
                              }
                              else if(result.message === "Something went wrong.")
                              {
                                $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded");
                                  Swal.fire({
                                      title: "Error!",
                                      text: "An error occurred while deleting the faculty.",
                                      icon: "error"
                                  });
                              }
                              else if(result.message === "faculty_not_found")
                              {
                                $("#listoffacultiesadded").load(location.href + " #listoffacultiesadded");
                                  Swal.fire({
                                      title: "Error!",
                                      text: "Faculty not found",
                                      icon: "error"
                                  });
                              }
                              // link.remove();
                          },
                          error: function(xhr, status, error) {
                              $('#faculty_name').removeClass('is-invalid');
                              $('#faculty_name').removeClass('is-valid border border-success border-2');
                              $('#faculty_name_error').removeClass('text-danger');
                              $("#faculty_name_error").empty();
                              $('#faculty_name').val('');
                              Swal.fire({
                                  title: "Error!",
                                  text: "An error occurred while deleting the faculty.",
                                  icon: "error"
                              });
                          }
                      });
                  }
              });
          });
});



