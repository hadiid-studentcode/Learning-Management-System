<?php

use App\Http\Controllers\Guru\AturKkmGuruController;
use App\Http\Controllers\Guru\DashboardGuruController;
use App\Http\Controllers\Guru\JadwalGuruController;
use App\Http\Controllers\Guru\manajemenNilaiGuruController;
use App\Http\Controllers\Guru\ManajemenSiswaGuruController;
use App\Http\Controllers\Guru\PesanGuruController;
use App\Http\Controllers\Guru\RekapNilaiGuruController;
use App\Http\Controllers\Guru\SettingsGuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\Pegawai\DashboardPegawaiController;
use App\Http\Controllers\Pegawai\PesanPegawaiController;
use App\Http\Controllers\Pegawai\SettingsPegawaiController;
use App\Http\Controllers\Siswa\DashboardSiswaController;
use App\Http\Controllers\Siswa\JadwalSiswaController;
use App\Http\Controllers\Siswa\PesanSiswaController;
use App\Http\Controllers\Siswa\SettingsSiswaController;
use App\Http\Controllers\SuperUser\DashboardSuperUserController;
use App\Http\Controllers\SuperUser\KeuanganSuperUserController;
use App\Http\Controllers\SuperUser\KinerjaGuruSuperUserController;
use App\Http\Controllers\SuperUser\LaporanKeuanganSuperUserController;
use App\Http\Controllers\SuperUser\NilaiSiswaSuperUserController;
use App\Http\Controllers\SuperUser\PembayaranSiswaSuperUserController;
use App\Http\Controllers\SuperUser\PesanSuperUserController;
use App\Http\Controllers\SuperUser\RekapKeuanganSuperUserController;
use App\Http\Controllers\SuperUser\SettingSuperUserController;
use App\Http\Controllers\TataUsaha\DashboardTataUsahaController;
use App\Http\Controllers\TataUsaha\GalleryTataUsahaController;
use App\Http\Controllers\TataUsaha\KinerjaGuruTataUsahaController;
use App\Http\Controllers\TataUsaha\ManajemenAbsensiTataUsahaController;
use App\Http\Controllers\TataUsaha\ManajemenAkunTataUsahaController;
use App\Http\Controllers\TataUsaha\ManajemenGuruTataUsahaController;
use App\Http\Controllers\TataUsaha\ManajemenKelasTataUsahaController;
use App\Http\Controllers\TataUsaha\ManajemenMataPelajaranTataUsahaController;
use App\Http\Controllers\TataUsaha\ManajemenPegawaiTataUsahaController;
use App\Http\Controllers\TataUsaha\ManajemenSiswaTataUsahaController;
use App\Http\Controllers\TataUsaha\MintaAksesTataUsahaController;
use App\Http\Controllers\TataUsaha\PemasukanKeuanganTataUsahaController;
use App\Http\Controllers\TataUsaha\PembayaranTataUsahaController;
use App\Http\Controllers\TataUsaha\PengeluaranKeuanganTataUsahaController;
use App\Http\Controllers\TataUsaha\PesanTataUsahaController;
use App\Http\Controllers\TataUsaha\PrestasiSiswaTataUsahaController;
use App\Http\Controllers\TataUsaha\RekapKeuanganTataUsahaController;
use App\Http\Controllers\TataUsaha\SettingsTataUsahaController;
use App\Http\Controllers\Users\User_GuruController;
use App\Http\Controllers\Users\User_PegawaiController;
use App\Http\Controllers\Users\User_SiswaController;
use App\Http\Controllers\Users\User_SuperUserController;
use App\Http\Controllers\Users\User_TataUsahaController;
use App\Http\Controllers\Users\User_WaliMuridController;
use App\Http\Controllers\WaliMurid\DashboardWaliMuridController;
use App\Http\Controllers\WaliMurid\MataPelajaranWaliMuridController;
use App\Http\Controllers\WaliMurid\PembayaranWaliMuridController;
use App\Http\Controllers\WaliMurid\PesanWaliMuridController;
use App\Http\Controllers\WaliMurid\PrestasiSiswaWaliMuridController;
use App\Http\Controllers\WaliMurid\ProfileSiswaWaliMuridController;
use App\Http\Controllers\WaliMurid\RekapNilaiWaliMuridController;
use App\Http\Controllers\WaliMurid\SettingsWaliMuridController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// SCRIPT DILARANG DIUBAH ============================================================================

// halaman home
Route::resource('/', HomeController::class);

Route::get('/maps', function () {
    return view('maps');
});

// id : 12345
// pass : 12345

