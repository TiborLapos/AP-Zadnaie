



<!DOCTYPE html>
<html>
    <html lang="sk">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>Zadanie č 2.</title>
</head>
<body>
  
<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = $hesloErr = $heslo2Err = "";
$name = $email = $gender = $comment = $website = $heslo = $heslo2 =    "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Zadajte meno!";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Iba písmena a medzery sú dovolene!";
    }
  }
  if (empty($_POST["heslo"])) {
    $hesloErr = "Zadajte heslo!";
  } else {
    $heslo = test_input($_POST["heslo"]);
  }
  if (empty($_POST["heslo2"])) {
    $heslo2Err = "Zadajte heslo!";
  } else {
    $heslo2 = test_input($_POST["heslo2"]);
  }if ($heslo2 != $heslo){
    $heslo2Err = "Nesprávne heslo ";

  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Zadajte email!";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Nesprávný formát!";
    }
  }


  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Potrebujet vybrať pohlavie";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Formulár</h2>
<p><span class="error">* Musíte zadať!</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Meno: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Heslo 1: <input type="password" name="heslo" value="<?php echo $heslo;?>">
  <span class="error">* <?php echo $hesloErr;?></span>
  <br><br>
 Zadajte heslo ešte raz <input type="password" name="heslo2" value="<?php echo $heslo2;?>">
  <span class="error">* <?php echo $heslo2Err;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  <!--
  Website: <input type="text" name="website" value="<?php echo $website;?>">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  -->
  Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
  Pohlavie:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Žena
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Muž
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Iné  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Pridať">

  <script>

    var form = document.getElementById("heslo2");

    form.addEventListener("input", function () {
      console.log("Zmeny sa uložili !");
    });
    </script>
</form>
<?php 
require_once "mysql_connect.php";
// Initialize the session
session_start();


if(isset($_POST['submit']  )){
  if( $heslo != $heslo2){
    echo "ERROR: Nezmenili hodnoty v databaze";
  }else{


    // Attempt insert query execution
    $name = $_POST['name'];
    $heslo = $_POST['heslo'];
    $gender =$_POST['gender'];
    $email = $_POST['email'];
    $sql = "INSERT INTO formular(meno, heslo, pohlavie, email) VALUES ('" .$name. "','" .$heslo. "','" .$gender. "','" .$email. "')";
        if(mysqli_query($link, $sql)){
            echo "Records added successfully.";
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }

    header('location: index.php');


  }
  
    
}



?>
<?php
echo "<br>";
echo "<h2Vašé údaje:</h2>";
echo $name;
echo "<br>";
echo $heslo;
echo "<br>";
echo $heslo2;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>
 <a href="../">Naspäť </a>
 <br>
 <a href="list.php">Používatelia</a>
</body>
</html>
