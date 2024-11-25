<head>
	<title>FileSpeed | Upload</title>
	<link href="upload.css" rel="stylesheet">
</head>
<?php include("header.php"); ?>
	<h2>File Upload</h2>
	<form action="uploader.php" method="POST" enctype="multipart/form-data" id="formTest">
        <input type="file" name="uploadFile" id ="fileUploadPicker"><br />
        <input type="submit" value="Upload" id="uploadBtn">
    </form>
	<p id="toswarn">Please read the <a href="info.php#guidelines">guidelines</a><br>before uploading content.</p>
<?php include("footer.php"); ?>