<html>

<head>
<link rel="icon" href="<?php echo base_url()?>/assets/dist/img/favicon.ico" type="image/ico">
	<title>KUESIONER PT. PGAS SOLUTION</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

	<style type="text/css">
		.tg {
			border-collapse: collapse;
			border-spacing: 0;
			font-family: Arial, sans-serif;
			font-size: 14px;
		}
		.metadata {
			font-family: Arial, sans-serif;
			font-size: 14px;
			font-weight: normal;
		}
		.h {
			font-family: Arial, sans-serif;
			font-size: 18px;
			font-weight: bold;
		}

		.tg td {
			font-family: Arial, sans-serif;
			font-size: 14px;
			padding: 10px 5px;
			border-style: solid;
			border-width: 1px;
			overflow: hidden;
			word-break: normal;
			border-color: black;
		}

		.tg th {
			font-family: Arial, sans-serif;
			font-size: 14px;
			font-weight: normal;
			padding: 10px 5px;
			border-style: solid;
			border-width: 1px;
			overflow: hidden;
			word-break: normal;
			border-color: black;
		}

		.tg .tg-yw4l {
			border-color: inherit;
			border-width: 1px;
			border-color: black;
			text-align: center;
			vertical-align: center;
		}
		.tg .tg-ygas {
			border-color: inherit;
			border-width: 1px;
			border-color: black;
		}

		.tg .tg-7btt {
			font-weight: bold;
			border-color: inherit;
			border-width: 1px;
			border-color: black;
			text-align: center;
			vertical-align: center;
		}
</style>
</head>

<body bgcolor="#ffffff" onLoad="window.print()">
<center><img src="<?php echo base_url()?>assets/dist/img/logo.png"></center>

	<table cellpadding="0" cellspacing="0" border="0" width="700" align="center">
		<td class="prtext">
			<br>
			<br>
			<div align="center" class="h">
				KUESIONER
				<?php
					foreach($judul as $judul){
						$a = strtolower($judul['judul_kuesioner']);
						echo strtoupper($a);

					?></div>
			<br>
			<br>
			<table cellpadding="0" cellspacing="1" border="0">
				<tr class="metadata">
					<td width="100">Judul</td>
					<td width="350">: <?php echo $judul['judul_kuesioner']; ?></td>
					<td width="100">Responden</td>
					<td width="150">: <?php echo $jumlah_responden; ?></td>
				</tr>
				<tr class="metadata">
					<td>Direktorat</td>
					<td>: <?php echo $direktorat; ?></td>
					<td>Periode</td>
					<td>: <?php echo $judul['periode']; ?></td>
				</tr>

			</table>
			<?php
					}
			?>
			<br>
			<table style="undefined;table-layout: fixed; width: 700px">
			<tr class="metadata">
					<td><i>*) 1 = Sangat Tidak Setuju, 2 = Tidak Setuju, 3 = Biasa, 4 = Setuju, 5 = Sangat Setuju.</i></td>
				</tr>
				</table>
				<br>
			<table class="tg" style="undefined;table-layout: fixed; width: 700px">
			<colgroup>
			<col style="width: 50px">
			<col style="width: 300px">
			<col style="width: 70px">
			<col style="width: 70px">
			<col style="width: 70px">
			<col style="width: 70px">
			<col style="width: 70px">
			</colgroup>
			<tr>
				<th class="tg-7btt" rowspan="2">No.</th>
				<th class="tg-ygas" rowspan="2"><span style="font-weight:bold">Sub Kuesioner</span></th>
				<th class="tg-7btt" colspan="5"><span style="font-weight:bold">Persentase Jawaban</span></th>
			</tr>
			<tr>
				<td class="tg-7btt">1</td>
				<td class="tg-7btt">2</td>
				<td class="tg-7btt">3</td>
				<td class="tg-7btt">4</td>
				<td class="tg-7btt">5</td>
			</tr>
			<?php
			$z = $jumlah;
			$jml = $jumlah_responden;
			for($i=1; $i<=$z; $i++){
				$a = "statistik".$i;
				$result = $$a;

				foreach ($result->result_array() as $row) {
					extract($row);
					$total = $jawaban1 + $jawaban2 + $jawaban3 + $jawaban4 + $jawaban5;
					$persen1 = $jawaban1 / $total * 100;
					$persen2 = $jawaban2 / $total * 100;
					$persen3 = $jawaban3 / $total * 100;
					$persen4 = $jawaban4 / $total * 100;
					$persen5 = $jawaban5 / $total * 100;

			?>
			<tr>
				<td class="tg-yw4l"><?php echo $i; ?></td>
				<td class="tg-ygas"><?php echo $sub_kuesioner; ?></td>
				<td class="tg-yw4l"><?php echo number_format($persen1,1).'%' ?></td>
				<td class="tg-yw4l"><?php echo number_format($persen2,1).'%' ?></td>
				<td class="tg-yw4l"><?php echo number_format($persen3,1).'%' ?></td>
				<td class="tg-yw4l"><?php echo number_format($persen4,1).'%' ?></td>
				<td class="tg-yw4l"><?php echo number_format($persen5,1).'%' ?></td>
			</tr>
			<?php
			}
		}
			?>
			</table>

</body>

</html>
