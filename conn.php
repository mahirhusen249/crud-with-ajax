   
  <?php
  $servername="localhost";    
 $username="root";   
 $password="";  
 $database="crud";     
 


        $con = mysqli_connect($servername,$username,$password,$database);

        if(!$con){
            die('error'.mysqli_connect_error($con));
        }   
       