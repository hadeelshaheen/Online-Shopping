<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
//        $user = User::all();
        // dd($user->toArray());

       // $user = DB::table('users')->get();
//        foreach ($user as $users){
//            echo $users->name;
//        }
//        dd();

        //$user = DB::table('users')->where('id',1)->get();
       /* اكثر من شرط
       $user = DB::table('users')->where([
            ['id',1],
            ['id2',2]
        ])->get();*/

//        $user = DB::table('users')
//            ->select('name')
//            ->where('id',1)
//            ->where('name','hadeel')
//            ->get();
//        dd($user);

        // select from 2 table
//                $user = DB::table('users')
//                    ->join('products','products.id','user.productId')
//                    ->select('product.name','user.name')->get();

        //insert
//        $user = DB::table('users')->insert([
//           'name'=>'lina',
//           'password'=>'123'
//        ]);
//update
        // DB::table('users')->where('id',2)->update(['password'=>'12345']);
//        DB::table('users')->where('id',3)->delete();

        $user =User::all();
        return view('Dashboard.user',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user =User::all();
        return view('Dashboard.add_user',compact('user'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'userType'=>'required',
            'password'=>'required'
        ]);

        $user =new User();
        $user->name = $request->input('name');
        $user->userType = $request->input('userType');
        $user->password = $request->input('password');
        $user->save();
        return redirect()->route('users.index')->with('success','added done');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     */
    public function edit( User $user)
    {
        return view('Dashboard.edit_user',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $this->validate($request,[
            'name'=>'required',
            'userType'=>'required',
            'password'=>'required'
        ]);
        $user->name = $request->input('name');
        $user->userType = $request->input('userType');
        $user->password = $request->input('password');
        $user->save();
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');

    }
}
