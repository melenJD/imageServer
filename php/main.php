<?php
  $root = "/xampp/htdocs/u/";
  $dir = "";
  if(isset($_POST['folder_link'])){
    $dir = $_POST['folder_link'];
  }
  if(isset($_POST['folderName'])){
    $fn = $_POST['folderName'];
    $link = $root;
    $link .= $dir;
    $link .= '/';
    $link .= $fn;
    $test_dir = @mkdir($link, 0700, true);
    if(!$test_dir){
      echo "<script>alert(\"이미 생성된 폴더 명입니다\")</script>";
    }
  }
  if(isset($_POST['message'])){
    $message = $_POST['message'];
    if($message != ''){
      echo "<script>alert(\"{$message}\")</script>";
    }
  }
  $root .= $dir;
  $handle = opendir($root);
  $files = array();
  $folders = array();

  while(false !== ($filename = readdir($handle))) {
    if($filename == "." || $filename == ".."){
      continue;
    }

    if(is_file($root . "/" . $filename)){
      $files[] = $filename;
    }

    if(is_dir($root . "/" . $filename)){
      $folders[] = $filename;
    }
  }

  closedir($handle);
?>
<!DOCTYPE html>
<html lang="kr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Images</title>
  <link rel="stylesheet" href="../css/main.css">
</head>
<body>
  <form name="paging">
    <input type="hidden" id="folder_name" name="folder_link">
  </form>
  <div class="background" style="display :none;" id="background"></div>
  <form method="POST" id="createFolderUi" style="display:none;">
    <h1>새 폴더</h1>
    <input type="text" name="folderName" id="folderName" placeholder="폴더 이름"><br/>
    <?php echo "<input type=\"hidden\" name=\"folder_link\" value=\"{$dir}\">"?>
    <input class="uiButton" type="submit" value="생성" id="btnCreateFolder">
    <input class="uiButton" type="button" value="취소" id="btnCreateFolderCancel">
  </form>
  <form method="POST" id="imageUploadUi" action="upload.php" enctype="multipart/form-data" style="display:none;">
    <h1>이미지 업로드</h1>
    <input type="file" name="fileToUpload" id="fileToUpload"><br/>
    <?php echo "<input type=\"hidden\" name=\"folder_link\" value=\"{$dir}\">";?>
    <?php
      echo "<input type=\"hidden\" name=\"target_dir\" value=\"{$root}\">";
    ?>
    <input class="uiButton" type="submit" value="업로드" id="btnimageUpload">
    <input class="uiButton" type="button" value="취소" id="btnImageUploadCancel">
  </form>
  <div class="menus">
    <button class="op" id="createFolder">새 폴더</button>
    <button class="op" id="imageUpload">업로드</button>
  </div>
  <div class="container">
    <table>
      <tr>
        <td colspan='2'>
        현재폴더 : <?php echo "/{$dir}" ?>
        </td>
      </tr>
      <tr>
        <td class="freeview">미리보기</td>
        <td class="fileName">파일 명</td>
      </tr>
      <?php
        sort($files);
        sort($folders);
        if($dir!=null){
          $rdir = "";
          $link = "./main.php?folder_link=";
          $links = array();
          $links = explode('/', $dir);
          $length = count($links);
          for($i=0;$i<$length-2;$i++){
            $rdir .= $links[$i];
            $rdir .= "/";
          }
          $link .= $rdir;
          echo "<tr><td colspan='2'><a class=\"upFolder\" href=\"javascript:pageMove('{$rdir}')\">↪ 상위 폴더로</a></td></tr>";
        }
        
        foreach ($folders as $f) {
          //$link = "./main.php?folder_link=";
          $link = "";
          $link .= $dir;
          $link .= $f;
          $link .= "/";
          echo "<tr><td colspan='2'><a href=\"javascript:pageMove('{$link}')\">/$f</a></td></tr>";
        }
        
        foreach ($files as $f) {
          $link = "../u/";
          $link .= $dir;
          $link .= $f;
          echo "<tr><td><img class='images' src='{$link}'/></td>";
          echo "<td><a href='{$link}'>$f</a></td></tr>";
        }
      ?>
    </table>
  </div>
  <script src="../js/api.js"></script>
</body>
</html>