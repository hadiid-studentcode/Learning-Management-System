<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    {{-- leaflet --}}


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .leaflet-container {
            height: 400px;
            width: 600px;
            max-width: 100%;
            max-height: 100%;
        }
    </style>

    <style>
        body {
            padding: 0;
            margin: 0;
        }

        #mapid {
            height: 50%;
            width: 100vw;
        }
    </style>

</head>

<body>
    <div id="mapid"></div>

  
    @if($kelola->tanggal == $date && $kelola->waktu_mulai < $time && $kelola->waktu_selesai > $time)
    <button class="btn btn-primary" onclick="absen({{ $id_guru }})">Lakukan Absensi</button>
    @endif


    {{-- <form action="{{ url('/absensi') }}" method="POST">
      
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <label for="idguru">idguru</label>
        <input type="text" name="idguru" id=""> <br>

          <label for="tanggal">tanggal</label>
        <input type="date" name="tanggal" id=""> <br>
          <label for="waktudatang">waktu datang</label>
        <input type="time" name="waktudatang" id=""> <br>

        <label for="waktupulang">waktu pulang</label>
        <input type="time" name="waktupulang" id=""> <br>
        <select name="status" id="">
            <option value="Hadir">Hadir</option>
            <option value="Sakit">Sakit</option>
            <option value="Izin">Izin</option>
            <option value="Tidak Hadir">Tidak Hadir</option>
        </select> <br>

        <label for="point">point</label>
        <input type="text" name="poin" id="">

        <button type="submit">Simpan</button>

    </form> --}}



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>



    <script>
        //mengambil elemen lokasi dan memasukannya ke dalam variabel lokasi

        addEventListener('load', function() {
            //jika browser mendukung navigator.geolocation maka akan menjalankan perintah di bawahnya


            if (navigator.geolocation) {
                // getCurrentPosition digunakan untuk mendapatkan lokasi pengguna
                //showPosition adalah fungsi yang akan dijalankan

                navigator.geolocation.getCurrentPosition(viewMaps);
            }
        });

        function viewMaps(position) {


            const lat = position.coords.latitude;
            const lng = position.coords.longitude;

            // const sdmkampa = {
            //     lat: 0.343488,
            //     lng: 101.192119,
            // };

            //   const lat = 0.343488,
            //       const lng = 0.343482,

            var mymap = L.map("mapid").setView([lat, lng], 13);

            //setting maps menggunakan api mapbox bukan google maps, daftar dan dapatkan token
            L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery Â© <a href="https://www.mapbox.com/">Mapbox</a>',
                id: "mapbox/streets-v11",
                tileSize: 512,
                zoomOffset: -1,
            }).addTo(mymap);
            //menambahkan marker letak posisi dengan lat dan lng yang telah didapat sebelumnya
            L.marker([lat, lng])
                .addTo(mymap)
                .bindPopup("<b>Hai!</b><br />Ini adalah lokasi Kamu Saat ini");

            //   L.marker([sdmkampa.lat, sdmkampa.lng])
            //       .addTo(mymap)
            //       .bindPopup("<b>Hai!</b><br />Ini adalah sekolah mu");
            //   var circle = L.circle([sdmkampa.lat, sdmkampa.lng], {
            //       color: "red",
            //       fillColor: "#f03",
            //       fillOpacity: 0.5,
            //       radius: 100,
            //   }).addTo(mymap);
        }



        function absen(id_guru) {
            //jika browser mendukung navigator.geolocation maka akan menjalankan perintah di bawahnya
            if (navigator.geolocation) {
                // getCurrentPosition digunakan untuk mendapatkan lokasi pengguna
                //showPosition adalah fungsi yang akan dijalankan
                //   navigator.geolocation.getCurrentPosition(showPosition);



                navigator.geolocation.getCurrentPosition(function(position) {


                    getAbsen(position, id_guru);
                });
            }
        }


        function getAbsen(position, id_guru) {





            // posisi saya

            // const posisiSaya = {
            //     lat: position.coords.latitude,
            //     lng: position.coords.longitude,
            // };

            const posisiSaya = {
                lat: 0.889648,
                lng: 101.241822,
            };




            // posisi sekolah sd muhammadiyah kampa

            //   const sdmkampa = {
            //       lat: 0.343488,
            //       lng: 101.192119,
            //   };

            //   const lat = sdmkampa.lat;
            //   const lng = sdmkampa.lng;

            //    koordinat posisi sekolah sd Muhammadiyah Kampa

            const latlng_kiri = {
                lat: 0.889646,
                lng: 101.241678,
            };
            const latlng_kanan = {
                lat: 0.889693,
                lng: 101.241980,
            };

            const latlng_bawah = {
                lat: 0.889532,
                lng: 101.241850,
            };

            const latlng_atas = {
                lat: 0.889818,
                lng: 101.241842,
            };
            // kondisi absensi jika user berada di sekolah

            if (
                posisiSaya.lat >= latlng_bawah.lat &&
                posisiSaya.lat <= latlng_atas.lat &&
                posisiSaya.lng >= latlng_kiri.lng &&
                posisiSaya.lng <= latlng_kanan.lng
            ) {
                Swal.fire("Absen Diterima", "Anda Berada Disekolah", "success");





                // Membuat elemen form secara dinamis
                const form = document.createElement('form');
                form.method = 'GET';
                form.action = '/' + person + '/absen';






                // Membuat elemen input untuk data yang ingin dikirim
                const inputWaktu = document.createElement('input');
                inputWaktu.type = 'hidden';
                inputWaktu.name = 'waktu';

                const datetime = new Date();
                const date = datetime.getFullYear() + '-' + String(datetime.getMonth() + 1).padStart(2, '0') + '-' +
                    datetime.getDate() + ' ' + datetime.getHours() + ':' + datetime.getMinutes() + ':' + datetime
                    .getSeconds();






                inputWaktu.value = date;
                form.appendChild(inputWaktu);


                // Menambahkan form ke body dokument
                document.body.appendChild(form);

                // Mengirim form
                form.submit();


            } else {
                Swal.fire("Absen Tidak Diterima", "Anda Tidak Berada Disekolah", "error");
            }
            //   var mymap = L.map("mapid").setView([lat, lng], 13);

            //   //setting maps menggunakan api mapbox bukan google maps, daftar dan dapatkan token
            //   L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
            //       maxZoom: 18,
            //       attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            //           '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            //           'Imagery Â© <a href="https://www.mapbox.com/">Mapbox</a>',
            //       id: "mapbox/streets-v11",
            //       tileSize: 512,
            //       zoomOffset: -1,
            //   }).addTo(mymap);
            //menambahkan marker letak posisi dengan lat dan lng yang telah didapat sebelumnya
            L.marker([lat, lng])
                .addTo(mymap)
                .bindPopup("<b>Hai!</b><br />Ini adalah lokasi mu");

            //   L.marker([sdmkampa.lat, sdmkampa.lng])
            //       .addTo(mymap)
            //       .bindPopup("<b>Hai!</b><br />Ini adalah sekolah mu");
            //   var circle = L.circle([sdmkampa.lat, sdmkampa.lng], {
            //       color: "red",
            //       fillColor: "#f03",
            //       fillOpacity: 0.5,
            //       radius: 200,
            //   }).addTo(mymap);
        }
    </script>




</body>

</html>
