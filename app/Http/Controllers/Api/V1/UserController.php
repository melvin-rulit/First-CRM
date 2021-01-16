<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Debugbar;





class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return string
     */
    public function update(Request $request, User $user): string
    {


    }

    /**
     * Remove the specifiuser_id: this.user.id,ed resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUserNameForMenu()
    {

        $users = User::where('id', 1)->get();
//      $user = User::find(auth()->user()->id);
//return ['user' => $user->name];
        foreach ($users as $user) {
            return $user;


        }
    }

    public function savecard(Request $request): string
    {

        $field_name = $request['field_name'];
        $user = User::find($request['user_id']);
        $user->$field_name = $request['field_value'];
        $user->save();

        return "ok";
    }
}
