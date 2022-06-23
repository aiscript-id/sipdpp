<?php
namespace App\Helpers;
 
class MyHelper {
    
	public function uploadImage($image, $path)
	{
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/'.$path, $image_name);
        $image_path = 'storage/'.$path .'/'. $image_name;
        $image_resize = \Image::make($image_path)->resize(300, null, function ($constraint) {
			$constraint->aspectRatio();
		});
        $image_resize->save($image_path);

		return $image_path;
	}

	public function deleteImage($old_image)
	{
		// unlink image
		if (file_exists($old_image)) {
			unlink($old_image);
		}
		# code...
	}

	// date indonesia
	public function dateIndonesia($date)
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
			'12' => 'User'

		];
		$date = explode('-', $date);
		$date = $date[2] . ' ' . $bulan[$date[1]] . ' ' . $date[0];
		return $date;
	}

	
    public static function instance()
	{
	    return new MyHelper();
	}
}