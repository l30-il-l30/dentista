document.addEventListener("DOMContentLoaded", function() {
    if(document.getElementById("map")) {
        const map = L.map("map").setView([41.2289786, 16.490343], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const dentalIcon = L.icon({
            iconUrl: 'assets/img/ping.svg',
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        L.marker([41.2289786, 16.490343], {icon: dentalIcon})
            .addTo(map)
            .bindPopup("Studio Dentistico Sant'Andrea<br> Via don Tonino Bello, 5")
            .openPopup();
    }
})