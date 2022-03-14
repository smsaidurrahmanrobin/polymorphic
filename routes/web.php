<?php

use App\Models\Staff;
use App\Models\Photo;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function (){

    $staff = Staff::find(1);

    $staff->photos()->create(['path'=>'another.jpg']);

});

Route::get('/read', function (){

    $staff = Staff::findorfail(1);

    foreach ($staff->photos as $photo){


        return $photo->find(1)->path;

    }

});


Route::get('/update', function (){

    $staff = Staff::findorfail(1);

    $photo = $staff->photos()->whereId(1)->first();

    $photo->path = "Updated.jpg";
    $photo->update();



});

Route::get('/delete', function (){

    $staff = Staff::findorfail(1);

   $staff->photos()->wherePath('Updated.jpg')->delete();



});


//-----------------extra techniques-----------------------


Route::get('/assign', function (){

    $staff = Staff::findorfail(1);

    $photo = Photo::findorfail(5);

    $staff->photos()->save($photo);

});

Route::get('/unassign', function (){

    $staff = Staff::findorfail(1);

    $staff->photos()->whereId(5)->update(['imageable_id'=>'0', 'imageable_type'=>'']);

});
