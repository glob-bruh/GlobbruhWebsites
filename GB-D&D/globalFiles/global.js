function vidCheck() {
    if (document.getElementById("vidSrc") != null) {
        return true;
    } else {
        return false;
    }
}

function downVid() {
    if (vidCheck() == true) {
        window.open(document.getElementById("vidSrc").src);
    } else {
        console.log("No video to download.");
    }
}

function redirToVid(vidUrl) {
    window.location.href = "video.php?vid=" + vidUrl;
}

function delVid() {
    confirmResult = window.confirm("Are you sure you want to delete this file off the server?");
    if (confirmResult == true) {
        const x = new URLSearchParams(window.location.search);
        const y = x.get("vid");
        z = new FormData;
        z.append("proc", "deleteVideo");
        z.append("name", y);
        fetch("video.php", {method: "POST", body: z} );
        document.getElementById("vidElem").remove();
        document.getElementById("vidButton").remove();
        document.getElementById("h2subtext").style.display = "block";
    }
}

const delay = ms => new Promise(res => setTimeout(res, ms));
const vidDownAutoRefresh = async () => {
    console.log("Auto Refresh Started!")
    await delay(15000);
    location.reload();
  }