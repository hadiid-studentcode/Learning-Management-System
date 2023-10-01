  {{-- absen --}}




  <div id="mapid" style="border-radius: 10px; width:100%; height: 300px"></div>



  {{-- <h1>{{ $datenow }}</h1> --}}



  <div class="container">
      <div class="row justify-content-center mt-5">
          <div class="col-lg-6 col-md-8">
              @if ($waktu_absenDari == null && $waktu_absenSampai == null && $datenow == null)
              @elseif ($datenow >= $waktu_absenDari && $datenow <= $waktu_absenSampai)
                  <div class="alert alert-success text-center" role="alert">
                      <strong>Absen Anda Dibuka!</strong>
                  </div>
                  <button class="btn btn-primary btn-block mt-3" onclick="absen()">Lakukan Absensi</button>
              @elseif($datenow >= $waktu_absenDari && $datenow >= $waktu_absenSampai)
                  <div class="alert alert-danger text-center" role="alert">
                      <strong>Anda Terlambat!</strong>
                  </div>
                  <button class="btn btn-primary btn-block mt-3" onclick="absen()">Lakukan Absensi</button>
              @endif
          </div>
      </div>
  </div>
  {{-- absen --}}

	
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
              .bindPopup("<b>Hai!</b><br />Ini adalah lokasi mu");

          L.marker([sdmkampa.lat, sdmkampa.lng])
              .addTo(mymap)
              .bindPopup("<b>Hai!</b><br />Ini adalah sekolah mu");
          var circle = L.circle([sdmkampa.lat, sdmkampa.lng], {
              color: "red",
              fillColor: "#f03",
              fillOpacity: 0.5,
              radius: 200,
          }).addTo(mymap);
      }



      function absen() {
          //jika browser mendukung navigator.geolocation maka akan menjalankan perintah di bawahnya
          if (navigator.geolocation) {
              // getCurrentPosition digunakan untuk mendapatkan lokasi pengguna
              //showPosition adalah fungsi yang akan dijalankan
              navigator.geolocation.getCurrentPosition(showPosition);
          }
      }

      function showPosition(position) {
          // posisi saya
         
	const posisiSaya = {
    lat: position.coords.latitude,
    lng: position.coords.longitude,
};

          // posisi sekolah sd muhammadiyah kampa

          // const sdmkampa = {
          //     lat: 0.343488,
          //     lng: 101.192119,
          // };

          // const lat = sdmkampa.lat;
          // const lng = sdmkampa.lng;

          //    koordinat posisi sekolah sd Muhammadiyah Kampa

          const latlng_kiri = {
              lat: 0.343990,
              lng: 101.188417,
          };
          const latlng_kanan = {
              lat: 0.343895,
              lng: 101.196351,
          };

          const latlng_bawah = {
              lat: 0.339446,
              lng: 101.192226,
          };

          const latlng_atas = {
              lat: 0.348176,
              lng: 101.192365,
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
              form.action = '/tata-usaha/absen';


              // Membuat elemen input untuk CSRF token



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

          L.marker([sdmkampa.lat, sdmkampa.lng])
              .addTo(mymap)
              .bindPopup("<b>Hai!</b><br />Ini adalah sekolah mu");
          var circle = L.circle([sdmkampa.lat, sdmkampa.lng], {
              color: "red",
              fillColor: "#f03",
              fillOpacity: 0.5,
              radius: 200,
          }).addTo(mymap);
      }
  </script>



