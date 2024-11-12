<?php
include 'conn.php';    
if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $mobileno = $_POST['mobileno'];
    $email = $_POST['email'];
    $password = $_POST['password'];

     $sql = "INSERT INTO `stbl` (name, mobileno, email, password) VALUES ('$name', '$mobileno', '$email', '$password')";
    if (mysqli_query($con, $sql)) {
        echo 'success';   
    } else {
        echo 'error';   
    }
    exit;  
}   


 
if (isset($_POST['update'])) {
    // Get values from AJAX request
    $id = $_POST['id'];
    $name = $_POST['name'];
    $mobileno = $_POST['mobileno'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update SQL Query
    $sql = "UPDATE stbl SET name='$name', mobileno='$mobileno', email='$email', password='$password' WHERE id='$id'";

    if (mysqli_query($con, $sql)) {
        echo 'Update successful';
    } else {
        echo 'Error updating record';
    }
    exit;
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
  