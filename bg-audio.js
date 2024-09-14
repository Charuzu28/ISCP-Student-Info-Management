function nextPage() {
    window.location.href = "login.php";
}

function moveButton() {
    var x = Math.random() * (window.innerWidth - document.getElementById('noButton').offsetWidth) - 85;
    var y = Math.random() * (window.innerHeight - document.getElementById('noButton').offsetHeight) - 48;
    document.getElementById('noButton').style.left = `${x}px`;
    document.getElementById('noButton').style.top = `${y}px`;
}

function playAudio() {
    var audio = document.getElementById('backgroundAudio');
    audio.volume = 0.5;
    audio.play();
}

window.onload = function() {
    playAudio();
}