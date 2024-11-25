<head>
	<title>FileSpeed | Upload</title>
	<link href="uploader.css" rel="stylesheet">
</head>
<?php include("header.php"); ?>

<!-- PHP UPLOAD SCRIPT -->
<?php
if($_FILES['uploadFile']['error'] == 4) {
    echo '<h3 id="redFileTitle">No file was selected</h3>';
    echo '<p id="subtext">Please return to the <a href="upload.php">upload</a> page and pick a file.</p>';
} else {
  if ($_FILES['uploadFile']['error'] === UPLOAD_ERR_OK) {
      $fileName = $_FILES['uploadFile']['name'];
      $fileTempPath = $_FILES['uploadFile']['tmp_name'];
      $fileMD5 = md5_file($fileTempPath);
      $fileSHA = sha1_file($fileTempPath);
      $fileSize = filesize($fileTempPath);
      $badFile = false;
      $badSHA1 = false;
      $badExt = false;
      $bannedFileL = file('./configuration/bannedSHA1.txt');
      $bannedExtL = file('./configuration/bannedExtension.txt');
      foreach($bannedFileL as $line) {
        if (strtolower($line) == $fileSHA) {
          $badFile = true;
          $badSHA1 = true;
        }
      }
      if (isset(pathinfo($fileName)['extension'])) {
        $fileExtension = pathinfo($fileName)['extension'];
      } else {
        $fileExtension = "NoExt";
      }
      foreach($bannedExtL as $line) {
        $line = preg_replace('/\s+/', '', $line);
        if ($fileExtension == $line) {
          $badFile = true;
          $badExt = true;
        }
      }
      $genFilename = "";
      while (file_exists(dirname(__FILE__).'/uploads/'.$genFilename)) {
        for ($x = 0; $x <= 25; $x++) {
          $s = substr(sha1(mt_rand()),8,1);
          if (!is_numeric($s)) {
            if ((bool)random_int(0, 1)) {
              $s = strtoupper($s);
            }
          }
          $genFilename .= $s;
        }
        $genFilename .= '.'.$fileExtension;
      }
      if ($badFile != true) {
        if(move_uploaded_file($fileTempPath, dirname(__FILE__).'/uploads/'.$genFilename)) {
          // FILE passed 
          $finalOut = 'PASS';
          echo '<h3 id="greenFileTitle">File has been uploaded</h3>';
          echo '<p id="subtext">The link to view and/or download this file is below:</p>';
          echo '<p id="subtext"><a href="http://'.$_SERVER[HTTP_HOST].'/uploads/'.$genFilename.'">http://'.$_SERVER[HTTP_HOST].'/uploads/'.$genFilename.'</p>';
        } else {
          // FILE failed
          $finalOut = 'FAIL';
          echo '<h3 id="redFileTitle">File upload error</h3>';
          echo '<p id="subtext">Please <a href="info.php#contact">contact us</a> or come back later.</p>';
        }
      } else {
        unlink($fileTempPath);
        if ($badSHA1 == true) {
          // FILE banned
          $finalOut = 'BADF';
          echo '<h3 id="redFileTitle">THIS FILE IS BANNED</h3>';
          echo '<p id="subtext">The file you uploaded was mannually reviewed and we determined to not allow it on FileSpeed.<br />We reccomend you read our <a href="info.php#guidelines">guidelines</a>.</p>';
        }
        if ($badExt == true) {
          // EXTENSION banned
          $finalOut = "BADE";
          echo '<h3 id="redFileTitle">This file extension is not permitted</h3>';
          echo '<p id="subtext">The file you uploaded has the extension of '.$fileExtension.', which is not allowed on FileSpeed.</p>';
        }
      }
    if (!isset($_SERVER['HTTP_USER_AGENT'])) {
      $useragent = 'Nothing Came Back';
    } else {
      $useragent = $_SERVER['HTTP_USER_AGENT'];
    }
    if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $proxy = 'Nothing Came Back';
    } else {
      $proxy = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    $logFile = fopen('./configuration/log.txt', 'a');
    fwrite($logFile, '['.date("Y-m-d h:i:sa").'] Generated File Name: '.$genFilename.', Original File Name: '.$fileName.', Source: '.$_SERVER['REMOTE_ADDR'].':'.$_SERVER['REMOTE_PORT'].', Proxy: '.$proxy.', User Agent: #'.$useragent.'#, File Size (Bytes): '.$fileSize.', File MD5: '.$fileMD5.', File SHA1: '.$fileSHA.', Status: '.$finalOut.PHP_EOL);
    fclose($logFile);
  }
}
?>
<!-- END OF PHP UPLOAD SCRIPT -->

<?php include("footer.php"); ?>