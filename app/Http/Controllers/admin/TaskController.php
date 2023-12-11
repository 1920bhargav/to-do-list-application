<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            
            $user = Task::orderBy('id', 'desc')->get();
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
        return view('admin.task.index');
    }

    public function create()
    {
        return view('admin.task.create');
    }
}
