<title>CRUD WITH AJAX</title> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Table
                        <button type="button" class="btn btn-primary float-end mb-2" data-bs-toggle="modal" data-bs-target="#addIconModal">Add Record</button>
                    </h5>

                    <!-- Modal Add -->
                    <form method="post" id="addForm" enctype="multipart/form-data">
                        <div class="modal fade" id="addIconModal" tabindex="-1" aria-labelledby="addIconModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="addIconModalLabel">Add Record</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required> 
                                                <div id="nameError" class="text-danger"></div> <!-- Error message for name -->

                                            </div>
                                        </div>  
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Mobile No</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="mobileno" id="mobileno" placeholder="Enter Mobile No" required> 
                                                <div id="mobilenoError" class="text-danger"></div> <!-- Error message for mobile number -->

                                            </div>
                                        </div>  
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required> 
                                                <div id="emailError" class="text-danger"></div> <!-- Error message for email -->

                                            </div>
                                        </div>  
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required> 
                                                <div id="passwordError" class="text-danger"></div> <!-- Error message for password -->

                                            </div>
                                        </div> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="submit"id="saveBtn">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form> 
                  

                <!-- Modal Update -->
                <form method="post" id="updateForm" enctype="multipart/form-data">
                    <div class="modal fade" id="updateIconModal" tabindex="-1" aria-labelledby="updateIconModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="updateIconModalLabel">Edit Record</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="updateId" required> <!-- Hidden input for ID -->
                                    <!-- Name Field -->
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name" id="updateName" placeholder="Enter Name" required> 
                                            <div id="updatenameError" class="text-danger"></div> <!-- Error message for name -->

                                        </div>
                                    </div>  
                                    <!-- Mobile No Field -->
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Mobile No</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="mobileno" id="updateMobileno" placeholder="Enter Mobile No" required> 
                                            <div id="updatemobilenoError" class="text-danger"></div> <!-- Error message for mobile number -->

                                        </div>
                                    </div>  
                                    <!-- Email Field -->
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" name="email" id="updateEmail" placeholder="Enter Email" required> 
                                            <div id="updateemailError" class="text-danger"></div> <!-- Error message for email -->

                                        </div>
                                    </div>  
                                    <!-- Password Field -->
                                    <div class="row mb-3">
                                        <label class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password" id="updatePassword" placeholder="Enter Password" required> 
                                            <div id="updatepasswordError" class="text-danger"></div> <!-- Error message for password -->

                                        </div>
                                    </div> 
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="updateBtn">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

    <!-- Table to display records -->
    <table class="table" id="recordTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mobile No</th>
                <th>Email</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Records will be inserted dynamically via AJAX -->
        </tbody>
    </table>
</section>

<!-- Include jQuery for AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // Function to load records dynamically using AJAX
    function loadRecords() {
        $.ajax({
            url: 'index.php',  // The same PHP file for fetching records
            type: 'POST',
            success: function(data) {
                $('#recordTable tbody').html(data);  // Populate the table dynamically
            }
        });
    }

    // Initial load of records
    loadRecords();

    // Handle form submission for adding a record
    $('#addForm').submit(function(e) {
        e.preventDefault();  // Prevent the default form submission

        var formData = {
            name: $('#name').val(),
            mobileno: $('#mobileno').val(),
            email: $('#email').val(),
            password: $('#password').val()
        };

        $.ajax({
            url: 'index.php',  // Same PHP file to handle the insertion
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.trim() === 'success') {
                    $('#addForm')[0].reset();  // Reset form fields
                    loadRecords();  // Reload the records table dynamically
                    $('#addIconModal').modal('hide');  // Close the modal
                } else {
                    alert('Error adding record');
                }
            },
            error: function() {
                alert('An error occurred while inserting the record.');
            }
        });
    });

    // Fetch record data for editing
    $(document).on('click', '.update-btn', function() {
        var id = $(this).data('id');  // Get the record ID
        $.ajax({
            url: 'fetch.php', // PHP script to fetch the record data
            type: 'GET',
            data: { id: id }, // Send the ID to the PHP script
            dataType: 'json', // Expecting JSON response
            success: function(response) {
                if (response) {
                    // Populate the update modal with existing data
                    $('#updateId').val(response.id); 
                    $('#updateName').val(response.name); 
                    $('#updateMobileno').val(response.mobileno); 
                    $('#updateEmail').val(response.email); 
                    $('#updatePassword').val(response.password); 

                    // Show the modal after filling data
                    $('#updateIconModal').modal('show');
                }  
            },
            error: function() {
                alert('An error occurred while fetching the data.');
            }
        });
    });

    // Submit the update form via AJAX
    $('#updateForm').submit(function(e) {
    e.preventDefault();   
    var formData = {
        update: true,   
        id: $('#updateId').val(),
        name: $('#updateName').val(),
        mobileno: $('#updateMobileno').val(),
        email: $('#updateEmail').val(),
        password: $('#updatePassword').val()
    };

    $.ajax({
        url: 'index.php',  
        type: 'POST',
        data: formData,  // Send the data to the PHP file
        success: function(response) {
            if (response.trim() === 'Update successful') {
                $('#updateForm')[0].reset();  // Reset the form
                $('#updateIconModal').modal('hide');  // Close the modal
                loadRecords();  // Reload the table dynamically
            } else {
                alert('Error updating record');
            }
        },
        error: function() {
            alert('An error occurred while updating the record.');
        }
    });
});
    // Handle record deletion dynamically
    $(document).on('click', '.delete-btn', function() {
        var recordId = $(this).data('id');  // Get the ID of the record to delete
        var confirmation = confirm("Are you sure you want to delete this record?");
        
        if (confirmation) {
            $.ajax({
                url: 'index.php',  // Same PHP file for deletion
                type: 'GET',
                data: { delete: recordId },   
                success: function(response) {
                    loadRecords();   
                }
            });
        }
    });
});    
</script>
