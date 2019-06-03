<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   // check logged in
   if (isset($_SESSION['id'])) {

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");
  $data['content'] .= '<h1> Add a student </h1>';
  $data['content'] .= '</br></br>';
  $data['content'] .= '<form method="post">';
  $data['content'] .= ' Student ID: 
   <input name="txtID" type="text" required/>
   <br/>
   First Name:
   <input name="txtfname" type="text" required/>
   <br/>
   Last Name:
   <input name="txtlname" type="text" required/>
   <br/>
   Date Of Birth:
   <input name="dateofbirth" type="date" required/>
   <br/>
   Password:
   <input name="password" type="password" required/>
   <br/>
   First Line Address:
   <input name="txtfirstline" type="text" required/>
   <br/>
   Town:
   <input name="txttown" type="text" required/>
   <br/>
   County:
   <input name="txtcounty" type="text" required/>
   <br/>
   Country:
   <input name="txtcountry" type="text" required/>
   <br/>
   Postcode:
   <input name="txtpostcode" type="text" required/>
   <br/><br/><br/><br/><br/>
   <input type="submit" value="Create User" name="btncreate" />';
   $data['content'] .= '</form>';

  if(isset($_POST['btncreate'])){
    
    $ID = mysqli_real_escape_string($conn, $_POST['txtID']);
    $fname = mysqli_real_escape_string($conn, $_POST['txtfname']);
    $lname = mysqli_real_escape_string($conn, $_POST['txtlname']);
    $dateofbirth = mysqli_real_escape_string($conn, $_POST['dateofbirth']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $firstline = mysqli_real_escape_string($conn, $_POST['txtfirstline']);
    $town = mysqli_real_escape_string($conn, $_POST['txttown']);
    $county = mysqli_real_escape_string($conn, $_POST['txtcounty']);
    $country = mysqli_real_escape_string($conn, $_POST['txtcountry']);
    $postcode = mysqli_real_escape_string($conn, $_POST['txtpostcode']);
    
    $hashedpass = password_hash($password, PASSWORD_DEFAULT);
    
    $idcheck = mysqli_query($conn, "SELECT studentid FROM student WHERE studentid = $ID"); //validation query for duplicate student entries.
    $count = mysqli_num_rows($idcheck);
    if($count>0)
    {
       echo "<H4>Error: Unfortunately, there is already a student with this ID.</H4>";
    }
    else
    {
      $result = mysqli_query($conn, " INSERT INTO student(studentid,password,dob,firstname,lastname,house,town,county,country,postcode) VALUES
  ('$ID','$hashedpass', '$dateofbirth', '$fname', '$lname', '$firstline', '$town', '$county', '$country', '$postcode');");
    header("Location: students.php");
    }
  
  
      
  }
  else {
    
    header("Location: index.php");
  }
   
   echo template("templates/default.php", $data);


   echo template("templates/partials/footer.php");
