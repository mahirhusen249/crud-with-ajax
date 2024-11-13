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
                                        <button type="submit" class="btn btn-primary" name="submit" id="saveBtn">Save changes</button>
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
                                            <input type="email" class="form-control" name="email" id="updateEmail"  placeholder="Enter Email" required> 
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
                                    <button type="submit" class="btn btn-primary" name="update" id="updateBtn">Save changes</button>
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
        url: 'index.php',  // PHP file to fetch records
        type: 'POST',
        success: function(data) {
            $('#recordTable tbody').html(data);  // Populate the table with records
        }
    });
}

// Initial load of records
loadRecords();

// Form validation and insert (Add record)
$('#addForm').submit(function (e) {
    e.preventDefault();  // Prevent the form from submitting normally

    var isValid = true;
    var name = $('#name').val();
    var mobileno = $('#mobileno').val();
    var email = $('#email').val();
    var password = $('#password').val();

    // Clear previous error messages
    $('#nameError').text('');
    $('#mobilenoError').text('');
    $('#emailError').text('');
    $('#passwordError').text('');

    // Name validation
    if (name == '') {
        $('#nameError').text("Name is required.");
        isValid = true;
    }

    // Mobile number validation (only 10 digits allowed)
    if (mobileno == '') {
        $('#mobilenoError').text("Mobile number is required.");
        isValid = false;
    } else if (!/^\d{10}$/.test(mobileno)) {
        $('#mobilenoError').text("Mobile number must be exactly 10 digits.");
        isValid = false;
    }

    // Email validation
    if (email == '') {
        $('#emailError').text("Email is required.");
        isValid = false;
    } else if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email)) {
        $('#emailError').text("Please enter a valid email address.");
        isValid = false;
    }

    // Password validation
    if (password == '') {
        $('#passwordError').text("Password is required.");
        isValid = false;
    } else if (password.length < 6 || password.length > 12) {
        $('#passwordError').text("Password must be between 6 and 12 characters.");
        isValid = false;
    }

    // If the form is valid, send data via AJAX to insert into database
    if (isValid) {
        var formData = {
            name: name,
            mobileno: mobileno,
            email: email,
            password: password,
            submit: true
        };

        $.ajax({
            url: 'index.php',  // The same PHP file to handle the insert
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.trim() === 'success') {
                    $('#addForm')[0].reset();  // Reset the form fields
                    loadRecords();  // Reload the table with updated records
                    $('#addIconModal').modal('hide');  // Close the modal
                } else {
                    alert('Error adding record: ' + response);
                }
            },
            error: function() {
                alert('An error occurred while adding the record.');
            }
        });
    }
});

// Fetch record data for updating (when clicking on the "Edit" button)
$(document).on('click', '.update-btn', function() {
    var id = $(this).data('id');
    $.ajax({
        url: 'fetch.php',
        type: 'GET',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            if (response) {
                $('#updateId').val(response.id);
                $('#updateName').val(response.name);
                $('#updateMobileno').val(response.mobileno);
                $('#updateEmail').val(response.email);
                $('#updatePassword').val(response.password);
                $('#updateIconModal').modal('show');
            }
        },
        error: function() {
            alert('Error fetching data for update.');
        }
    });
});

// Form validation and update (Update record)
// Form validation and update (Update record)
// Form validation and update (Update record)
$('#updateForm').submit(function(e) {
    e.preventDefault();  // Form ko submit hone se rokna

    var isValid = true;  // Flag to track if the form is valid
    var name = $('#updateName').val().trim();  // Use .trim() to remove leading/trailing spaces
    var mobileno = $('#updateMobileno').val().trim();
    var email = $('#updateEmail').val().trim();
    var password = $('#updatePassword').val().trim();

    // Clear previous error messages
    $('#updatenameError').text('');
    $('#updatemobilenoError').text('');
    $('#updateemailError').text('');
    $('#updatepasswordError').text('');

    // Name validation (check if it's empty)
    if (name === '') {
        $('#updatenameError').text("Name is required.");
        isValid = false;
    }

    // Mobile number validation (check if it's empty and 10 digits)
    if (mobileno === '') {
        $('#updatemobilenoError').text("Mobile number is required.");
        isValid = false;
    } else if (!/^\d{10}$/.test(mobileno)) {
        $('#updatemobilenoError').text("Mobile number must be exactly 10 digits.");
        isValid = false;
    }

    // Email validation (check if it's empty and valid format)
    if (email === '') {
        $('#updateemailError').text("Email is required.");
        isValid = false;
    } else if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email)) {
        $('#updateemailError').text("Please enter a valid email address.");
        isValid = false;
    }

    // Password validation (check if it's empty and length between 6 and 12)
    if (password === '') {
        $('#updatepasswordError').text("Password is required.");
        isValid = false;
    } else if (password.length < 6 || password.length > 12) {
        $('#updatepasswordError').text("Password must be between 6 and 12 characters.");
        isValid = false;
    }

    // If the form is valid, proceed with AJAX
    if (isValid) {
        var formData = {
            update: true,
            id: $('#updateId').val(),
            name: name,
            mobileno: mobileno,
            email: email,
            password: password
        };

        $.ajax({
            url: 'index.php',  // PHP file to handle the update
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.trim() === 'Update successful') {
                    $('#updateForm')[0].reset();  // Reset form fields
                    $('#updateIconModal').modal('hide');  // Hide the modal
                    loadRecords();  // Reload the records in the table
                } else {
                    alert('Error updating record');
                }
            },
            error: function() {
                alert('An error occurred while updating the record.');
            }
        });
    }
});



// Handle record deletion
$(document).on('click', '.delete-btn', function() {
    var recordId = $(this).data('id');
    var confirmation = confirm("Are you sure you want to delete this record?");
    
    if (confirmation) {
        $.ajax({
            url: 'index.php',
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
