<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\auth\AdminController;
use App\Http\Controllers\auth\MarketingController;
use App\Http\Controllers\auth\SDMController;
use App\Http\Controllers\Berita\BeritaController;
use App\Http\Controllers\DigitalSolution\CarouseldsController;
use App\Http\Controllers\DigitalSolution\GambardsController;
use App\Http\Controllers\DigitalSolution\TextdsController;
use App\Http\Controllers\DigitalSolutionController;
use App\Http\Controllers\Facilitymanagement\CarouselFMController;
use App\Http\Controllers\Facilitymanagement\GambarFMController;
use App\Http\Controllers\Facilitymanagement\TextFMController;
use App\Http\Controllers\FacilityManagementController;
use App\Http\Controllers\karir\KarirController;
use App\Http\Controllers\kontakkami\CarouselKKController;
use App\Http\Controllers\kontakkami\GambarKKController;
use App\Http\Controllers\kontakkami\TextKKController;
use App\Http\Controllers\landingpage\CarouselController;
use App\Http\Controllers\landingpage\FotoLayananController;
use App\Http\Controllers\landingpage\JejakLangkahController;
use App\Http\Controllers\landingpage\SekilasPerusahaanController;
use App\Http\Controllers\landingpage\SertifikatPenghargaanController;
use App\Http\Controllers\landingpage\VisiMisiBudayaController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Memilihkami\MkController;
use App\Http\Controllers\swaacademy\CarouselSAController;
use App\Http\Controllers\Swaacademy\GambarSAController;
use App\Http\Controllers\swaacademy\TextSAController;
use App\Http\Controllers\SwaacademyController;
use App\Http\Controllers\Swasegar\GambarSSController;
use App\Http\Controllers\Swasegar\SwasegarCarouselController;
use App\Http\Controllers\Swasegar\TextSSController;
use App\Http\Controllers\SwasegarController;
use App\Http\Controllers\swatour\CarouselteoController;
use App\Http\Controllers\swatour\GambarteoController;
use App\Http\Controllers\swatour\TextteoController;
use App\Http\Controllers\SwatourorganizerController;
use App\Http\Controllers\TentangkamiController;
use Illuminate\Support\Facades\Route;

//route untuk memanggil view Indonesia
Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');
Route::get('/facility-management', [FacilityManagementController::class, 'index'])->name('facility-management');
Route::get('/swasegar', [SwasegarController::class, 'index'])->name('swasegar');
Route::get('/swatour', [SwatourorganizerController::class, 'index'])->name('swatour');
Route::get('/Digital-Solution', [DigitalSolutionController::class, 'index'])->name('digitalsolution');
Route::get('/swaacademy', [SwaacademyController::class, 'index'])->name('swaacademy');
Route::get('/sekilasperusahaan', [TentangkamiController::class, 'sekilasPerusahaan'])->name('sekilas');
Route::get('/visimisibudaya', [TentangkamiController::class, 'visiMisiBudaya'])->name('visimisi');
Route::get('/SertifikatPenghargaan', [TentangkamiController::class, 'sertifikat'])->name('sertif');
Route::get('/memilihkami', [MkController::class, 'index'])->name('memilihkami');
Route::get('/Beritashow', [BeritaController::class, 'index'])->name('berita1212');

