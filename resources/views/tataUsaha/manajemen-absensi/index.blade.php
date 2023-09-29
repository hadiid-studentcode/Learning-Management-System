@extends('layouts.main')

@section('main')
<div class="">
    <div class="card card-custom">
        <div class="card-body">
            <div class="d-flex flex-column align-items-center">
                <h2 class="text-dark-75 text-center ">Jadwal Absensi Guru dan Karyawan</h2>
                <p class="text-dark-50 text-center">Silakan Atur Jam Absensi dan atur keterangan Absensi Karyawan dan
                    guru.</p>
            </div>
        </div>
    </div>
</div>


<div class="" style="width:auto;">
    <div class="card card-custom" id="data_pertemuan">
        <div class="card-body">
            <div class="card-toolbar">
                <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
                    <li class="nav-item mr-3">
                        <a class="nav-link active" href="{{ url('tata-usaha/manajemen-absensi') }}">
                            <span class="nav-icon">
                                <span class="svg-icon mr-3"></span>
                                <svg width="25px" height="25x" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M19.5001 8.27355C19.5035 8.46127 19.4015 8.6351 19.236 8.72365L16.5982 10.1343L19.2196 11.4146C19.3883 11.497 19.4966 11.667 19.5001 11.8547C19.5035 12.0424 19.4015 12.2163 19.236 12.3048L16.598 13.7156L19.2195 14.9959C19.3882 15.0783 19.4966 15.2483 19.5 15.436C19.5035 15.6237 19.4015 15.7976 19.2359 15.8861L12.7074 19.3775C12.2655 19.6139 11.7346 19.6139 11.2927 19.3775L4.7642 15.8861C4.59864 15.7976 4.49663 15.6237 4.50008 15.436C4.50354 15.2483 4.61186 15.0783 4.78057 14.9959L7.40214 13.7156L4.76426 12.3048C4.59869 12.2163 4.49669 12.0424 4.50014 11.8547C4.50359 11.667 4.61192 11.497 4.78063 11.4146L7.40205 10.1343L4.76426 8.72365C4.59869 8.6351 4.49669 8.46127 4.50014 8.27355C4.50359 8.08582 4.61192 7.91586 4.78063 7.83346L11.3418 4.62897C11.7572 4.42609 12.243 4.42609 12.6584 4.62897L19.2196 7.83346C19.3883 7.91586 19.4966 8.08582 19.5001 8.27355ZM8.4898 14.2972L6.09799 15.4654L11.7643 18.4957C11.9116 18.5745 12.0885 18.5745 12.2358 18.4957L17.9021 15.4654L15.5104 14.2973L12.7075 15.7962C12.2655 16.0326 11.7347 16.0326 11.2927 15.7962L8.4898 14.2972ZM12.7075 12.2151L15.5105 10.716L17.9022 11.8841L12.2359 14.9144C12.0886 14.9932 11.9116 14.9932 11.7643 14.9144L6.09804 11.8841L8.48971 10.716L11.2927 12.2151C11.7347 12.4514 12.2655 12.4514 12.7075 12.2151ZM17.9022 8.30293L12.2195 5.52753C12.0811 5.4599 11.9191 5.4599 11.7807 5.52753L6.09804 8.30293L11.7643 11.3332C11.9116 11.412 12.0886 11.412 12.2359 11.3332L17.9022 8.30293Z"
                                    fill="#47495F" />
                            </svg>
                                <span class="nav-text font-size-sm">Buka</span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link" href="{{ url('tata-usaha/manajemen-absensi/create') }}">
                            <span class="nav-icon">
                                <span class="svg-icon mr-3"></span>
                                <svg width="25px" height="25x" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M19.5001 8.27355C19.5035 8.46127 19.4015 8.6351 19.236 8.72365L16.5982 10.1343L19.2196 11.4146C19.3883 11.497 19.4966 11.667 19.5001 11.8547C19.5035 12.0424 19.4015 12.2163 19.236 12.3048L16.598 13.7156L19.2195 14.9959C19.3882 15.0783 19.4966 15.2483 19.5 15.436C19.5035 15.6237 19.4015 15.7976 19.2359 15.8861L12.7074 19.3775C12.2655 19.6139 11.7346 19.6139 11.2927 19.3775L4.7642 15.8861C4.59864 15.7976 4.49663 15.6237 4.50008 15.436C4.50354 15.2483 4.61186 15.0783 4.78057 14.9959L7.40214 13.7156L4.76426 12.3048C4.59869 12.2163 4.49669 12.0424 4.50014 11.8547C4.50359 11.667 4.61192 11.497 4.78063 11.4146L7.40205 10.1343L4.76426 8.72365C4.59869 8.6351 4.49669 8.46127 4.50014 8.27355C4.50359 8.08582 4.61192 7.91586 4.78063 7.83346L11.3418 4.62897C11.7572 4.42609 12.243 4.42609 12.6584 4.62897L19.2196 7.83346C19.3883 7.91586 19.4966 8.08582 19.5001 8.27355ZM8.4898 14.2972L6.09799 15.4654L11.7643 18.4957C11.9116 18.5745 12.0885 18.5745 12.2358 18.4957L17.9021 15.4654L15.5104 14.2973L12.7075 15.7962C12.2655 16.0326 11.7347 16.0326 11.2927 15.7962L8.4898 14.2972ZM12.7075 12.2151L15.5105 10.716L17.9022 11.8841L12.2359 14.9144C12.0886 14.9932 11.9116 14.9932 11.7643 14.9144L6.09804 11.8841L8.48971 10.716L11.2927 12.2151C11.7347 12.4514 12.2655 12.4514 12.7075 12.2151ZM17.9022 8.30293L12.2195 5.52753C12.0811 5.4599 11.9191 5.4599 11.7807 5.52753L6.09804 8.30293L11.7643 11.3332C11.9116 11.412 12.0886 11.412 12.2359 11.3332L17.9022 8.30293Z"
                                    fill="#47495F" />
                            </svg>
                                <span class="nav-text font-size-sm">Edit</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

    
    <div id="input" class="page">
        <div class="" id="input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b">
                        <div class="card-body ">
                            <h2 class="text-dark-75 text-center mt-2">Buka Absensi</h2>
                            <hr>
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{ url('tata-usaha/manajemen-absensi') }}" method="post">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addEventModalLabel">Masukkan Absen</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="eventDate">Tanggal Hari Ini:</label>
                                    <input type="text" id="eventDate" name="tanggal" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="startTime">Absen Dibuka :</label>
                                    <input type="time" id="startTime" name="waktu_mulai" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="endTime">Absen Berakhir:</label>
                                    <input type="time" id="endTime" name="waktu_selesai" class="form-control">

                                
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="addEventButton">Submit </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Include FullCalendar and Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.5.1/main.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.5.0/main.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

           <script>
            document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 650,
        events: 'fetchEvents.php',
        selectable: true,
        eventStartEditable: true, // Menambahkan kemampuan untuk mengedit tanggal mulai
        select: function(info) {
            openAddEventModal(info.start);
        },
    });

    calendar.render();

    function openAddEventModal(selectedDate) {
        $('#addEventModal').modal('show');

        var eventDateInput = document.getElementById('eventDate');
        var formattedDate = formatDate(selectedDate);
        eventDateInput.value = formattedDate;

        document.getElementById('addEventButton').addEventListener('click', function() {
            var startTime = document.getElementById('startTime').value;
            var endTime = document.getElementById('endTime').value;

            var startDateTime = new Date(selectedDate);
            var startTimeParts = startTime.split(':');
            startDateTime.setHours(parseInt(startTimeParts[0], 10));
            startDateTime.setMinutes(parseInt(startTimeParts[1], 10));

            var endDateTime = new Date(selectedDate);
            var endTimeParts = endTime.split(':');
            endDateTime.setHours(parseInt(endTimeParts[0], 10));
            endDateTime.setMinutes(parseInt(endTimeParts[1], 10));

            fetch("eventHandler.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        request_type: 'addEvent',
                        start: startDateTime.toISOString(),
                        end: endDateTime.toISOString()
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status == 1) {
                        Swal.fire('Event Add feature is disabled for this demo!', '',
                        'warning');
                    } else {
                        Swal.fire(data.error, '', 'error');
                    }

                    $('#addEventModal').modal('hide');

                    calendar.refetchEvents();
                })
                .catch(console.error);
        });
    }

    function formatDate(date) {
        var day = String(date.getDate()).padStart(2, '0');
        var month = String(date.getMonth() + 1).padStart(2, '0');
        var year = date.getFullYear();

        return year + '-' + month + '-' + day;
    }
});

           </script>

        </div>
    </div>


    {{-- <div class="page" id="rekap" style="display: none;">
        <div class="">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <h2 class="text-center text-uppercase mt-2">Edit Absensi</h2>
                            <hr>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <form>
                                        <div class="form-group">
                                            <label for="tanggal">Pilih Tanggal:</label>
                                            <input type="date" class="form-control" id="tanggal">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary mb-4">Tampilkan Absensi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <h5 class="text-center text-uppercase mb-4">Data Absensi Guru</h5>
                            <div class="table-responsive">
                              <table class="table table-bordered table-striped" style="text-align: center; font-size:90%;">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Waktu</th>
                                        <th>Status Absensi</th>
                                        <th>Edit Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Guru A</td>
                                        <td>08:00</td>
                                        <td>Hadir</td>
                                        <td>
                                            <select class="form-control">
                                                <option value="" hidden>Pilih</option>
                                                <option value="hadir">Hadir</option>
                                                <option value="izin">Izin</option>
                                                <option value="sakit">Sakit</option>
                                                <option value="mangkir">Mangkir</option>
                                            </select>
                                        </td>
                                        <td><button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Guru A</td>
                                        <td>08:00</td>
                                        <td>Hadir</td>
                                        <td>
                                            <select class="form-control">
                                                <option value="" hidden>Pilih</option>
                                                <option value="hadir">Hadir</option>
                                                <option value="izin">Izin</option>
                                                <option value="sakit">Sakit</option>
                                                <option value="mangkir">Mangkir</option>
                                            </select>
                                        </td>
                                        <td><button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Guru A</td>
                                        <td>08:00</td>
                                        <td>Hadir</td>
                                        <td>
                                            <select class="form-control">
                                                <option value="" hidden>Pilih</option>
                                                <option value="hadir">Hadir</option>
                                                <option value="izin">Izin</option>
                                                <option value="sakit">Sakit</option>
                                                <option value="mangkir">Mangkir</option>
                                            </select>
                                        </td>
                                        <td><button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                              </div>
                           
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <h5 class="text-center text-uppercase mb-4">Data Absensi Pegawai</h5>
                            <div class="table-responsive">
                             <table class="table table-bordered table-striped" style="text-align: center; font-size:90%;">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Waktu</th>
                                        <th>Status Absensi</th>
                                        <th>Edit Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Pegawai </td>
                                        <td>09:00 </td>
                                        <td>Hadir</td>
                                        <td>
                                            <select class="form-control">
                                                <option value="" hidden>Pilih</option>
                                                <option value="hadir">Hadir</option>
                                                <option value="izin">Izin</option>
                                                <option value="sakit">Sakit</option>
                                                <option value="mangkir">Mangkir</option>
                                            </select>
                                        </td>
                                        <td><button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pegawai</td>
                                        <td>08:00</td>
                                        <td>Hadir</td>
                                        <td>
                                            <select class="form-control">
                                                <option value="" hidden>Pilih</option>
                                                <option value="hadir">Hadir</option>
                                                <option value="izin">Izin</option>
                                                <option value="sakit">Sakit</option>
                                                <option value="mangkir">Mangkir</option>
                                            </select>
                                        </td>
                                        <td><button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Pegawai</td>
                                        <td>08:00</td>
                                        <td>Hadir</td>
                                        <td>
                                            <select class="form-control">
                                                <option value="" hidden>Pilih</option>
                                                <option value="hadir">Hadir</option>
                                                <option value="izin">Izin</option>
                                                <option value="sakit">Sakit</option>
                                                <option value="mangkir">Mangkir</option>
                                            </select>
                                        </td>
                                        <td><button class="btn btn-sm btn-success"><i class="fas fa-check"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                              </div>
                           
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var currentPage = sessionStorage.getItem("currentPage");
            if (currentPage) {
                showPage(currentPage);
            } else {
                showPage("input");
            }
        });

        function showPage(pageId) {
            var pages = document.getElementsByClassName("page");
            for (var i = 0; i < pages.length; i++) {
                if (pages[i].id === pageId) {
                    pages[i].style.display = "block";
                } else {
                    pages[i].style.display = "none";
                }
            }
            sessionStorage.setItem("currentPage", pageId);
        }

        window.addEventListener("beforeunload", function() {
            sessionStorage.removeItem("currentPage");
        });
    </script> --}}
@endsection
