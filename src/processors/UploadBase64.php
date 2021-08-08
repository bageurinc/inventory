<?php
namespace Bageur\Inventory\Processors;

class UploadBase64 {

    public static function avatarbase64($data,$loc)
    {
        $file        = explode(";base64,", $data);
        $path       = 'bageur.id/'.$loc;
        \Storage::makeDirectory($path);
        $namaBerkas = 'avatar'.date('ymdhis').'.png';
        $file_base64 = base64_decode($file[1]);
        //   $image = \Image::make($data);
        //   $image->save(storage_path('app/public/'.$path.'/'.$namaBerkas));
        \Storage::put($path.'/'.$namaBerkas, $file_base64);

      $arr = ['up' => $namaBerkas , 'path' => $path];
      return $arr;
    }
}
