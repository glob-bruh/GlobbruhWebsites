<?php include("./globalFiles/head.php"); ?>
<link rel="stylesheet" href="index.css">
    <img src="logo.png"></img>
    <br>
    <form method="POST">
        <input type="text" name="vidUrl" placeholder="Enter URL Here"></input>
        <input type="submit" value="Simple Download" class="submitBut"></input>
    </form>
    <p>
        <?php
            if(array_key_exists("vidUrl", $_POST) && trim($_POST["vidUrl"]) !== "") {
                $vidUrl = $_POST["vidUrl"];
                $vidID = rand(1000000000, 9999999999);
                $x = shell_exec("./ytdlp/bin/yt-dlp --output '/var/www/html/GB-YTDLP/upload/" . $vidID . ".%(ext)s' " . $vidUrl . " > /dev/null 2>&1 &");
                sleep(7);
                echo "<script>redirToVid(" . $vidID . ")</script>";
            }
        ?>
    </p>
<?php include("./globalFiles/tail.php"); ?>