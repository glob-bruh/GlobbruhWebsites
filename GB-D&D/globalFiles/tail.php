    <hr>
    <div id="footerStats">
        <p>Disk Information:</p>
        <?php 
            $x = shell_exec("df -kh .");
            echo "<pre>" . $x . "</pre>";
        ?>
    </div>
    <div id="footerStats">
        <?php
            $x = shell_exec("./ytdlp/bin/yt-dlp --version");
            echo "<p>YT-DLP VERSION: <i>" . $x . "</i>.</p>";
        ?>
        <p>WEBSITE VERSION: <i>1.0</i>.</p>
        <p><b>Do not forward to internet!</b></p>
    </div>
</body>