<?php
include 'conn.php';    
 
if (isset($_POST['submit'])) {
     $name = mysqli_real_escape_string($con, $_POST['name']);
    $mobileno = mysqli_real_escape_string($con, $_POST['mobileno']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];  

 
     $sql = "INSERT INTO `stbl` (name, mobileno, email, password) VALUES ('$name', '$mobileno', '$email', '$password ')";

    if (mysqli_query($con, $sql)) {
        echo 'success';  
    } else {
         echo 'error: ' . mysqli_error($con);
    }
    
    exit;   
}
  


 
 // Include your database connection file (make sure it exists and connects correctly)
 
// Check if the 'update' POST variable is set
if (isset($_POST['update'])) {
    // Get values from the AJAX request
    $id = $_POST['id'];
    $name = $_POST['name'];
    $mobileno = $_POST['mobileno'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Escape values to prevent SQL injection (using mysqli_real_escape_string)
    $id = mysqli_real_escape_string($con, $id);
    $name = mysqli_real_escape_string($con, $name);
    $mobileno = mysqli_real_escape_string($con, $mobileno);
    $email = mysqli_real_escape_string($con, $email);
    $password = mysqli_real_escape_string($con, $password);

    // SQL Update query
    $sql = "UPDATE stbl SET name='$name', mobileno='$mobileno', email='$email', password='$password' WHERE id='$id'";

    // Execute the SQL query
    if (mysqli_query($con, $sql)) {
        // Return success message
        echo 'Update successful';
    } else {
        // Return error message
        echo 'Error updating record';
    }
    exit;  // Always call exit after sending the response to prevent further execution
}
 

  

 if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM `stbl` WHERE id = '$id'";
    mysqli_query($con, $sql);
    exit;
}

 $sql = "SELECT * FROM stbl";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($result)) { 
    ?>
    <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name'];?>  </td>
    <td><?php echo $row['mobileno'];?> </td>
    <td><?php echo $row['email'];?> </td>
     <td><?php echo $row['password'];?> </td>
    
     <!-- Create Delete and Edit buttons -->
    <td>
        <button class='btn btn-danger delete-btn' data-id="<?php echo $row['id']; ?>">Delete</button> 
        <button type="button" class="btn btn-primary update-btn" data-id="<?php echo $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#updateIconModal">Edit</button>
        </td>
    
</tr> <?php
}
?>
  