//Route untuk memanggil view English
Route::get('/en', [LandingPageController::class, 'indexEng'])->name('landingpageEng');
Route::get('/en/facility-management', [FacilityManagementController::class, 'indexEng'])->name('facility-managementEng');
Route::get('/en/swasegar', [SwasegarController::class, 'indexEng'])->name('swasegarEng');
Route::get('/en/swatour', [SwatourorganizerController::class, 'indexEng'])->name('swatourEng');
Route::get('/en/Digital-Solution', [DigitalSolutionController::class, 'indexEng'])->name('digitalsolutionEng');
Route::get('/en/swaacademy', [SwaacademyController::class, 'indexEng'])->name('swaacademyEng');
Route::get('/en/sekilasperusahaan', [TentangkamiController::class, 'sekilasPerusahaanEng'])->name('tentangkamiEng');
Route::get('/en/visimisibudaya', [TentangkamiController::class, 'visiMisiBudayaEng'])->name('visimisiEng');
Route::get('/en/SertifikatPenghargaan', [TentangkamiController::class, 'sertifikatEng'])->name('sertifEng');
Route::get('/en/memilihkami', [MkController::class, 'indexEng'])->name('memilihkamiEng');
// Route untuk login
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//route untuk login masing masing role login
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});
Route::middleware(['auth', 'role:sdm'])->group(function () {
    Route::get('/sdm/dashboard', [SDMController::class, 'index'])->name('sdm.dashboard');
});
Route::middleware(['auth', 'role:marketing'])->group(function () {
    Route::get('/marketing/dashboard', [MarketingController::class, 'index'])->name('marketing.dashboard');
});

//role crud yang di izinkan untuk akses crud