// halaman login guru
Route::get('/guru/auth', [User_GuruController::class, 'index'])->middleware('guest.guru')->name('login.guru');
Route::post('/guru/auth', [User_GuruController::class, 'authenticate'])->middleware('guest.guru');

Route::group(
    [
        'middleware' => ['auth.guru', 'hak_akses:Guru', 'preventBackHistory'],
    ],
    function () {
        Route::get('/guru', function () {
            return redirect('/guru/dashboard');
        });
        Route::resource('/guru/dashboard', DashboardGuruController::class);
        Route::get('/guru/absen', [DashboardGuruController::class, 'absen']);

        Route::resource('/guru/jadwal', JadwalGuruController::class);

        Route::resource('/guru/pesan', PesanGuruController::class);
        Route::get('guru/pesan/search/inbox', [PesanGuruController::class, 'search']);

        Route::post('guru/pesan/balas/{id}', [PesanGuruController::class, 'balas']);
        Route::resource('/guru/rekap-nilai', RekapNilaiGuruController::class);
        Route::resource('/guru/manajemen-siswa', ManajemenSiswaGuruController::class);

        Route::resource('/guru/atur-kkm', AturKkmGuruController::class);
        Route::resource('/guru/manajemen-nilai', manajemenNilaiGuruController::class);

        Route::resource('/guru/setting', SettingsGuruController::class);
        Route::get('guru/jadwal/cek/{jenis}/{kode_mapel}', [JadwalGuruController::class, 'detailMapel']);
        Route::post('guru/jadwal/cek/materi/{kode}', [JadwalGuruController::class, 'uploadMateri']);
        Route::post('guru/jadwal/cek/tugas/{kode}', [JadwalGuruController::class, 'uploadTugas']);
        Route::post('guru/jadwal/cek/absensi/{kode}/{id_siswa}', [JadwalGuruController::class, 'absen']);
        Route::post('guru/jadwal/cek/nilai/{kode}/{id_siswa}', [JadwalGuruController::class, 'nilai']);

        Route::post('guru/setting/{id}', [User_GuruController::class, 'update']);
        // absen
        Route::get('guru/absen', [DashboardGuruController::class, 'absen']);

        Route::get('guru/logout', [User_GuruController::class, 'logout']);
    }
);

// wali murid ===================
// id : wahyu
// pas : 12345

// halaman login wali murid
Route::get('/wali-murid/auth', [User_WaliMuridController::class, 'index'])->middleware('guest.waliMurid')->name('login.waliMurid');
Route::post('/wali-murid/auth', [User_WaliMuridController::class, 'authenticate'])->middleware('guest.waliMurid');

Route::group(
    [
        'middleware' => ['auth.waliMurid', 'hak_akses:Wali Murid', 'preventBackHistory'],
    ],
    function () {
        Route::get('/wali-murid', function () {
            return redirect('/wali-murid/dashboard');
        });
        Route::resource('/wali-murid/dashboard', DashboardWaliMuridController::class);
        Route::resource('/wali-murid/profile-siswa', ProfileSiswaWaliMuridController::class);
        Route::resource('/wali-murid/pesan', PesanWaliMuridController::class);
        Route::get('wali-murid/pesan/search/inbox', [PesanWaliMuridController::class, 'search']);

        Route::post('wali-murid/pesan/balas/{id}', [PesanWaliMuridController::class, 'balas']);

        Route::resource('/wali-murid/pembayaran', PembayaranWaliMuridController::class);
        Route::resource('/wali-murid/prestasi-siswa', PrestasiSiswaWaliMuridController::class);
        Route::resource('/wali-murid/mata-pelajaran', MataPelajaranWaliMuridController::class);
        Route::resource('/wali-murid/setting', SettingsWaliMuridController::class);
        Route::resource('/wali-murid/rekap-nilai', RekapNilaiWaliMuridController::class);
        Route::get('wali-murid/logout', [User_WaliMuridController::class, 'logout']);
        Route::post('/wali-murid/setting/{idSiswa}/update', [SettingsWaliMuridController::class, 'updateSiswa']);
        // update user wali murid
        Route::post('/wali-murid/setting/waliMurid/{username}', [User_WaliMuridController::class, 'update']);
        // update user siswa
        Route::post('/wali-murid/setting/siswa/{username}', [User_SiswaController::class, 'update']);
    }
);

// pegawai ==============================================
// id : 67890
// pass : 12345

// halaman login
Route::get('/pegawai/auth', [User_PegawaiController::class, 'index'])->middleware('guest.pegawai')->name('login.pegawai');
Route::post('/pegawai/auth', [User_PegawaiController::class, 'authenticate'])->middleware('guest.pegawai');

