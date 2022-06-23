@php
    function dateIndonesia($date)
	{
		$bulan = [
			'01' => 'Januari',
			'02' => 'Februari',
			'03' => 'Maret',
			'04' => 'April',
			'05' => 'Mei',
			'06' => 'Juni',
			'07' => 'Juli',
			'08' => 'Agustus',
			'09' => 'September',
			'10' => 'Oktober',
			'11' => 'November',
			'12' => 'Desember'

		];
		$date = explode('-', $date);
		$date = $date[2] . ' ' . $bulan[$date[1]] . ' ' . $date[0];
		return $date;
	}
@endphp