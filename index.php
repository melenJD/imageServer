<?php
  $connect = mysqli_connect('localhost', 'admin_image', '!Rkawk135', 'admin_image-melen') or die ('connect fail');
  $query = "SELECT * FROM image_user";
  $result = $connect->query($query);
  $total = @mysqli_num_rows($result);

  session_start();

  if(!isset($_SESSION['userid'])) {
    header('Location: ./login.html');
  }else{
    header('Location: ./php/main.php');
  }
?>