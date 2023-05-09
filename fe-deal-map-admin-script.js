$(document).ready(function() {
    setTimeout(function () {
        window.dispatchEvent(new Event('resize'));
    }, 1000);
    //map initialization


    var map = L.map('map-admin', {doubleClickZoom: false}).locate({setView: true, maxZoom: 16});

    const osmAttribution = '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>';
    const osmUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
    map.attributionControl.addAttribution('Licensed by &copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>');
});