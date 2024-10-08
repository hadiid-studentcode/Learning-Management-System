  {{-- absen --}}




  <div id="mapid" style="border-radius: 10px; width:100%; height: 25vh;"></div>



  {{-- <h1>{{ $datenow }}</h1> --}}

  @php

      if ($route == 'tata-usaha') {
          $person = 1;
      } elseif ($route == 'guru') {
          $person = 2;
      } elseif ($route == 'pegawai') {
          $person = 3;
      }

  @endphp



  @if ($isAbsen)

      {{-- <div class="alert alert-success text-center mt-3 " role="alert">
          <strong>Anda Sudah Melakukan Absensi</strong>
      </div> --}}
      <div class="mt-3 " style="border: 1px solid #d4edda; color: #155724; background-color: #d4edda; padding: .75rem 1.25rem; border-radius: .25rem; text-align: center;">
        Status Absen : {{ $isAbsen->status }}
      </div>
  @else
      {{-- @if ($waktu_absenDari == null && $waktu_absenSampai == null && $datenow == null)
                <!-- Tidak ada kondisi -->
            @elseif ($datenow >= $waktu_absenDari && $datenow <= $waktu_absenSampai)
                <div class="alert alert-success text-center mt-3 " role="alert">
                    <strong>Absen Anda Dibuka!</strong>
                </div>
                <button class="btn btn-primary btn-block mt-3 " onclick="absen({{ $person }})">Lakukan Absensi</button>
            @elseif($datenow >= $waktu_absenDari && $datenow >= $waktu_absenSampai)
                <div class="alert alert-danger text-center mt-3 " role="alert">
                    <strong>Anda Terlambat!</strong>
                </div>
                <button class="btn btn-primary btn-block " onclick="absen({{ $person }})">Lakukan Absensi</button>

                @elseif($waktu_absenSampai <= $datenow)
                <div class="alert alert-danger text-center mt-3 " role="alert">
                    <strong>Absen Anda Ditutup!</strong>
                </div>

            @endif --}}


      @if ($waktu_absenDari == null && $waktu_absenSampai == null && $datenow == null)
          <!-- Tidak ada kondisi -->
      @elseif ($datenow >= $waktu_absenDari && $datenow <= date('Y-m-d H:i:s', strtotime($waktu_absenDari . '+1 hour')))


      <div class="mt-3" style="border: 1px solid #d4edda; color: #155724; background-color: #d4edda; padding: .75rem 1.25rem; border-radius: .25rem; text-align: center;" role="alert">
        <strong>Absen Anda Dibuka!</strong>
    </div>


          <button class="btn btn-primary btn-block mt-3 " onclick="absen({{ $person }})">Lakukan Absensi</button>
          {{-- <p>{{ $waktu_absenDari }} s/d {{ date('Y-m-d H:i:s', strtotime($waktu_absenDari . '+1 hour')) }}</p> --}}
      @elseif ($datenow >= date('Y-m-d H:i:s', strtotime($waktu_absenDari . '+1 hour')) && $datenow <= $waktu_absenSampai)
          <div class="mt-3 " style="border: 1px solid #d4edda; color: #155724; background-color: #d4edda; padding: .75rem 1.25rem; border-radius: .25rem; text-align: center;" role="alert">
              <strong>Anda Terlambat!</strong>
          </div>
          <button class="btn btn-primary btn-block mt-3 " onclick="absen({{ $person }})">Lakukan Absensi</button>
          {{-- <p>{{ date('Y-m-d H:i:s', strtotime($waktu_absenDari . '+1 hour')) }} s/d {{ $waktu_absenSampai }}</p> --}}
      @elseif($datenow >= $waktu_absenDari && $datenow >= $waktu_absenSampai)
      {{-- 09:00 wib >= 08:00 && 06:00 wib <= 12:00 --}}
          <div class="alert alert-danger text-center mt-3 " role="alert" id="myAlert">
              <strong>Absen Anda Ditutup!</strong>
              <script>
                  window.onload = function() {
                      window.location.href = "/{{ $route }}/absen"

                  };
              </script>
          </div>
          @else

          {{-- {{ $datenow }}   >=   {{ $waktu_absenDari }} && {{ $datenow }}   <=   {{ $waktu_absenSampai }} --}}
      @endif


  @endif

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

          const sdmkampa = {
              lat: 0.343488,
              lng: 101.192119,
          };

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



      function absen(route) {
          //jika browser mendukung navigator.geolocation maka akan menjalankan perintah di bawahnya
          if (navigator.geolocation) {
              // getCurrentPosition digunakan untuk mendapatkan lokasi pengguna
              //showPosition adalah fungsi yang akan dijalankan
              //   navigator.geolocation.getCurrentPosition(showPosition);

              navigator.geolocation.getCurrentPosition(function(position) {
                  showPosition(position, route);
              });
          }
      }


      function showPosition(position, route) {

          let person = '';

          switch (route) {
              case 1:
                  person = 'tata-usaha';
                  break;
              case 2:
                  person = 'guru';
                  break;
              case 3:
                  person = 'pegawai';
                  break;

              default:
                  break;
          }





          // posisi saya

            // const posisiSaya = {
            //     lat: position.coords.latitude,
            //     lng: position.coords.longitude,
            // };

          const posisiSaya = {
              lat: 0.343895,
              lng: 101.196351,
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
