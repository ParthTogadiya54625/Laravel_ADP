<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GetData;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBusiness;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:publisher-list', ['only' => ['index']]);
        $this->middleware('permission:publisher-edit', ['only' => ['edit','update']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Business::with('user')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = "";
                    $user = auth()->user();
                    if($user->can('business-edit')){
                        $editRoute = route('admin.business.edit', ['id' => $row->id]);
                        $html .= '<a href="'.$editRoute.'" class="btn btn-warning rounded-circle" title="Edit"> <i class="fas fa-pencil-alt"></i> </a>';
                    }
                    return $html;
                })
                ->addColumn('logo', function ($row) {
                    $src =  $row->logo ? asset('storage/business/' . $row->logo) : asset('assets/images/no-image.jpg');
                    return  "<img src={$src} style='height: 70px; width: 70px' alt='Publisher'>";
                })
                ->addColumn('user_name', function ($row) {
                    return $row->user->full_name;
                })
                ->rawColumns(['action', 'logo','user_name'])
                ->make(true);
        }
        return view('admin.business.index');
    }

    public function edit($id)
    {
        $business = GetData::getBusinessDetail($id);
        if ($business) {
            return view("admin.business.edit", compact("business"));
        }else{
            return back()->with("error", "Record not found...");
        }
    }

    public function update(UpdateBusiness $request)
    {
        $business = GetData::getBusinessDetail($request->id);
        // $business = Business::find($request->id);
        $business->name = $request->name;
        $business->address = $request->address;
        $business->address2 = $request->address2;
        $business->city = $request->city;
        $business->state = $request->state;
        $business->zipcode = $request->zipcode;
        $business->phone = $request->phone;
        $business->url = $request->url;
        $business->email = $request->email;
        if ($request->hasFile('logo')) {
            if ($business->logo) {
                File::delete(public_path('storage/business/') . $business->logo);
            }
            $image = $request->file('logo');
            $imageName = 'business-' . $business->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/business'), $imageName);
            $business->logo = $imageName;
        }
        $business->update();

        return redirect(route('admin.business.index'))->with("success","Business updated successfully...");
    }
}
