<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DataTables;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $user = User::where('is_deleted',0)->orderBy('id', 'desc')->get();
            return Datatables::of($user)
                        ->addIndexColumn()
                        ->addColumn('status', function($row) {
                            $active = ($row->active == 1) ? 'checked' : '';
                            $switch = '<label class="switch s-primary mr-2">
                                            <input type="checkbox" class="status" id="status_'.$row->id.'" data-user_id='.$row->id.' data-status='.$row->active.' '.$active.'>
                                            <span class="slider round"></span>
                                        </label>';
                            return $switch;
                        })
                        ->addColumn('action', function($row) {
                            $user_edit_route = route('admin.user.edit',$row->id);
                            $btn = "<a href='$user_edit_route' class='edit btn btn-outline-primary'>Edit</a> 
                            <a href='javascript:void(0)' class='delete btn btn-outline-danger' data-user_id=".$row->id.">Delete</a>";
                            return $btn;
                        })
                        ->rawColumns(['action','status'])
                        ->make(true);
        }            
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'phone'=>'required',
            'email'=>'required',
            'password' => 'required',
            'address' => 'required',
        ]);
        
        $input = $request->all();
        $profile_picture = $request->file('profile_picture');
        if ($profile_picture) {
            $imageName = hash('sha1', $profile_picture->getClientOriginalName() . random_int (100, 1000000)).'.'.$profile_picture->extension();
            $profile_picture->move(public_path('images/profile_picture/'), $imageName);
            $input['profile_picture'] = "profile_picture/".$imageName;
        }
        
        $input['password'] = bcrypt($request->password);
        $input['created_on'] = time();
        $user = User::create($input);
        return redirect()->route('user.index')->with('success','User created successfully');
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
     */
    public function edit($id)
    {
        $user_data = User::where('id', $id)->first();
        return view('admin.user.edit', compact('user_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'phone'=>'required',
            'email'=>'required',
            'address' => 'required',
        ]);
        $update_data = [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        $profile_picture = $request->file('profile_picture');
        if ($profile_picture) {
            if (!empty($request->old_profile_picture)) {
                unlink(public_path('images/'.$request->old_profile_picture));
            }
            $imageName = hash('sha1', $profile_picture->getClientOriginalName() . random_int (100, 1000000)).'.'.$profile_picture->extension();
            $profile_picture->move(public_path('images/profile_picture/'), $imageName);
            $update_data['profile_picture'] = "profile_picture/".$imageName;
        }
        
        $update_data['updated_on'] = time();
        User::where('id', $request->user_id)->update($update_data);
        return redirect()->route('user.index')->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = User::where('id', $request->user_id)->update(['is_deleted' => 1]);
        if ($delete) {
            return response()->json(['message'=> "User Deleted successfully.", 'status' => 1]);
        } else {
            return response()->json(['message'=> "User not deleted.", 'status' => 0]);
        }
    }

    public function change_status(Request $request) {
        
        $update_data['active'] = ($request->status == 0) ? 1 : 0;
        $user = User::where('id', $request->user_id)->update($update_data);
        if($user) {
            return response()->json(['message'=> "User status changed successfully.", 'status' => 1, 'active' => $update_data['active']]);
        } else {
            return response()->json(['message'=> "User status not changed, please try again", 'status' => 0]);
        }
    }
}