Route::group(['middleware' => ['auth', 'role:admin,marketing']], function() {
    //Untuk tampilan landingpage
    Route::prefix('carousel')->group(function () {
        Route::get('/', [CarouselController::class, 'showCarousel'])->name('admin.landingpage.carousel.index');
        Route::post('/store', [CarouselController::class, 'store'])->name('admin.landingpage.carousel.store');
        Route::put('/update/{id}', [CarouselController::class, 'update'])->name('admin.landingpage.carousel.update');
        Route::delete('/admin/landingpage/carousel/{carousel}', [CarouselController::class, 'destroy'])->name('admin.landingpage.carousel.destroy');
    });
    Route::prefix('admin/sekilas')->group(function () {
        Route::get('/', [SekilasPerusahaanController::class, 'index'])->name('admin.landingpage.sekilas.index');
        Route::post('/store', [SekilasPerusahaanController::class, 'store'])->name('admin.landingpage.sekilas.store');
        Route::put('/update/{id}', [SekilasPerusahaanController::class, 'update'])->name('admin.landingpage.sekilas.update');
        Route::delete('/delete/{id}', [SekilasPerusahaanController::class, 'destroy'])->name('admin.landingpage.sekilas.destroy');
    });
    Route::prefix('jejaklangkah')->group(function () {
        Route::get('/', [JejakLangkahController::class, 'index'])->name('admin.landingpage.jejaklangkah.index');
        Route::post('/store', [JejakLangkahController::class, 'store'])->name('admin.landingpage.jejaklangkah.store');
        Route::put('/update/{id}', [JejakLangkahController::class, 'update'])->name('admin.landingpage.jejaklangkah.update');
        Route::delete('/delete/{id}', [JejakLangkahController::class, 'destroy'])->name('admin.landingpage.jejaklangkah.destroy');
    });
    Route::prefix('visimisi')->group(function () {
        Route::get('/', [VisiMisiBudayaController::class, 'index'])->name('admin.landingpage.visimisi.index');
        Route::post('/store', [VisiMisiBudayaController::class, 'store'])->name('admin.landingpage.visimisi.store');
        Route::put('/admin/landingpage/visimisi/{id}', [VisiMisiBudayaController::class, 'update'])->name('admin.landingpage.visimisi.update');
        // Route::delete('/delete/{id}', [VisiMisiBudayaController::class, 'destroy'])->name('admin.landingpage.visimisi.destroy');
        Route::delete('/admin/landingpage/visimisi/{id}', [VisiMisiBudayaController::class, 'destroy'])->name('admin.landingpage.visimisi.destroy');
    });
    Route::prefix('sertifikat-penghargaan')->group(function () {
        Route::get('/', [SertifikatPenghargaanController::class, 'index'])->name('admin.landingpage.sertifikat-penghargaan.index');
        Route::post('/store', [SertifikatPenghargaanController::class, 'store'])->name('admin.landingpage.sertifikat-penghargaan.store');
        Route::put('/update/{id}', [SertifikatPenghargaanController::class, 'update'])->name('admin.landingpage.sertifikat-penghargaan.update');
        Route::delete('/delete/{id}', [SertifikatPenghargaanController::class, 'destroy'])->name('admin.landingpage.sertifikat-penghargaan.destroy');
    });
    Route::prefix('fotolayanan')->group(function () {
        Route::get('/', [FotoLayananController::class, 'index'])->name('admin.landingpage.fotoLayanan.index');
        Route::post('/store', [FotoLayananController::class, 'store'])->name('admin.foto-layanan.store');
        Route::put('/update/{id}', [FotoLayananController::class, 'update'])->name('admin.foto-layanan.update');
        Route::delete('/destroy/{id}', [FotoLayananController::class, 'destroy'])->name('admin.landingpage.fotoLayanan.destroy');
    });
    //Halaman digital solution
    Route::prefix('carouselds')->group(function () {
        Route::get('/', [CarouseldsController::class, 'index'])->name('admin.digitalsolution.carouselds.index');
        Route::post('/store', [CarouseldsController::class, 'store'])->name('admin.digitalsolution.carouselds.store');
        Route::put('/update/{id}', [CarouseldsController::class, 'update'])->name('admin.digitalsolution.carouselds.update');
        Route::delete('/delete/{id}', [CarouseldsController::class, 'destroy'])->name('admin.digitalsolution.carouselds.destroy');
    });
    Route::prefix('gambards')->group(function () {
        Route::get('/', [GambardsController::class, 'index'])->name('admin.digitalsolution.gambards.index');
        Route::post('/store', [GambardsController::class, 'store'])->name('admin.digitalsolution.gambards.store');
        Route::put('/update/{id}', [GambardsController::class, 'update'])->name('admin.digitalsolution.gambards.update');
        Route::delete('/destroy/{id}', [GambardsController::class, 'destroy'])->name('admin.digitalsolution.gambards.destroy');
    });
    Route::prefix('textds')->group(function () {
        Route::get('/', [TextdsController::class, 'index'])->name('admin.digitalsolution.textds.index');
        Route::post('/store', [TextdsController::class, 'store'])->name('admin.digitalsolution.textds.store');
        Route::put('/update/{id}', [TextdsController::class, 'update'])->name('admin.digitalsolution.textds.update');
        Route::delete('/destroy/{id}', [TextdsController::class, 'destroy'])->name('admin.digitalsolution.textds.destroy');
    });

    //Tampilan Facility Management
    Route::prefix('carouselFM')->group(function () {
        Route::get('/', [CarouselFMController::class, 'index'])->name('admin.facilitymanagement.carouselFM.index');
        Route::post('/store', [CarouselFMController::class, 'store'])->name('admin.facilitymanagement.carouselFM.store');
        Route::put('/update/{id}', [CarouselFMController::class, 'update'])->name('admin.facilitymanagement.carouselFM.update');
        Route::delete('/destroy/{id}', [CarouselFMController::class, 'destroy'])->name('admin.facilitymanagement.carouselFM.destroy');
    });
    Route::prefix('gambarFM')->group(function () {
        Route::get('/', [GambarFMController::class, 'index'])->name('admin.facilitymanagement.gambarFM.index');
        Route::post('/store', [GambarFMController::class, 'store'])->name('admin.facilitymanagement.gambarFM.store');
        Route::put('/update/{id}', [GambarFMController::class, 'update'])->name('admin.facilitymanagement.gambarFM.update');
        Route::delete('/destroy/{id}', [GambarFMController::class, 'destroy'])->name('admin.facilitymanagement.gambarFM.destroy');
    });
    Route::prefix('textfm')->group(function () {
        Route::get('/', [TextFMController::class, 'index'])->name('admin.textfm.index');
        Route::post('/store', [TextFMController::class, 'store'])->name('admin.textfm.store');
        Route::put('/update/{id}', [TextFMController::class, 'update'])->name('admin.textfm.update');
        Route::delete('/destroy/{id}', [TextFMController::class, 'destroy'])->name('admin.textfm.destroy');
    });
    Route::prefix('carouselss')->group(function () {
        Route::get('/', [SwasegarCarouselController::class, 'index'])->name('admin.swasegar.carousel.index');
        Route::post('/store', [SwasegarCarouselController::class, 'store'])->name('admin.swasegar.carousel.store');
        Route::put('/update/{id}', [SwasegarCarouselController::class, 'update'])->name('admin.swasegar.carousel.update');
        Route::delete('/destroy/{id}', [SwasegarCarouselController::class, 'destroy'])->name('admin.swasegar.carousel.destroy');
    });

    // Gambar SS
    Route::prefix('gambarss')->group(function () {
        Route::get('/', [GambarSSController::class, 'index'])->name('admin.swasegar.gambarSS.index');
        Route::post('/', [GambarSSController::class, 'store'])->name('admin.swasegar.gambarSS.store');
        Route::put('/{id}', [GambarSSController::class, 'update'])->name('admin.swasegar.gambarSS.update');
        Route::delete('/{id}', [GambarSSController::class, 'destroy'])->name('admin.swasegar.gambarSS.destroy');
    });

    // Text SS
    Route::prefix('textss')->group(function () {
        Route::get('/', [TextSSController::class, 'index'])->name('admin.swasegar.textss.index');
        Route::post('/store', [TextSSController::class, 'store'])->name('admin.swasegar.textss.store');
        Route::put('/update/{id}', [TextSSController::class, 'update'])->name('admin.swasegar.textss.update');
        Route::delete('/destroy/{id}', [TextSSController::class, 'destroy'])->name('admin.swasegar.textss.destroy');
    });

    
    Route::prefix('carouselteo')->group(function () {
        Route::get('/', [CarouselteoController::class, 'index'])->name('admin.swatour.carouselteo.index');
        Route::post('/store', [CarouselteoController::class, 'store'])->name('admin.swatour.carouselteo.store');
        Route::put('/update/{id}', [CarouselteoController::class, 'update'])->name('admin.swatour.carouselteo.update');
        Route::delete('/destroy/{id}', [CarouselteoController::class, 'destroy'])->name('admin.swatour.carouselteo.destroy');
    });

    // Gambarteo
    Route::prefix('gambarteo')->group(function () {
        Route::get('/', [GambarteoController::class, 'index'])->name('admin.swatour.gambarteo.index');
        Route::post('/store', [GambarteoController::class, 'store'])->name('admin.swatour.gambarteo.store');
        Route::put('/update/{id}', [GambarteoController::class, 'update'])->name('admin.swatour.gambarteo.update');
        Route::delete('/destroy/{id}', [GambarteoController::class, 'destroy'])->name('admin.swatour.gambarteo.destroy');
    });

    // Text Teo
    Route::prefix('textteo')->group(function () {
        Route::get('/', [TextteoController::class, 'index'])->name('admin.swatour.textteo.index');
        Route::post('/store', [TextteoController::class, 'store'])->name('admin.swatour.textteo.store');
        Route::put('/update/{id}', [TextteoController::class, 'update'])->name('admin.swatour.textteo.update');
        Route::delete('/destroy/{id}', [TextteoController::class, 'destroy'])->name('admin.swatour.textteo.destroy');
    });
    Route::prefix('carouselSA')->group(function () {
        Route::get('/', [CarouselSAController::class, 'index'])->name('admin.swaacademy.index');
        Route::post('/carousel', [CarouselSAController::class, 'store'])->name('admin.swaacademy.carouselSA.store');
        Route::put('/carousel/{id}', [CarouselSAController::class, 'update'])->name('admin.swaacademy.carouselSA.update');
        Route::delete('/carousel/{id}', [CarouselSAController::class, 'destroy'])->name('admin.swaacademy.carouselSA.destroy');
    });
    Route::prefix('gambarSA')->group(function () {
        Route::get('/', [GambarSAController::class, 'index'])->name('admin.swaacademy.gambarSA.index');
        Route::post('/gambarSA', [GambarSAController::class, 'store'])->name('admin.swaacademy.gambarSA.store');
        Route::put('/gambarSA/{id}', [GambarSAController::class, 'update'])->name('admin.swaacademy.gambarSA.update');
        Route::delete('/gambarSA/{id}', [GambarSAController::class, 'destroy'])->name('admin.swaacademy.gambarSA.destroy');
    });
    Route::prefix('textSA')->group(function () {
        Route::get('/', [TextSAController::class, 'index'])->name('admin.swaacademy.textSA.index');
        Route::post('/store', [TextSAController::class, 'store'])->name('admin.swaacademy.textSA.store');
        Route::put('/update/{id}', [TextSAController::class, 'update'])->name('admin.swaacademy.textSA.update');
        Route::delete('/destroy/{id}', [TextSAController::class, 'destroy'])->name('admin.swaacademy.textSA.destroy');
    });
    Route::prefix('admin/mk')->group(function () {
        Route::get('/', [MkController::class, 'showmk'])->name('admin.memilihkami.mk.index'); // Menggunakan showmk() di sini
        Route::post('/store', [MkController::class, 'store'])->name('admin.memilihkami.mk.store');
        Route::put('/update/{id}', [MkController::class, 'update'])->name('admin.memilihkami.mk.update');
        Route::delete('/destroy/{id}', [MkController::class, 'destroy'])->name('admin.memilihkami.mk.destroy');
    });
    Route::prefix('berita')->group(function () {
        Route::get('/', [BeritaController::class, 'showberita'])->name('admin.berita.berita.index'); // Menampilkan daftar berita
        Route::post('/berita', [BeritaController::class, 'store'])->name('admin.berita.berita.store');
        Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('admin.berita.berita.update');
        Route::delete('/destroy/{id}', [BeritaController::class, 'destroy'])->name('admin.berita.berita.destroy'); // Menghapus berita
    });
    Route::prefix('carouselkk')->group(function () {
        Route::get('/', [CarouselKKController::class, 'index'])->name('admin.kontakkami.carouselkk.index');
        Route::post('/carouselkk', [CarouselKKController::class, 'store'])->name('admin.kontakkami.carouselkk.store');
        Route::put('/carouselkk/{id}', [CarouselKKController::class, 'update'])->name('admin.kontakkami.carouselkk.update');
        Route::delete('/carouselkk/{id}', [CarouselKKController::class, 'destroy'])->name('admin.kontakkami.carouselkk.destroy');
    });
    Route::prefix('textkk')->group(function () {
        Route::get('/', [TextKKController::class, 'index'])->name('admin.kontakkami.textkk.index');
        Route::post('/carouselkk', [TextKKController::class, 'store'])->name('admin.kontakkami.textkk.store');
        Route::put('/carouselkk/{id}', [TextKKController::class, 'update'])->name('admin.kontakkami.textkk.update');
        Route::delete('/carouselkk/{id}', [TextKKController::class, 'destroy'])->name('admin.kontakkami.textkk.destroy');
    });
    Route::prefix('gambarkk')->group(function () {
        Route::get('/', [GambarKKController::class, 'index'])->name('admin.kontakkami.gambarkk.index');
        Route::post('/carouselkk', [GambarKKController::class, 'store'])->name('admin.kontakkami.gambarkk.store');
        Route::put('/carouselkk/{id}', [GambarKKController::class, 'update'])->name('admin.kontakkami.gambarkk.update');
        Route::delete('/carouselkk/{id}', [GambarKKController::class, 'destroy'])->name('admin.kontakkami.gambarkk.destroy');
    });

});
Route::group(['middleware' => ['auth', 'role:admin,sdm']], function() {
    Route::prefix('karir')->group(function () {
        Route::get('/', [KarirController::class, 'index'])->name('admin.karir.karir.index');
        Route::post('/', [KarirController::class, 'store'])->name('admin.karir.karir.store');
        Route::put('/{id}', [KarirController::class, 'update'])->name('admin.karir.karir.update');
        Route::delete('/{id}', [KarirController::class, 'destroy'])->name('admin.karir.karir.destroy');
    });
});