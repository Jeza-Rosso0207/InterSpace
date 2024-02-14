document.addEventListener("DOMContentLoaded", function() {
    const videoPlayer = document.getElementById("videoPlayer");

    videoPlayer.addEventListener("canplaythrough", function() {
        // Reproducir el video
        videoPlayer.play();
    });

    videoPlayer.addEventListener("ended", function() {
        document.querySelector(".intro-video").style.display = "none";
        document.querySelector(".inicio").style.display = "block";
    });
});
