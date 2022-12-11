<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
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
Route::get('/try',function(){
    // here we acquire the JSON folder from the api that is sent from the first project
    $res=Http::get('http://127.0.0.1:8000/api/blog');

        foreach($res->json()['order'] as $x){

            $doc=app('firebase.firestore')->database()->collection('Order');
            $doc1=$doc->where('id', '=', $x['id']);
            $res=$doc1->documents();
            $q=0;
            foreach($res as $w){
                //here we chekc if the sent element exists so we do not add existing elements q is a flag
                $q=1;
            }


           if($q==0){
            // if the element does not exist we add it to the online database ie the second firestore database
            $stuRef=app('firebase.firestore')->database()->collection('Order')->newDocument();
            $stuRef->set([
                'Fruit'=> $x['fruit'],
                'id'=>$x['id'],

            ]);
           }


        }

});