Route::group(
    [
        'middleware' => ['auth.pegawai', 'hak_akses:Pegawai', 'preventBackHistory'],
    ],
    function () {
        Route::get('/pegawai', function () {
            return redirect('/pegawai/dashboard');
        });
        Route::resource('/pegawai/dashboard', DashboardPegawaiController::class);
        Route::get('pegawai/absen', [DashboardPegawaiController::class, 'absen']);

        Route::resource('/pegawai/pesan', PesanPegawaiController::class);
        Route::get('pegawai/pesan/search/inbox', [PesanPegawaiController::class, 'search']);

        Route::post('pegawai/pesan/balas/{id}', [PesanPegawaiController::class, 'balas']);

        Route::resource('/pegawai/setting', SettingsPegawaiController::class);
        Route::get('pegawai/logout', [User_PegawaiController::class, 'logout']);
        Route::post('/pegawai/setting/{nama}/{userid}', [User_PegawaiController::class, 'update']);
    }
);
// siswa  ===================
// id : 121212
// pas : 121212

// halaman login siswa
Route::get('/siswa/auth', [User_SiswaController::class, 'index'])->middleware('guest.siswa')->name('login.siswa');
Route::post('/siswa/auth', [User_SiswaController::class, 'authenticate'])->middleware('guest.siswa');

Route::group(
    [
        'middleware' => ['auth.siswa', 'hak_akses:Siswa', 'preventBackHistory'],
    ],
    function () {
        Route::get('/siswa', function () {
            return redirect('/siswa/dashboard');
        });
        Route::resource('/siswa/dashboard', DashboardSiswaController::class);
        // Route::post('/wali-murid/setting/siswa/{username}', [User_SiswaController::class, 'update']);
        Route::resource('/siswa/jadwal', JadwalSiswaController::class);
        Route::get('siswa/jadwal/cek/{kode_mapel}', [JadwalSiswaController::class, 'detailMapel']);
        // Route::resource('/siswa/pesan', PesanSiswaController::class);
        // Route::get('siswa/pesan/search/inbox', [PesanSiswaController::class, 'search']);

        Route::get('siswa/jadwal/{mapel}/{pertemuan}', [JadwalSiswaController::class, 'detailMapel']);
        Route::post('/siswa/jadwal/cek/tugas/{kode}', [JadwalSiswaController::class, 'uploadTugas']);

        Route::resource('/siswa/setting', SettingsSiswaController::class);
        Route::get('siswa/logout', [User_SiswaController::class, 'logout']);
    }
);

// Halaman Login TataUsaha
// id : 111111
// pass : 222222

Route::get('/tata-usaha/auth', [User_TataUsahaController::class, 'index'])->middleware('guest.tatausaha')->name('login.tatausaha');
Route::post('/tata-usaha/auth', [User_TataUsahaController::class, 'authenticate'])->middleware('guest.tatausaha');

Route::group(
    [
        'middleware' => ['auth.tatausaha', 'hak_akses:Tata Usaha', 'preventBackHistory'],
    ],
    function () {
        Route::get('/tata-usaha', function () {
            return redirect('/tata-usaha/dashboard');
        });
        Route::resource('/tata-usaha/dashboard', DashboardTataUsahaController::class);
        Route::get('tata-usaha/absen', [DashboardTataUsahaController::class, 'absen']);

        Route::resource('/tata-usaha/pesan', PesanTataUsahaController::class);
        Route::get('tata-usaha/pesan/search/inbox', [PesanTataUsahaController::class, 'search']);

        Route::post('tata-usaha/pesan/balas/{id}', [PesanTataUsahaController::class, 'balas']);

        Route::resource('/tata-usaha/pembayaran', PembayaranTataUsahaController::class);
        Route::post('/tata-usaha/pembayaran/report/{nisn}/{no_transaksi}', [PembayaranTataUsahaController::class, 'report']);

        Route::resource('/tata-usaha/rekap-keuangan', RekapKeuanganTataUsahaController::class);
        Route::get('/tata-usaha/rekap-keuangan/cetak/{tahun_ajaran}/{key}', [RekapKeuanganTataUsahaController::class, 'cetak']);

        Route::post('/tata-usaha/rekap-keuangan/report/{jenis}/{no_transaksi}', [RekapKeuanganTataUsahaController::class, 'report']);

        Route::resource('/tata-usaha/pemasukan', PemasukanKeuanganTataUsahaController::class);
        Route::resource('/tata-usaha/pengeluaran', PengeluaranKeuanganTataUsahaController::class);

        Route::resource('/tata-usaha/minta-akses', MintaAksesTataUsahaController::class);
        Route::resource('/tata-usaha/gallery', GalleryTataUsahaController::class);
        Route::resource('/tata-usaha/kinerja-guru', KinerjaGuruTataUsahaController::class);
        Route::resource('/tata-usaha/prestasi-siswa', PrestasiSiswaTataUsahaController::class);
        Route::resource('/tata-usaha/prestasi-siswa', PrestasiSiswaTataUsahaController::class);

        Route::resource('/tata-usaha/manajemen-mata-pelajaran', ManajemenMataPelajaranTataUsahaController::class);
        Route::resource('/tata-usaha/manajemen-akun', ManajemenAkunTataUsahaController::class);
        Route::resource('/tata-usaha/manajemen-kelas', ManajemenKelasTataUsahaController::class);

        Route::resource('/tata-usaha/manajemen-siswa', ManajemenSiswaTataUsahaController::class);
        Route::resource('/tata-usaha/manajemen-pegawai', ManajemenPegawaiTataUsahaController::class);
        Route::resource('/tata-usaha/manajemen-guru', ManajemenGuruTataUsahaController::class);
        Route::resource('/tata-usaha/manajemen-absensi', ManajemenAbsensiTataUsahaController::class);

        Route::resource('/tata-usaha/setting', SettingsTataUsahaController::class);
        Route::post('/tata-usaha/setting/{nama}/{userid}', [User_TataUsahaController::class, 'update']);
        // Route::get('tata-usaha/pembayaran/{id}', [PembayaranTataUsahaController::class, 'delete']);

        Route::get('tata-usaha/pembayaran/cetak/{kode}', [PembayaranTataUsahaController::class, 'cetak']);
        Route::get('tata-usaha/pembayaran/cetak/{kode}/download', [PDFController::class, 'saveKwitansiPemasukan']);

        Route::get('tata-usaha/logout', [User_TataUsahaController::class, 'logout']);

        // absensi

        // Route::get('/tata-usaha/absensi', function (){
        //     return view('TataUsaha.absensi.index');
        // });
        // absensi

    }
);

