<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GetData;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStore;
use App\Http\Requests\UserUpdate;
use App\Models\Keyword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user-list', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $allUsers =  Role::with('users')->where('name', 'user')->first();
            $data = $allUsers->users->where('publisher_id',$id)->sortDesc();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = "";
                    $user = auth()->user();
				    if($user->can('user-edit')){
                        $editRoute = route('admin.user.edit', ['id' => $row->id]);
                        $html .= '<a href="'.$editRoute.'" class="btn btn-warning rounded-circle" title="Edit"> <i class="fas fa-pencil-alt"></i> </a>';
                    }
                    if($user->can('user-delete')){
                        $html .= '<a href="javascript:;" onclick="deleteUser('.$row->id.')" class="btn btn-danger m-1 rounded-circle" title="Delete"> <i class="fas fa-trash-alt"></i> </a>';
                    }
                    if($user->can('user-list')){
                        $html .= '<a href="javascript:;" onclick="setUserInfo('.$row->id.')" class="btn btn-primary rounded-circle" title="Publisher Info" data-bs-toggle="modal" data-bs-target="#userInfoModal"><i class="fas fa-eye"></i></a>';
                    }
                    return $html;
                })
                ->addColumn('checkbox', function ($row) {
                    return '<div class="form-check mr-sm-2">
                                <input type="checkbox" class="form-check-input user-check" name="user_ids[]" value="'.$row->id.'">
                            </div>';
                })
                ->rawColumns(['checkbox','action'])
                ->make(true);
        }
        // $publisher = User::find($id);
        $publisher = GetData::getUserDetail($id);
        return view('admin.user.index', compact('publisher'));
    }

    public function create($id)
    {
        // $publisher = User::find($id);
        $publisher = GetData::getUserDetail($id);
        if ($publisher) {
            return view('admin.user.create', compact('publisher'));
        }
        return redirect(route('admin.auth.dashboard'))->with("error", "something went wrong...");
    }

    public function store(UserStore $request)
    {
        $newUser = new User();
        $newUser->publisher_id = $request->publisher_id;
        $newUser->first_name = $request->first_name;
        $newUser->last_name = $request->last_name;
        // $newUser->company = $request->company;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->phone = $request->phone;
        $newUser->address = $request->address;
        $newUser->address2 = $request->address2;
        $newUser->city = $request->city;
        $newUser->state = $request->state;
        $newUser->zipcode = $request->zipcode;
        // $newUser->url = $request->url;
        $newUser->status = $request->status;
        $newUser->save();
        $newUser->assignRole('user');
        $newUser->save();

        return redirect(route('admin.user.index',['id'=>$request->publisher_id]))->with("success", "User added successfully...");
    }

    public function edit($id)
    {
        // $user = User::find($id);
        $user = GetData::getUserDetail($id);
        if ($user) {
            // $publisher = User::find($user->publisher_id);
            $publisher = GetData::getUserDetail($user->publisher_id);

            return view('admin.user.edit', compact('user','publisher'));
        }
        return redirect(route('admin.auth.dashboard'))->with("error", "something went wrong...");
    }

    public function update(UserUpdate $request)
    {
        // $publisher = User::find($request->id);
        $publisher = GetData::getUserDetail($request->id);
        if ($publisher) {
            $publisher->first_name = $request->first_name;
            $publisher->last_name = $request->last_name;
            // $publisher->company = $request->company;
            $publisher->email = $request->email;
            if ($request->filled('password')) {
                $publisher->password = Hash::make($request->password);
            }
            $publisher->phone = $request->phone;
            $publisher->address = $request->address;
            $publisher->address2 = $request->address2;
            $publisher->city = $request->city;
            $publisher->state = $request->state;
            $publisher->zipcode = $request->zipcode;
            $publisher->url = $request->url;
            $publisher->status = $request->status;
            // if ($request->hasFile('logo')) {
            //     if ($publisher->logo) {
            //         File::delete(public_path('storage/publishers/') . $publisher->logo);
            //     }
            //     $image = $request->file('logo');
            //     $imageName = 'publisher-' . $publisher->id . '.' . $image->getClientOriginalExtension();
            //     $image->move(public_path('storage/publishers'), $imageName);
            //     $publisher->logo = $imageName;
            // }
            $publisher->save();

            return redirect(route('admin.user.index',['id'=>$request->publisher_id]))->with("success", "User updated sucessfully...");
        }
        return redirect(route('admin.user.index',['id'=>$request->publisher_id]))->with("error", "Could not find user...");
    }

    public function destroy(Request $request)
    {
        // $user = User::find($request->id);
        $user = GetData::getUserDetail($request->id);
        if ($user) {
            $user->delete();
            return response()->json([
                "status" => 200,
                "message" => "User deleted successfully..."
            ]);
        }
    }

    public function destroyMultiple(Request $request)
    {
        // return $request->all();
        User::whereIn('id', $request->user_ids)->delete();
        return response()->json();
    }
}
