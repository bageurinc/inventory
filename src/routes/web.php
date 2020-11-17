<?php
Route::name('bageur.')->group(function () {
	Route::group(['prefix' => 'bageur/v1','middleware' => 'api'], function () {
		Route::apiResource('inventory', 'bageur\Inventory\InventoryController');
	});
});