<?php

namespace Bageur\Inventory\Model;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Bageur\Inventory\Processors\AvatarProcessor;

class inventory extends Model
{
    protected $table   = 'bgr_inventory';
    protected $appends = ['avatar', 'harga_barang'];

    public function getAvatarAttribute()
    {
            return AvatarProcessor::get($this->nama,$this->gambar,$this->gambar_path);
    }     
    public function getHargaBarangAttribute()
    {
            $cur = number_format($this->harga, 0, '.', '.');
            return $cur;
    }     
    public function scopeDatatable($query,$request,$page=7)
    {
          $search       = ["nama"];
          $searchqry    = '';

        $searchqry = "(";
        foreach ($search as $key => $value) {
            if($key == 0){
                $searchqry .= "lower($value) like '%".strtolower($request->search)."%'";
            }else{
                $searchqry .= "OR lower($value) like '%".strtolower($request->search)."%'";
            }
        } 
        $searchqry .= ")";
        if(@$request->sort_by){
            if(@$request->sort_by != null){
            	$explode = explode('.', $request->sort_by);
                 $query->orderBy($explode[0],$explode[1]);
            }else{
                  $query->orderBy('created_at','desc');
            }

             $query->whereRaw($searchqry);
        }else{
             $query->whereRaw($searchqry);
        }
        if($request->get == 'all'){
            return $query->get();
        }else{
                return $query->paginate($page);
        }

    }
}
