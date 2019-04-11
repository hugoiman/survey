<?php
  // Load plugin PHPExcel nya
  include APPPATH.'third_party/PHPExcel/PHPExcel.php';

  // Panggil class PHPExcel nya
  $excel = new PHPExcel();

  foreach ($data_kuesioner as $data) {
  $excel->getProperties()->setCreator('PGN-Solution')
        ->setLastModifiedBy('My Notes Code')
        ->setTitle("Kuesioner ".$data['judul_kuesioner'])
        ->setSubject("Kuesioner")
        ->setDescription("Laporan Semua Data");

  $style_col = array(
    'font' => array('bold' => true), // Set font nya jadi bold
    'alignment' => array(
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ),
    'borders' => array(
      'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
      'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
      'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
      'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    )
  );

  // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
  $style_row = array(
    'alignment' => array(
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ),
    'borders' => array(
      'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
      'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
      'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
      'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    )
  );
  $excel->setActiveSheetIndex(0)->setCellValue('A2', "Kuesioner ".$data['judul_kuesioner'].", ".$data['periode']); // Set kolom A2 dengan tulisan "DATA SISWA"
  $excel->getActiveSheet()->mergeCells('A2:D2'); // Set Merge Cell pada kolom A2 sampai G2
  $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A2
  $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom B2

  $excel->getActiveSheet()->getStyle('4')->getFont()->setBold(TRUE);
  $excel->getActiveSheet()->getStyle("A:BZ")->getFont()->setSize(9); // Set font size 15 untuk kolom B2
  $excel->getActiveSheet()->freezePane('A6','ZZ6');
  }

  // Buat header tabel nya pada baris ke 5
  $excel->setActiveSheetIndex(0)->setCellValue('A5', "NIPG"); // Set kolom A5 dengan tulisan "Direktorat"
  $excel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
  $excel->getActiveSheet()->getStyle('A5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom B2

  // Buat header tabel nya pada baris ke 5
  $excel->setActiveSheetIndex(0)->setCellValue('B5', "Usia"); // Set kolom A5 dengan tulisan "Direktorat"
  $excel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
  $excel->getActiveSheet()->getStyle('B5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom B2

  // Buat header tabel nya pada baris ke 5
  $excel->setActiveSheetIndex(0)->setCellValue('C5', "Kepangkatan"); // Set kolom A5 dengan tulisan "Direktorat"
  $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
  $excel->getActiveSheet()->getStyle('C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom B2

  // Buat header tabel nya pada baris ke 5
  $excel->setActiveSheetIndex(0)->setCellValue('D5', "Direktorat"); // Set kolom A5 dengan tulisan "Direktorat"
  $excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
  $excel->getActiveSheet()->getStyle('D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom B2

  // atur range kolom Sub Bab
  $cols_sub = range('E','ZZ');
  $i = 0;
  $cols_now = 0;
  foreach ($jumlah_soal_per_sub as $data) {
    $range_cols = $cols_now + $data['jumlah_soal'] - 1;
    $excel->setActiveSheetIndex(0)->setCellValue($cols_sub[$cols_now].'4', $data['sub_kuesioner']);
    $excel->getActiveSheet()->mergeCells($cols_sub[$cols_now].'4'.':'.$cols_sub[$range_cols].'4');
    $excel->getActiveSheet()->getStyle($cols_sub[$cols_now].'4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $cols_now += $data['jumlah_soal'];
  }

  // Daftar Pertanyaan
  $cols = range('E','ZZ');
  $i = 0;
  foreach ($pertanyaan as $data){
    $excel->setActiveSheetIndex(0)->setCellValue($cols[$i].'5', $data['soal_kuesioner']);
    $excel->getActiveSheet()->getColumnDimension($cols[$i])->setWidth(30);
    // $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(60);
    $excel->getActiveSheet()->getStyle($cols[$i].'5')->getAlignment()->setWrapText(true);
    $excel->getActiveSheet()->getStyle($cols[$i].'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
    $i++;
  }

  //Tampil PANGKAT DAN Direktorat
  $nipg_now = "x";
  $rows = 6;
  $usia = "x";
  foreach ($data_tanggapan as $data) {
    if ($data['nipg'] != $nipg_now) {
      if ($data['usia'] <= 25) {
        $usia = "<=25";
      }
      elseif ($data['usia'] >= 26 && $data['usia'] <= 30) {
        $usia = "26 - 30 Tahun";
      }
      elseif ($data['usia'] >= 31 && $data['usia'] <= 35) {
        $usia = "31 - 35 Tahun";
      }
      elseif ($data['usia'] >= 36 && $data['usia'] <= 40) {
        $usia = "36 - 40 Tahun";
      }
      elseif ($data['usia'] >= 41) {
        $usia = ">=41 Tahun";
      }
      if ($data['grade'] == 'Staff') {
        $data['grade'] = 'Staff s/d Sr. Staff';
      }
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$rows+=1, $data['nipg']);
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$rows, $usia);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$rows, $data['grade']);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$rows, $data['direktorat']);
    }
    $nipg_now = $data['nipg'];
  }

  $rows_jawaban = 6;
  $cols_jawaban = range('E','ZZ');
  $i = 0;
  //ambil nipg pertama
  foreach ($nipg_pertama as $data) {
    $nipg_kesatu = $data['nipg'];
  }
  //Tampil jawaban
  foreach ($data_tanggapan as $data) {
    if ($data['nipg'] == $nipg_kesatu) {
      $excel->setActiveSheetIndex(0)->setCellValue($cols_jawaban[$i].$rows_jawaban, $data['jawaban']);
      $i++;
    }
    elseif ($data['nipg'] != $nipg_kesatu) {
      $i = 0;
      $excel->setActiveSheetIndex(0)->setCellValue($cols_jawaban[$i].$rows_jawaban += 1, $data['jawaban']);
      $i++;
    }
    $nipg_kesatu = $data['nipg'];
  }

  // Proses file ke excel
  foreach ($data_kuesioner as $data) {
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Kuesioner"'.$data['judul_kuesioner']." ".$data['periode'].".xlsx"); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
  }
?>
