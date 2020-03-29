<?php
  $target_dir = $_POST['target_dir'];
  $folder_link = $_POST['folder_link'];
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false){
    //echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  }else{
    //echo "File is not an image";
    $e_message = "이미지 파일만 업로드 가능합니다";
    $uploadOk = 0;
  }

  if(file_exists($target_file)){
    //echo "sorry already";
    $e_message = "이미 존재하는 파일입니다";
    $uploadOk = 0;
  }

  if ($_FILES["fileToUpload"]["size"] > 10000000) {
    //echo "too big";
    $e_message = "파일 용량이 너무 큽니다 ( 최대 10MB까지 업로드 가능합니다 )";
    $uploadOk = 0;
  }

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $e_message = "이미지 파일만 업로드 가능합니다";
      $uploadOk = 0;
  }

  if($uploadOk == 0) {
    //echo "dont uploaded";
  }else{
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
      //echo "uploaded";
    }
  }
  echo "<form name=\"paging\">";
  echo "<input type=\"hidden\" id=\"folder_name\" name=\"folder_link\" value=\"{$folder_link}\">";
  echo "<input type=\"hidden\" id=\"folder_name\" name=\"message\" value=\"{$e_message}\">";
  echo "</form>";
  ?>
  <script>
    var f = document.paging;
    f.action = "main.php";
    f.method = "post";
    f.submit();
  </script>