// ID:admin
// password : admin
// HALAMAN LOGIN SUPER USER
Route::get('/super-user/auth', [User_SuperUserController::class, 'index'])->middleware('guest.superuser')->name('login.superuser');
Route::post('/super-user/auth', [User_SuperUserController::class, 'authenticate'])->middleware('guest.superuser');

Route::group([
    'middleware' => ['auth.superuser', 'hak_akses:Super User', 'preventBackHistory'],
], function () {
    Route::get('/super-user', function () {
        return redirect('/super-user/dashboard');
    });
    Route::resource('/super-user/dashboard', DashboardSuperUserController::class);
    Route::resource('/super-user/Nilai-siswa', NilaiSiswaSuperUserController::class);

    Route::resource('/super-user/pesan', PesanSuperUserController::class);
    Route::get('super-user/pesan/search/inbox', [PesanSuperUserController::class, 'search']);

    Route::post('super-user/pesan/balas/{id}', [PesanSuperUserController::class, 'balas']);

    Route::resource('/super-user/rekap-keuangan', RekapKeuanganSuperUserController::class);
    Route::get('/super-user/rekap-keuangan/cetak/{tahun_ajaran}/{key}', [RekapKeuanganSuperUserController::class, 'cetak']);

    Route::resource('/super-user/kinerja-guru', KinerjaGuruSuperUserController::class);

    Route::resource('/super-user/pembayaran', PembayaranSiswaSuperUserController::class);

    Route::get('super-user/pembayaran/cetak/{kode}', [PembayaranSiswaSuperUserController::class, 'cetak']);

    Route::resource('/super-user/keuangan', KeuanganSuperUserController::class);

    Route::resource('/super-user/laporan-keuangan', LaporanKeuanganSuperUserController::class);
    Route::post('super-user/laporan-keuangan/pemasukkan/diterima/{noTransaksi}', [LaporanKeuanganSuperUserController::class, 'updatePemasukkanAccepted']);
    Route::post('super-user/laporan-keuangan/pemasukkan/ditolak/{noTransaksi}', [LaporanKeuanganSuperUserController::class, 'updatePemasukkanRejected']);

    Route::post('super-user/laporan-keuangan/pengeluaran/diterima/{noTransaksi}', [LaporanKeuanganSuperUserController::class, 'updatePengeluaranAccepted']);
    Route::post('super-user/laporan-keuangan/pengeluaran/ditolak/{noTransaksi}', [LaporanKeuanganSuperUserController::class, 'updatePengeluaranRejected']);

    Route::resource('/super-user/setting', SettingSuperUserController::class);
    Route::post('/super-user/setting/akun/{id}', [User_SuperUserController::class, 'update']);

    Route::get('super-user/logout', [User_SuperUserController::class, 'logout']);
});

//
// SCRIPT DILARANG DIUBAH =====================================================================
