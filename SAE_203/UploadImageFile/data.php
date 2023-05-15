<?php
$conn = mysqli_connect("localhost", "root", "", "upload");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Data</title>
  </head>
  <body>
   
      <?php
      $i = 1;
      $rows = mysqli_query($conn, "SELECT * FROM tb_upload ORDER BY id DESC")
      ?>

      <?php foreach ($rows as $row) : ?>
    
        <img src="img/<?php echo $row["image"]; ?>" width = 200 title="<?php echo $row['image']; ?>">
    
      <?php endforeach; ?>
    <br>
    <a href="../uploadimagefile">Upload Image File</a>
  </body>
</html>
