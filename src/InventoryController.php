<?php
namespace Bageur\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Bageur\Inventory\model\inventory;
use Bageur\Inventory\processors\UploadBase64;
use Validator;
class InventoryController extends Controller
{

    public function index(Request $request)
    {
       $query = inventory::datatable($request);
       return $query;
    }

    public function store(Request $request)
    {
        // return $request;
        $rules    	= [
                        'nama'                      => 'required|unique:bgr_inventory|min:3',
                        'unit'                      => 'required',
                        'jenis_produk'              => 'required',
                        'qty'                       => 'required|numeric',
                        'harga'                     => 'required|numeric',
                    ];             
        $messages 	= [];
        $attributes = [];

        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{

            $inventory                          = new inventory;
            $inventory->nama                    = $request->nama;
            $inventory->nama_seo                = Str::slug($request->nama);
            $inventory->keterangan              = $request->keterangan;
            $inventory->jenis_produk            = $request->jenis_produk;
            $inventory->unit                    = $request->unit;
            $inventory->qty                     = $request->qty;
            $inventory->harga                   = $request->harga;
            if($request->file != null){
                $upload                         = UploadBase64::avatarbase64($request->file,'inventory');
	           	$inventory->gambar	            = $upload['up'];
                $inventory->gambar_path         = $upload['path'];
       		}
    
            $inventory->save();
            return response(['status' => true ,'text'    => 'has input'], 200); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return inventory::findOrFail($id);
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules      = [
                        'nama'                      => 'required|unique:bgr_inventory,nama,'.$id.',id|min:3',
                        'unit'                      => 'required',
                        'jenis_produk'              => 'required',
                        'qty'                       => 'required|numeric',
                        'harga'                     => 'required|numeric',
                    ];        
        $messages   = [];
        $attributes = [];

        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{
            $inventory                          = inventory::findOrFail($id);
            $inventory->nama                    = $request->nama;
            $inventory->nama_seo                = Str::slug($request->nama);
            $inventory->keterangan              = $request->keterangan;
            $inventory->jenis_produk            = $request->jenis_produk;
            $inventory->unit                    = $request->unit;
            $inventory->qty                     = $request->qty;
            $inventory->harga                   = $request->harga;
            if($request->file != null){
                $upload                         = UploadBase64::avatarbase64($request->file,'inventory');
	           	$inventory->gambar	            = $upload['up'];
                $inventory->gambar_path         = $upload['path'];
       		}
            $inventory->save();
            return response(['status' => true ,'text'    => 'has input'], 200); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = inventory::findOrFail($id);
        $delete->delete();
        return response(['status' => true ,'text'    => 'has deleted'], 200); 
    }

}