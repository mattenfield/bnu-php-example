<?php
   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");
   echo template("templates/partials/header.php");
   if (isset($_GET['return'])) {
      $msg = "";
      if ($_GET['return'] == "fail") {$msg = "Login Failed. Please try again.";}
      $data['message'] = "<p>$msg</p>";
   }
   if (isset($_SESSION['id'])) {
     $namequery =  "SELECT firstname from student where studentid='". $_SESSION['id'] . "';";
     $result = mysqli_query($conn,$namequery);
     $row = mysqli_fetch_array($result);
     
      $data['content'] = "<h2>Hello, ".$row['firstname'].".</h2></br>";
      $data['content'] .= "<h4>Welcome to your dashboard.</h4>";
      $data['content'] .= '<img class="mySlides" src="img/bnu.jpg" style="width:100%">';
      $data['content'] .= '</br></br><p>You can navigate around this portal to check your own details, to assign modules and view other students details.</p>';
      echo template("templates/partials/nav.php");
      echo template("templates/default.php", $data);
   } else {
      echo template("templates/login.php", $data);
   }
   echo template("templates/partials/footer.php");
   // another test edit
?>
