<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// https://github.com/anasrp08/covidmonitoring.git
Route::group(['midlleware' => 'web'], function () {

// Auth::routes();
// Route::get('/signin/{np}', function ($id) {
//     return 'User '.$id;
// });

Route::get('/login_portal/{np}', 'HomeController@indexLogin');
Route::get('/logout_portal/{np}', 'HomeController@indexLogout');
// Route::get('/logout', 'Auth\LoginController@logout');
// Route::get('/login_portal/{id}', 'HomeController@index');
// 'HomeController@indexLogin'
// Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home'); 
Route::post('/data/banner', 'HomeController@dataBanner')->name('data.banner');
Route::post('/data/grafik_bar', 'HomeController@grafikByDate')->name('data.grafik_bar');
Route::post('/data/grafik_bar_kesembuhan', 'HomeController@grafikKesembuhan')->name('data.kesembuhan');

Route::post('/data/persebaran', 'HomeController@dataPersebaran')->name('data.persebaran');
Route::post('/data/persebaran_divisi', 'HomeController@dataDivisi')->name('data.divisi');
Route::post('/data/persebaran_domisili', 'HomeController@dataDomisili')->name('data.domisili');
Route::post('/data/summary', 'HomeController@grafikSummary')->name('data.summary');
Route::post('/data/areakerja_aktif', 'HomeController@areaKerjaAktif')->name('data.areakerja_aktif');
Route::post('/data/unitkerja_aktif', 'HomeController@unitKerjaAktif')->name('data.unitkerja_aktif');
Route::post('/data/data_map', 'HomeController@dataMap')->name('data.map');


// Route::get('/data/peta_kerja', 'LokasiKerja@viewPage')->name('view.lokasi');

Route::get('/data/lokasi_kerja', 'LokasiKerjaController@viewPage')->name('view.lokasi');

Route::get('/input/input_form_manual', 'InputDataController@viewInputData')->name('data.input');
Route::get('/input/input_upload', 'InputDataController@viewInputUpload')->name('data.input_upload');
Route::get('/input/update_form', 'InputDataController@viewUpdate')->name('data.daftar');
Route::get('/getDownloadTemplate', 'InputDataController@getDownloadTemplate')->name('download.tempalate');
// Route::get('/performance_level/detail_level1', 'PerformanceLevelController@viewDetailPerformanceLevel1')->name('data_detail1.view');
Route::post('/uploadDataKaryawan', 'InputDataController@uploadDataKaryawan')->name('upload');
Route::post('/input/update_data', 'InputDataController@updateDataKaryawan')->name('data.update');
Route::post('/input/daftar_data_karyawan', 'InputDataController@indexDataKaryawan')->name('data.index');
Route::post('/input/data_store', 'InputDataController@store')->name('data.store');
Route::post('/input/data_karyawan', 'InputDataController@getDataKaryawan')->name('data.karyawan');
Route::post('/input/data_kota', 'InputDataController@getKota')->name('data.kota');

Route::get('/input/destroy/{id}', 'InputDataController@destroy'); 


Route::get('/report/daftar_kasus', 'ReportController@viewReportAll')->name('kasus.view');
Route::post('/report/data_kasus', 'ReportController@indexKasus')->name('kasus.data');
Route::get('report/report_data_kasus', 'ReportController@exportReportDataKasus'); 


 
});