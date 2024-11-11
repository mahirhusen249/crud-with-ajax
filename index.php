<?php
include 'conn.php';   

 if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
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

 if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM `stbl` WHERE id = '$id'";
    mysqli_query($con, $sql);
    exit;
}

 $sql = "SELECT * FROM stbl";
$result = mysqli_query($con, $sql);

 while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['mobileno'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['password'] . "</td>";
    echo "<td>
        <button class='btn btn-danger delete-btn' data-id='" . $row['id'] . "'>Delete</button> 
       <button type='button' class='btn btn-primary update-btn' data-id='data-id='". $row['id'].' data-bs-toggle="modal" data-bs-target="#updateIconModal">Edit</button>

    </td>';
    echo "</tr>";
}
?>
