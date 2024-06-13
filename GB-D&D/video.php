<?php include("./globalFiles/head.php"); ?>
<link rel="stylesheet" href="video.css">
    <?php
        function getFilename($z) {
            $found = false;
            $files = scandir("./upload/");
            $name = "None";
            foreach ($files as $x) {
                $y = explode(".", $x);
                if ($y[0] == $z) {
                    $found = true;
                    $name = $x;
                }
            }
            return array(
                "found" => $found,
                "filename" => $name,
            );
        }

        $reqVid = $_GET['vid'];
        if ($_POST["proc"] == "deleteVideo") {
            $x = getFilename($_POST["name"]);
            if ($x["found"] == true) {
                unlink("./upload/" . $x["filename"]);
            }
        } else {
            $x = getFilename($reqVid);
            if ($x["found"] == true) {
                $y = $x["filename"];
                $ext = end(explode(".", $y));
                if ($ext == "part") {
                    echo "<h2 id='h2subtext'>Video is downloading...</h2>";
                    echo "<i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i>";
                    echo "<script>vidDownAutoRefresh()</script>";
                } else {
                    echo "<h2 id='h2subtext' style='display: none;'>Content has been deleted from the server!</h2>";
                    print("<video controls id='vidElem'><source id='vidSrc' src='./upload/{$y}'></video>");
                    echo "<br>";
                    print("
                    <div id='vidButton'>
                    <button onclick='downVid()' class='submitBut'>Download Video</button>
                    <button onclick='delVid()' class='submitBut'>Delete From Server</button>
                    </div>
                    ");
                    echo "<br>";
                }
            } else {
                print("<h2 id='h2subtext'>The requested file does not exist!</h2>");
            }
        }
    ?>
<?php include("./globalFiles/tail.php"); ?>