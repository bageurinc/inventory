<?php
namespace Bageur\Inventory\Processors;

class UploadBase64 {

    public static function avatarbase64($data,$loc)
    {
      $path       = 'bageur.id/'.$loc;
      \Storage::makeDirectory('public/'.$path);
      $namaBerkas = 'avatar'.date('ymdhis').'.png';
      $image = \Image::make($data);
      $image->save(storage_path('app/public/'.$path.'/'.$namaBerkas));
      $arr = ['up' => $namaBerkas , 'path' => $path];
      return $arr;
    }
}
