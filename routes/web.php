<?php

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

use App\Data;
Route::get ( 'datables', function () {
    $data = Data::all ();
    return view ('file_template')->withData ( $data );
} );
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
Route::post ( '/editItem', function () {
    
    $rules = array (
            'first_name' => 'required | alpha',
            'last_name' => 'required | alpha',
            'email' => 'required | e-mail',
            'department_id' => 'required | numeric',
            'manager_id' => 'required | numeric',
            'salary' => 'required | numeric'
    );
    $validator = Validator::make ( $_POST, $rules );
    if ($validator->fails ())
        return Response::json ( array ( 'errors' => $validator->getMessagebag ()->toArray ()));
    else {
        
        $data = Data::find($_POST['employee_id']);
        $data->first_name = ($_POST['first_name']);
        $data->last_name = ($_POST['last_name']);
        $data->email = ($_POST['email']);
        $data->department_id = ($_POST['department_id']);
        $data->manager_id = ($_POST['manager_id']);
        $data->salary = ($_POST['salary']);
        $data->save();
        return response ()->json ( $data );
    }
});

Route::post('/deleteItem',function(){
    $data = Data::find($_POST['employee_id']);
    $data->delete();
    return response ()->json ( $data );
});