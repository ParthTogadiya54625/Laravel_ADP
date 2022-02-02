<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\DataTables\UsersDataTable;
use App\Helpers\GetData;
use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherRegister;
use App\Http\Requests\PublisherUpdate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class PublisherController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:publisher-list', ['only' => ['index']]);
        $this->middleware('permission:publisher-create', ['only' => ['create','store']]);
        $this->middleware('permission:publisher-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:publisher-delete', ['only' => ['destroy']]);
    }

    public function activationReq()
    {
        $publishers =  Role::with('users')->where('name', 'publisher-admin')->first();
        $inactivePublishers = $publishers->users->where('status', config('constants.user.status_code.inactive'));
        return view('admin.publisher.activation-request', compact('inactivePublishers'));
    }

    public function acceptdeclineReq(Request $request)
    {
        // $publisher = User::find($request->id);
        $publisher = GetData::getUserDetail($request->id);
        if ($publisher) {
            if ($request->status) {
                $publisher->status = config('constants.user.status_code.active');;
                $publisher->save();
                //send request accept mail to user
                return response()->json([
                    "status" => 1,
                    "message" => "Request accepted...",
                ]);
            } else {
                if (File::exists(public_path('storage/publishers/') . $publisher->logo)) {
                    File::delete(public_path('storage/publishers/') . $publisher->logo);
                }
                $publisher->delete();
                //send request decline mail to user
                return response()->json([
                    "status" => 0,
                    "message" => "Request declined..."
                ]);
            }
        }
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $publishers =  Role::with('users')->where('name', 'publisher-admin')->first();
            $data = $publishers->users->where('status', config('constants.user.status_code.active'))->sortDesc();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = "";
                    $user = auth()->user();
                    if($user->can('publisher-edit')){
                        $editRoute = route('admin.publisher.edit', ['id' => $row->id]);
                        $html .= '<a href="'.$editRoute.'" class="btn btn-warning rounded-circle" title="Edit"> <i class="fas fa-pencil-alt"></i> </a>';
                    }
                    if($user->can('publisher-delete')){
                        $html .= '<a href="javascript:;" onclick="deletePublisher('.$row->id.')" class="btn btn-danger rounded-circle m-1" title="Delete"> <i class="fas fa-trash-alt"></i> </a>';
                    }
                    if($user->can('publisher-list')){
                        $html .= '<a href="javascript:;" onclick="setPublisherInfo('.$row->id.')" class="btn btn-primary rounded-circle" title="Publisher Info" data-bs-toggle="modal" data-bs-target="#publisherInfoModal"><i class="fas fa-eye"></i></a>';
                    }
                    if($user->can('user-list')){
                        $userIndexRoute = route('admin.user.index', ['id' => $row->id]);
                        $html .= '<a href="'.$userIndexRoute.'" class="btn btn-success rounded-circle m-1" title="Add User"> <i class="fas fa-user"></i> </a>';
                    }
                    return $html;
                })
                ->addColumn('logo', function ($row) {
                    $src =  $row->logo ? asset('storage/publishers/' . $row->logo) : asset('assets/images/users/avatar5.png');
                    return  "<img src={$src} style='height: 70px; width: 70px' alt='Publisher'>";
                })
                ->rawColumns(['action', 'logo'])
                ->make(true);
        }
        return view('admin.publisher.index');
    }

    public function create()
    {
        return view('admin.publisher.create');
    }

    public function store(PublisherRegister $request)
    {
        $newPublisher = new User();
        $newPublisher->first_name = $request->first_name;
        $newPublisher->last_name = $request->last_name;
        $newPublisher->company = $request->company;
        $newPublisher->email = $request->email;
        $newPublisher->password = Hash::make($request->password);
        $newPublisher->phone = $request->phone;
        $newPublisher->address = $request->address;
        $newPublisher->address2 = $request->address2;
        $newPublisher->city = $request->city;
        $newPublisher->state = $request->state;
        $newPublisher->zipcode = $request->zipcode;
        $newPublisher->url = $request->url;
        $newPublisher->status = $request->status;
        $newPublisher->save();
        $newPublisher->assignRole('publisher-admin');
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = 'publisher-' . $newPublisher->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/publishers'), $imageName);
            $newPublisher->logo = $imageName;
        }
        $newPublisher->save();

        return redirect(route('admin.publisher.index'))->with("success", "Publisher added sucessfully...");
    }

    public function edit($id)
    {
        // $publisher = User::find($id);
        $publisher = GetData::getUserDetail($id);
        if ($publisher) {
            return view('admin.publisher.edit', compact('publisher'));
        }

        return redirect(route('admin.publisher.index'))->with("error", "Could not find publisher...");
    }

    public function update(PublisherUpdate $request)
    {
        // $publisher = User::find($request->id);
        $publisher = GetData::getUserDetail($request->id);
        if ($publisher) {
            $publisher->first_name = $request->first_name;
            $publisher->last_name = $request->last_name;
            $publisher->company = $request->company;
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
            if ($request->hasFile('logo')) {
                if ($publisher->logo) {
                    File::delete(public_path('storage/publishers/') . $publisher->logo);
                }
                $image = $request->file('logo');
                $imageName = 'publisher-' . $publisher->id . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/publishers'), $imageName);
                $publisher->logo = $imageName;
            }
            $publisher->save();

            return redirect(route('admin.publisher.index'))->with("success", "Publisher updated sucessfully...");
        }
        return redirect(route('admin.publisher.index'))->with("error", "Could not find publisher...");
    }

    public function destroy(Request $request)
    {
        // $publisher = User::find($request->id);
        $publisher = GetData::getUserDetail($request->id);
        if ($publisher) {
            $keywords = User::where('publisher_id', $request->id)->get();
            if ($keywords->isNotEmpty()) {
                return response()->json([
                    "status" => 404,
                    "message" => "publisher is associated with user, You cannot delete..."
                ]);
            }else{
                if (File::exists(public_path('storage/publishers/') . $publisher->logo)) {
                    File::delete(public_path('storage/publishers/') . $publisher->logo);
                }
                $publisher->delete();
                return response()->json([
                    "status" => 200,
                    "message" => "Publisher deleted successfully..."
                ]);
            }
        }
    }

    public function getPublisherData(Request $request)
    {
        // $publisher = User::find($request->id);
        $publisher = GetData::getUserDetail($request->id);
        return response()->json([
            "status" => 200,
            "publisher" => $publisher,
        ]);
    }


    /**
     * Frontend functions start from here
     */
    public function register()
    {
        // return User::with('roles')->first();
        return view('frontend.publisher.register');
    }

    public function registration(PublisherRegister $request)
    {
        $newPublisher = new User();
        $newPublisher->first_name = $request->first_name;
        $newPublisher->last_name = $request->last_name;
        $newPublisher->company = $request->company;
        $newPublisher->email = $request->email;
        $newPublisher->password = Hash::make($request->password);
        $newPublisher->phone = $request->phone;
        $newPublisher->address = $request->address;
        $newPublisher->address2 = $request->address2;
        $newPublisher->city = $request->city;
        $newPublisher->state = $request->state;
        $newPublisher->zipcode = $request->zipcode;
        $newPublisher->url = $request->url;
        $newPublisher->status = config("constants.user.status_code.inactive");
        $newPublisher->save();
        $newPublisher->assignRole('publisher-admin');
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = 'publisher-' . $newPublisher->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/publishers'), $imageName);
            $newPublisher->logo = $imageName;
        }
        $newPublisher->save();

        return back()->with("success", "Your applicated received, admin will authorized and informed you soon...");
    }
}
