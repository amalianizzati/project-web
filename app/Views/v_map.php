<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kebencanaan Banjarnegara</title>
    <link href="https://unsorry.net/assets-date/images/favicon.png" rel="shortcut icon" type="image/png" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.1/dist/leaflet.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        html,
        body,
        #map {
            height: 100%;
            width: 100%;
            margin: 0px;
            overflow: hidden;
        }

        #map {
            width: auto;
            height: calc(100% - 56px);
            margin-top: 56px;

        }
    </style>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!--Navbar-->
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #C58940;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fa-solid fa-map-location-dot"></i><b>Peta Titik Persebaran Bencana<b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!--input data-->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (auth()->loggedIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('objek') ?>">
                                <i class="fas fa-plus-circle"></i> Input Data</a>
                        </li>
                    <?php endif; ?>

                    <!--tabel data-->
                    <?php if (auth()->loggedIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('objek/table') ?>">
                                <i class="fas fa-table"></i> Tabel Data</a>
                        </li>
                    <?php endif; ?>

                    <!--login/logout-->
                    <li class="nav-item">
                        <a class="nav-link <?= auth()->loggedIn() ? 'text-danger' : '' ?>" href="<?= auth()->loggedIn() ? base_url('logout') : base_url('login') ?>"><i class="fas fa-sign-in-alt"></i>
                            <?= auth()->loggedIn() ? 'Logout' : 'Login' ?>
                        </a>
                    </li>

                    <!--info-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#infoModal">
                            <i class="fas fa-info-circle"></i> Info</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!--Map-->
    <div id="map"></div>

    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Aplikasi Peta Persebaran Titik Bencana Kabupaten Banjarnegara yang dibangun menggunakan CodeIgniter 4 dan Database PostgreSQL</p>
                    <p>Dibuat oleh Amalia Nur Izzati</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                </div>
            </div>
        </div>
    </div>

    <script>
        /* Initial Map */
        var map = L.map("map").setView([-7.422327190013333, 109.57721968819394], 10);

        /* Tile Basemap */
        var basemap = L.tileLayer(
            "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: '<a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> | <a href="https://www.unsorry.net" target="_blank">unsorry@2022</a>',
            }
        );
        basemap.addTo(map);

        /* GeoJSON Point */
        var point = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var popupContent = "Nama : " + feature.properties.nama + "<br>" +
                    "Deskripsi: " + feature.properties.deskripsi;
                layer.on({
                    click: function(e) {
                        point.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        point.bindTooltip(feature.properties.nama);
                    },
                });
            },
        });
        $.getJSON("http://localhost:8083/PGWL_Acara4/petalokasiobjek/public/api", function(data) {
            point.addData(data);
            map.addLayer(point);
            m
        });
    </script>
</body>

</html>