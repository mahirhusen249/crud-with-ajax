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
                                            </div>
                                        </div>  
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Mobile No</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="mobileno" id="mobileno" placeholder="Enter Mobile No" required>
                                            </div>
                                        </div>  
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                                            </div>
                                        </div>  
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="saveBtn">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>       
                <!-- update model  -->
                           
                    <form method="post" id="addForm" enctype="multipart/form-data">
                        <div class="modal fade" id="updateIconModal" tabindex="-1" aria-labelledby="addIconModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="addIconModalLabel">Edit Record</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
                                            </div>
                                        </div>  
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Mobile No</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="mobileno" id="mobileno" placeholder="Enter Mobile No" required>
                                            </div>
                                        </div>  
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                                            </div>
                                        </div>  
                                        <div class="row mb-3">
                                            <label class="col-sm-3 col-form-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="saveBtn">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                // Check if the response is 'success'
                if (response.trim() === 'success') {
                    $('#addForm')[0].reset();  // Reset form fields
                    loadRecords();  // Reload the records table dynamically

                    // Close the modal after successful insert
                    $('#addIconModal').modal('hide');  // Close the modal
                } else {
                    alert('Error adding record');  // Show error message if something goes wrong
                }
            },
            error: function() {
                alert('An error occurred while inserting the record.');
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
                data: { delete: recordId },  // Pass the record ID to delete
                success: function(response) {
                    loadRecords();  // Reload the records table after deletion
                }
            });
        }
    });
});

</script>
