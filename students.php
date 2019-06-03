<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   // check logged in
   if (isset($_SESSION['id'])) {

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

      // Build SQL statment that selects a student's modules
      $sql = "SELECT studentid,dob,firstname,lastname,house,town,county,country,postcode FROM student;";

      $result = mysqli_query($conn,$sql);

      $data['content'] .= '<form method="post">';
      $data['content'] .= "<table border='1'>";
      $data['content'] .= "<tr><th colspan='10' align='center'><h2>Students</h2></th></tr>";
      $data['content'] .= "<tr><th>Student ID</th><th>DOB</th><th>First Name</th><th>Last Name</th><th>House</th><th>Town</th>
      <th>County</th><th>Country</th><th>Postcode</th><th>Select</th></tr>";
      // Display the modules within the html table
      while($row = mysqli_fetch_array($result)) {
         $data['content'] .= "<tr><td> $row[studentid] </td><td> $row[dob] </td>";
         $data['content'] .= "<td> $row[firstname] </td><td> $row[lastname] </td>
         <td> $row[house] </td><td> $row[town] </td><td> $row[county] </td><td> $row[country] </td>
         <td> $row[postcode] </td> </td> ";
          $data['content'] .= "<td> <input type ='checkbox' name='delrecords[]' value='".$row['studentid']."' </td></tr> </td>";
      }
      $data['content'] .= "</table>";
      $data['content'] .= "</br></br></br>";
      $data['content'] .= '<input type="submit" name="delete" value="Delete Records">';
      $data['content'] .= "</form>";

      if(isset($_POST['delete'])){
        $checkboxcount = count($_POST['delrecords']);
        $i=0;
        while($i<$checkboxcount){                                 //count of records to delete
          $theid = $_POST['delrecords'][$i];
          mysqli_query($conn, "DELETE FROM student WHERE studentid= '$theid'");
          $i++;
        }
         echo "<H3>Success: Data successfully removed!</H3>";
      }

      // render the template
      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php"); 
   mysqli_close($conn);
   ?>