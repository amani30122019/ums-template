<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','store']]);
        $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexPermissions(Request $request)
    {
        if ($request->ajax()) {
            $permissions = Permission::orderBy('id', 'desc')->get();
            return DataTables::of($permissions)
            ->addIndexColumn()
            ->addColumn('role', function ($user) {
                if (!empty($user->getRoleNames())) {
                    foreach ($user->getRoleNames() as $val) {
                        return ' <span class="badge bg-dark text-white">'.$val.'</span>';
                    }
                }
            })
            ->addColumn('actions', function ($row) {
                if (Gate::any(['permission-edit', 'permission-delete'])) {
                    $actionBtn =
            '<div>

            <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-id="'.$row['id'].'" id="edit-permission-btn">Edit</a>

            <a href="javascript:void(0)" class="btn btn-danger btn-sm" data-id="'.$row['id'].'" id="delete-permission-btn">Delete</a>

            </div>' ;
                    return $actionBtn;
                }
            })
            ->rawColumns(['role','actions'])
            ->make(true);
        }
       
        $permissions = Permission::orderBy('id', 'desc')->get();
        return view('admin.permissions.index', compact(['permissions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePermission(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name'
        ], [
           'name.required'=>'Please fill in this field',
           'name.unique'=>'Permission already in use,try another',
        ]);
        if ($validation->fails()) {
            return response()->json(['code'=>0,'errors'=>$validation->getMessageBag()]);
        } else {
            $permission= Permission::create(['name' => $request->name]);
            if (!$permission) {
                return response()->json(['code'=>0,'errors'=>'failed to save new permission.']);
            } else {
                return response()->json(['code'=>1,'msg'=>'Permission created successfully.']);
            }
            return redirect()->route('permissions.index')
            ->with('success', '');
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
        $permission = Permission::find($id);
        return view('admin.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPermission(Request $request)
    {
        $permission = Permission::find($request->permissionId);
        return response()->json(['permission'=>$permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePermission(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'permission_name' => 'required|unique:permissions,name,'.$request->pid,
        ], [
           'permission_name.required'=>'Please fill in this field'
        ]);
        if ($validation->fails()) {
            return response()->json(['code'=>0,'errors'=>$validation->getMessageBag()]);
        } else {
            $permission = Permission::find($request->pid);
            $permission->name = $request->input('permission_name');
            $updated =  $permission->save();
            if ($updated) {
                return response()->json(['code'=>1,'msg'=>'Permission updated successfully']);
            } else {
                return response()->json(['code'=>0,'error'=>'Something is wrong, Failed to update Permission']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyPermission(Request $request)
    {
        $id= $request->permissionId;
        $deleted= Permission::find($id)->delete();
        if (!$deleted) {
            return response()->json(['code'=>0,'error'=>'Something has gone wrong,Permission not DELETED']);
        } else {
            return response()->json(['code'=>1,'msg'=>'Permission deleted successfully']);
        }
    }
}
