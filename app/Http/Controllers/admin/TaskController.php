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

        if($request->has('status_list') && !empty($request->status_list)) {
            $status_i = $request->status_list;
        }  else {
            $status_i = '';
        }
        if ($request->ajax()) {

            if ($status_i == 1) {
                $user = Task::where('status', "Completed")->get();
            } else {
                $user = Task::orderBy('id', 'desc')->get();
            }

            return Datatables::of($user)
                        ->addIndexColumn()
                        ->addColumn('status', function($row) {
                            $status = $row->status;
                            $badgeClass = '';
                        
                            switch ($status) {
                                case 'In-progress':
                                    $badgeClass = 'badge badge-primary';
                                    break;
                                case 'Pending':
                                    $badgeClass = 'badge badge-warning';
                                    break;
                                case 'Completed':
                                    $badgeClass = 'badge badge-success';
                                    break;
                                default:
                                    $badgeClass = 'badge badge-secondary';
                                    break;
                            }
                        
                            return '<span class="' . $badgeClass . '">' . $status . '</span>';
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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status'=>'required',
            'description'=>'required',
        ]);
        
        $input = $request->all();
        $task = Task::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
        ], 200);
    }

    public function destroy(Request $request)
    {
        $delete = Task::where('id', $request->user_id)->delete();
        if ($delete) {
            return response()->json(['message'=> "Task Deleted successfully.", 'status' => 1]);
        } else {
            return response()->json(['message'=> "Task not deleted.", 'status' => 0]);
        }
    }
}
