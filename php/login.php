<?php
  session_start();

  $connect = mysqli_connect('localhost', 'admin_image', '!Rkawk135', 'admin_image-melen');

  $id=$_POST['userid'];
  $pw=$_POST['userpwd'];

  $query = "SELECT * FROM users WHERE userid='$id'";
  $result = $connect->query($query);

  if(mysqli_num_rows($result)==1) {
    $row=mysqli_fetch_assoc($result);
    if($row['userpwd']==$pw){
      $_SESSION['userid']=$id;
      if(isset($_SESSION['userid'])){
        header('Location: main.php');
      }else{
        header("Refresh: 0; URL='../login.html'");
        echo '<script>alert("비밀번호가 틀렸습니다");</script>';
      }
    }
  }else{
    header("Refresh: 0; URL='../login.html'");
    echo '<script>alert("아이디가 없습니다");</script>';
  }
?>