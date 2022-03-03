<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUsers(Request $request)
    {
        if ($request->ajax()) {
            $users = User::orderBy('id', 'desc')->get();
            return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('role', function ($user) {
                if (!empty($user->getRoleNames())) {
                    foreach ($user->getRoleNames() as $val) {
                        return ' <span class="badge bg-dark text-white">'.$val.'</span>';
                    }
                }
            })
            ->addColumn('actions', function ($row) {
                if (Gate::any(['user-edit', 'user-delete'])) {
                    $actionBtn =
            '<div>

            <a href="javascript:void(0)" class="btn btn-success btn-sm" data-id="'.$row['id'].'" id="show-user-btn">Show</a>
 
            <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-id="'.$row['id'].'" id="edit-user-btn">Edit</a>

            <a href="javascript:void(0)" class="btn btn-danger btn-sm" data-id="'.$row['id'].'" id="delete-user-btn">Delete</a>

            </div>' ;
                    return $actionBtn;
                }
            })
            ->rawColumns(['role','actions'])
            ->make(true);
        }
        $roles = Role::pluck('name', 'name')->all();
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.users.index', compact(['users','roles']));
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUser(Request $request)
    {
        $validation= Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'cpassword'=>'required|same:password',
            'roles' => 'required'
        ], [
            'first_name.required'=>'Please fill in your first name',
            'last_name.required'=>'Please fill in your last name',
            'email.required'=>'Please fill in email address',
            'email.email'=>'Please fill in valid email address',
            'email.unique'=>'This email address already taken try another',
            'cpassword.same'=>'Password do not match check well again',
            'roles.required'=>'Please select a user role',

        ]);
        if ($validation->fails()) {
            return response()->json(['code'=>0,'errors'=>$validation->getMessageBag()]);
        } else {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $roleAssigned= $user->assignRole($request->input('roles'));
            if ($user && $roleAssigned) {
                return response()->json(['code'=>1,'msg'=>'User created successfully']);
            } else {
                return response()->json(['code'=>0,'errors'=>'User not created, something has gone wrong']);
            }
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // GET USER DETAILS INTO EDIT MODAL
    public function editUser(Request $request)
    {
        $user = User::find($request->userId);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return response()->json(['user'=>$user,'roles'=>$roles,'userRole'=>$userRole]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // UPDATE USER IN DATABASE
    public function updateUser(Request $request)
    {
        $userId =$request->uid;
        $validation=Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$userId,
            'roles' => 'required'
        ], [
            'first_name.required'=>'Please fill in your first name',
            'last_name.required'=>'Please fill in your last name',
            'email.required'=>'Please fill in email address',
            'email.email'=>'Please fill in valid email address',
            'email.unique'=>'This email address already taken try another',
             'roles.required'=>'Please select a user role',
        ]);

        if ($validation->fails()) {
            return response()->json(['code'=>0,'errors'=>$validation->getMessageBag()]);
        } else {
            $user = User::find($userId);
            $user->first_name= ucwords($request->first_name);
            $user->last_name= ucwords($request->last_name);
            $user->email= $request->email;
            $updated= $user->save();

            DB::table('model_has_roles')
             ->where('model_id', $userId)
             ->delete();
            $roleUpdated =$user->assignRole($request->input('roles'));
            if ($updated && $roleUpdated) {
                return response()->json(['code'=>1,'msg'=>'User  details UPDATED successfully']);
            } else {
                return response()->json(['code'=>0,'errors'=>'Something has gone wrong,User details not UPDATED']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // DELETE USER
    public function destroyUser(Request $request)
    {
        $id = $request->userId;
        $deleted= User::find($id)->delete();
        if (!$deleted) {
            return response()->json(['code'=>0,'errors'=>'Something has gone wrong,Country not DELETED']);
        } else {
            return response()->json(['code'=>1,'msg'=>'User DELETED from database successfully']);
        }
    }
    // GET USER DETAILS
    public function getUser(Request $request)
    {
        $user_details = User::find($request->userId);
        return response()->json(['user'=>$user_details]);
    }
}
