<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        #map { height:950px; }
    </style>
     <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>
    <body>
        <div id="map"></div>
        <script>
    var map = L.map('map').setView([-0.3155398750904368, 117.1371634207888], 5);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 5,
    }).addTo(map);

    let data = {!! file_get_contents ("https://data.bmkg.go.id/DataMKG/TEWS/gempaterkini.json") !!}
    console.log(data);

    let gempa = data.Infogempa.gempa;

    gempa.forEach(gempa => {
        let kordinat = gempa.Coordinates.split(",");
        let _lat = kordinat[0];
        let _log = kordinat[1];

        // Buat isi popup dalam format HTML
        let popupContent = `
            <b>Wilayah:</b> ${gempa.Wilayah}<br>
            <b>Tanggal:</b> ${gempa.Tanggal}<br>
            <b>Jam:</b> ${gempa.Jam}<br>
            <b>Magnitude:</b> ${gempa.Magnitude}<br>
            <b>Kedalaman:</b> ${gempa.Kedalaman}<br>
            <b>Potensi:</b> ${gempa.Potensi}<br>
            <b>Lintang:</b> ${gempa.Lintang}<br>
            <b>Bujur:</b> ${gempa.Bujur}
        `;

        // Tambahkan marker dengan popup
        let marker = L.marker([_lat, _log]).addTo(map)
            .bindPopup(popupContent);
    });
</script>

    </body>
</html>