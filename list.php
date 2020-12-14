<?php
require_once "mysql_connect.php";
session_start();


$sql = "SELECT id, meno, pohlavie, email FROM formular";
$result = $link->query($sql);


$link->close();
?>


<!DOCTYPE html>
<html>
<body>
<?php
  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Name: " . $row["meno"]. " - Pohlavie: " . $row["pohlavie"]." - Email: " . $row["email"]."<br>";
    }
  } else {
    echo "0 results";
  }
?>
</body>
</html>
