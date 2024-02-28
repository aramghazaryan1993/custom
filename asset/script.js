 $(document).ready(function () {
                // Activate tooltip
                $('[data-toggle="tooltip"]').tooltip();

                // Select/Deselect checkboxes
                var checkbox = $('table tbody input[type="checkbox"]');
                $("#selectAll").click(function () {
                    if (this.checked) {
                        alert('deded ')
                        checkbox.each(function () {
                            this.checked = true;
                        });
                    } else {
                          alert('2222 ')
                        checkbox.each(function () {
                            this.checked = false;
                        });
                    }
                });
                checkbox.click(function () {
                     alert('2222 ')
                    if (!this.checked) {
                        $("#selectAll").prop("checked", false);
                    }
                });


        // Edit
     $(".edit").click(function(){
         var row = $(this).closest("tr");
         var id = row.find("td:eq(0)").text(); // Assuming the ID is in the first column
         var name = row.find("td:eq(1)").text();
         var username = row.find("td:eq(2)").text();
         var address = row.find("td:eq(3)").text();
         var phone = row.find("td:eq(4)").text();
         var age = row.find("td:eq(5)").text();


         // Set values of input fields in the modal form
         $("#editEmployeeModal input[name='id']").val(id);
         $("#editEmployeeModal input[name='name']").val(name);
         $("#editEmployeeModal input[name='username']").val(username);
         $("#editEmployeeModal textarea[name='address']").val(address);
         $("#editEmployeeModal input[name='phone']").val(phone);
         $("#editEmployeeModal input[name='age']").val(age);
     });

     $("#editEmployeeForm").submit(function(e) {
         e.preventDefault(); // Prevent form submission

         // Serialize form data
         var formData = $(this).serialize();

         // Send AJAX request to update data
         $.ajax({
             url: 'index.php?action=edit',
             type: 'POST',
             data: formData,
             success: function(response){
                 // Parse the JSON response
                 var responseData = JSON.parse(response);

                 var row = $('tbody').find('tr[data-id="' + responseData.id + '"]');

                 // Update the row with the new data
                 row.find('td:eq(1)').text(responseData.name);
                 row.find('td:eq(2)').text(responseData.username);
                 row.find('td:eq(3)').text(responseData.address);
                 row.find('td:eq(4)').text(responseData.phone);
                 row.find('td:eq(5)').text(responseData.age);

                 // Optionally, you can also hide the modal or show a success message
                 $('#editEmployeeModal').modal('hide');
             },
             error: function(xhr, status, error){
                 // Handle error response
                 console.error(xhr.responseText);
             }
         });
     });


     // delete data
     $(".delete").click(function(){
         var id = $(this).data('id');
         $('#deleteEmployeeModal').find('.modal-footer #confirmDelete').data('id', id);
     });

     $('#confirmDelete').on('click', function(){
         var id = $(this).data('id');
         $.ajax({
             type: 'POST',
             url: 'index.php?action=delete', // Specify the URL of your delete script
             data: {id: id},
             success: function(response){
                 if(response == "success"){
                     $('[data-id="' + id + '"]').closest('tr').remove();
                     $('#deleteEmployeeModal').modal('hide');
                 } else {
                     alert("Failed to delete data.");
                 }
             }
          });
        });


     // Add Employee
     $('#employeeForm').submit(function(e){
         e.preventDefault(); // Prevent form submission

         // Serialize form data
         var formData = $(this).serialize();

         // Send AJAX request
         $.ajax({
             url: 'index.php?action=add',
             type: 'POST',
             data: formData,
             success: function(response){
                 var insertedData = JSON.parse(response);

                 $('#addEmployeeModal').modal('hide');
                 // Handle success response

                 var newRow = '<tr>' +
                     '<td>' + insertedData.user_id + '</td>' +
                     '<td>' + insertedData.name + '</td>' +
                     '<td>' + insertedData.username + '</td>' +
                     '<td>' + insertedData.address + '</td>' +
                     '<td>' + insertedData.phone + '</td>' +
                     '<td>' + insertedData.age + '</td>' +
                     '<td>' +
                     '<a href="#editEmployeeModal" data-id="' + insertedData.id + '" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>' +
                     '<a href="#deleteEmployeeModal" data-id="' + insertedData.id + '" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>' +
                     '</td>' +
                     '</tr>';

                 $('tbody').append(newRow);
             },
             error: function(xhr, status, error){
                 // Handle error response
                 console.error(xhr.responseText);
                 // You can do something here like showing an error message
             }
         });
     });


 });

