<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//new Admin

//Karyawan
$route['admin/daftar_karyawan'] = 'admin/karyawan/daftar_karyawan';
$route['admin/tambah_karyawan'] = 'admin/karyawan/tambah_karyawan';
$route['admin/edit_karyawan'] = 'admin/karyawan/edit_karyawan';
$route['admin/hapus_karyawan/(:num)'] = 'admin/karyawan/hapus_karyawan/$1';

//Kritik & Saran
$route['admin/daftar_kritik_saran'] = 'admin/kritik_saran/daftar_kritik_saran';
$route['admin/kritik_saran/(:num)'] = 'admin/kritik_saran/kritik_saran/$1';
$route['admin/hapus_kritik_saran/(:num)'] = 'admin/kritik_saran/hapus_kritik_saran/$1';

//Password
$route['admin/password'] = 'admin/password/form_password';
$route['admin/edit_password'] = 'admin/password/edit_password';

//Kuesioner
//1.  Daftar Kuesioner
$route['admin/daftar_kuesioner'] = 'admin/kuesioner/daftar_kuesioner';
//  Informasi Kuesioner
$route['admin/informasi-responden/(:num)'] = 'admin/kuesioner/informasi_responden/$1';
$route['admin/informasi-statistik/(:num)'] = 'admin/kuesioner/informasi_statistik/$1';
$route['admin/informasi-tanggapan/(:num)'] = 'admin/kuesioner/informasi_tanggapan/$1';
$route['admin/data_statistik'] = 'admin/kuesioner/data_statistik';
$route['admin/data_tanggapan'] = 'admin/kuesioner/data_tanggapan';
$route['admin/cetak-pdf/(:num)/(:any)'] = 'admin/kuesioner/cetak_kuesioner_pdf/$1/$2';
$route['admin/cetak-excel/(:num)'] = 'admin/kuesioner/cetak_kuesioner_excel/$1';

//  Ganti status kuesioner
$route['admin/cekStatus/(:num)'] = 'admin/kuesioner/cekStatus_kuesioner/$1';
$route['admin/detail_kuesioner/(:num)'] = 'admin/kuesioner/detail_kuesioner/$1';
$route['admin/edit_kuesioner'] = 'admin/kuesioner/edit_kuesioner';
$route['admin/duplikat_kuesioner'] = 'admin/kuesioner/duplikat_kuesioner';
$route['admin/hapus_kuesioner/(:num)'] = 'admin/kuesioner/hapus_kuesioner/$1';

$route['admin/buat_kuesioner'] = 'admin/kuesioner/form_buat_kuesioner';
$route['admin/tambah_kuesioner'] = 'admin/kuesioner/tambah_kuesioner';

$route['admin/sub_kuesioner'] = 'admin/kuesioner/daftar_sub_kuesioner';
$route['admin/tambah_sub_kuesioner'] = 'admin/kuesioner/tambah_sub_kuesioner';
$route['admin/edit_sub_kuesioner'] = 'admin/kuesioner/edit_sub_kuesioner';
$route['admin/hapus_sub_kuesioner/(:num)'] = 'admin/kuesioner/hapus_sub_kuesioner/$1';


//new karyawan

//Kritik & Saran
$route['kritik-saran'] = 'karyawan/kritik_saran/form_kritik_saran';
$route['simpan_kritik_saran'] = 'karyawan/kritik_saran/simpan_kritik_saran';

//Password
$route['password'] = 'karyawan/password/form_password';
$route['edit_password'] = 'karyawan/password/edit_password';

//Kuesioner
$route['daftar_kuesioner'] = 'karyawan/kuesioner/daftar_kuesioner';
$route['kuesioner/(:num)'] = 'karyawan/kuesioner/get_respon/$1';
$route['simpan_jawaban'] = 'karyawan/kuesioner/simpan_jawaban';

//general
$route['logout'] = 'auth/logout';
$route['login'] = 'auth';
