<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponser;
Class UserController extends Controller {
use ApiResponser;

private $request;
public function __construct(Request $request){
$this->request = $request;
}
public function getUsers(){
$users = User::all();
return response()->json($users, 200);
}


public function index()
{

$users = User::all();
return $this->successResponse($users);
}
public function add(Request $request ){
$rules = [
'username' => 'required|max:150',
'password' => 'required|max:150',

];
$this->validate($request,$rules);
$user = User::create($request->all());

return $this->successResponse($user);
}
public function show($id)
{
$user = User::findOrFail($id);
return $this->successResponse($user);

}

public function update(Request $request,$id)
{
$rules = [
'username' => 'max:150',
'password' => 'max:150',

];
$this->validate($request, $rules);
$user = User::findOrFail($id);
$user->fill($request->all());


if ($user->isClean()) {
return $this->errorResponse('At least one value must
change', Response::HTTP_UNPROCESSABLE_ENTITY);
}
$user->save();
return $this->successResponse($user);

}

public function delete($id)
{
$user = User::findOrFail($id);
$user->delete();
return $this->successResponse($user);
}
}
