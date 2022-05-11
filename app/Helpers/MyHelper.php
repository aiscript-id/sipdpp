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
    public static function instance()
	{
	    return new MyHelper();
	}
}