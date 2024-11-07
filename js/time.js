 // JavaScript for live time update
 function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true });
    document.getElementById('currentTime').textContent = timeString;
}
setInterval(updateTime, 1000); // Update every second
updateTime(); // Initial call