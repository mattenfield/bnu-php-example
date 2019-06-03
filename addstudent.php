<?php
   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");
   // check logged in
   if (isset($_SESSION['id'])) {
     echo template("templates/partials/header.php");
     echo template("templates/partials/nav.php");
 $data['content'] .= '<h2> Add a student </h2>';
 $data['content'] .= '</br><h5>Please enter all fields to add a user.</h5></br>';
 $data['content'] .= '<form method="post">';
 $data['content'] .= ' 
 <div class="row">
 <div class="col-sm-3 col-md-6 col-lg-4">
 Student ID: <br/>
  <input name="txtID" type="text" align="right" required/>
  <br/><br/>
  First Name:<br/>
  <input name="txtfname" type="text" required/>
  <br/><br/>
  Last Name:<br/>
  <input name="txtlname" type="text" required/>
  <br/><br/>
  Date Of Birth:<br/>
  <input name="dateofbirth" type="date" required/>
  <br/><br/>
  Password:<br/>
  <input name="password" type="password" required/>
  <br/><br/>



</div>
<div class="col-sm-9 col-md-6 col-lg-8">
First Line Address:<br/>
<input name="txtfirstline" type="text" required/>
<br/><br/>
Town:<br/>
<input name="txttown" type="text" required/>
<br/><br/>
County:<br/>
<input name="txtcounty" type="text" required/>
<br/><br/>
Country:<br/>
<input name="txtcountry" type="text" required/>
<br/><br/>
Postcode:<br/>
<input name="txtpostcode" type="text" required/>
<br/><br/><br/>

</div>
</div>
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
      echo "<H3>Error: Unfortunately, there is already a student with this ID.</H3>";
   }
   else
   {
     $result = mysqli_query($conn, " INSERT INTO student(studentid,password,dob,firstname,lastname,
       house,town,county,country,postcode) VALUES
 ('$ID','$hashedpass', '$dateofbirth', '$fname', '$lname', '$firstline', '$town', '$county', 
   '$country', '$postcode');");
   header("Location: students.php");
   }
   
 }
    echo template("templates/default.php", $data); 
}
else {
    
    header("Location: index.php");
}
   
   echo template("templates/partials/footer.php");
   ?>