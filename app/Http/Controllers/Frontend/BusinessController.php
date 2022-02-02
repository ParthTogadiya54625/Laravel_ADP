<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\GetData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBusiness;
use App\Http\Requests\UpdateBusiness;
use App\Models\Business;
use App\Models\Heading;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Business::where('user_id',Auth()->user()->id)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = "";
                    $editRoute = route('frontend.business.edit', ['id' => $row->id]);
                    $html .= '<a href="'.$editRoute.'" class="btn btn-warning" title="Edit"> <i class="fas fa-pencil-alt"></i> </a>';
                    $html .= '<a href="javascript:;" onclick="deleteBusiness('.$row->id.')" class="btn btn-danger m-1" title="Delete"> <i class="fas fa-trash-alt"></i> </a>';
                    $selectHeadingRoute = route('frontend.business.selectHeading', ['id' => $row->id]);
                    $html .= '<a href="'.$selectHeadingRoute.'" class="btn btn-primary" title="Select Heading"><i class="fas fa-heading"></i></a>';
                    $selectHeadingRoute = route('frontend.generatePDF', ['id' => $row->id]);
                    $html .= '<a href="'.$selectHeadingRoute.'" class="btn btn-success m-1" title="Download Pdf"> <i class="fas fa-file-pdf"></i> </a>';
                    return $html;
                })
                ->addColumn('logo', function ($row) {
                    $src =  $row->logo ? asset('storage/business/' . $row->logo) : asset('assets/images/no-image.jpg');
                    return  "<img src={$src} style='height: 70px; width: 70px' alt='Publisher'>";
                })
                ->rawColumns(['action', 'logo'])
                ->make(true);
        }
        return view("frontend.business.index");
    }

    public function create()
    {
        return view("frontend.business.create");
    }

    public function store(StoreBusiness $request)
    {
        $newBusiness = new Business();
        $newBusiness->user_id = Auth::user()->id;
        $newBusiness->name = $request->name;
        $newBusiness->address = $request->address;
        $newBusiness->address2 = $request->address2;
        $newBusiness->city = $request->city;
        $newBusiness->state = $request->state;
        $newBusiness->zipcode = $request->zipcode;
        $newBusiness->phone = $request->phone;
        $newBusiness->url = $request->url;
        $newBusiness->email = $request->email;
        $newBusiness->save();
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = 'business-' . $newBusiness->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/business'), $imageName);
            $newBusiness->logo = $imageName;
        }
        $newBusiness->save();

        return redirect(route('frontend.business.index'))->with("success","Business added successfully...");
    }

    public function edit($id)
    {
        $business = GetData::getBusinessDetail($id);
        if ($business) {
            return view("frontend.business.edit", compact("business"));
        }else{
            return back()->with("error", "Record not found...");
        }
    }

    public function update(UpdateBusiness $request)
    {
        $business = GetData::getBusinessDetail($request->id);
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

        return redirect(route('frontend.business.index'))->with("success","Business updated successfully...");
    }

    public function destroy(Request $request)
    {
        $business = GetData::getBusinessDetail($request->id);
        if ($business) {
            if (File::exists(public_path('storage/business/') . $business->logo)) {
                File::delete(public_path('storage/business/') . $business->logo);
            }
            $business->delete();
            return response()->json([
                "status" => 200,
                "message" => "Business deleted successfully..."
            ]);
        }
    }



    public function selectHeading($id)
    {
        $business = GetData::getBusinessDetail($id);
        if ($business && Auth::user()->id === $business->user->id ) {
            return view('frontend.heading.index',compact('business'));
        }else{
            return back()->with('error','Something went wrong...');
        }
    }

    public function getHeadings(Request $request)
    {
        $role = Heading::select('id as id', 'name as text')
                ->where('name', 'like', '%' . $request->searchTerm . '%')
                ->take(5)
                ->latest()
                ->get();

        return response()->json($role);
    }

    public function assignHeadings(Request $request)
    {
        $request->validate([
            'heading' => 'required',
        ]);

        $business = GetData::getBusinessDetail($request->business_id);
        $business->headings()->sync($request->heading);
        $data = Heading::whereIn('id',$request->heading)->get();

        return response()->json([
            "status" => 200,
            "data" => $data
        ]);
    }

    public function assignImageKeyword($business_id, Request $request)
    {
        $business = GetData::getBusinessDetail($business_id);
        if ($business && Auth::user()->id === $business->user->id ) {
            $pivot = $business->headings->where('id', $request->heading_id)->first()->pivot;
            $response = GetData::syncPivotData($business_id, $request->heading_id, ['additional_keywords', 'offered_keywords']);
            $heading = $response['heading'];
            $offeredKeywords = $response['offeredKeywords'];
            $additionalKeywords = $response['additionalKeywords'];
            return view('frontend.image_keyword.index',compact('business','heading','offeredKeywords','additionalKeywords', 'pivot'));
        }
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            "image" => 'nullable|mimes:png,jpg,jpeg'
        ]);

        $business = GetData::getBusinessDetail($request->business_id);
        $pivot = $business->headings->where('id', $request->heading_id)->first()->pivot;
        if ($request->hasFile('image')) {
            if (File::exists(public_path('storage/headings/') . $pivot->image)) {
                File::delete(public_path('storage/headings/') . $pivot->image);
            }
            $image = $request->file('image');
            $imageName = 'heading-image-'.$request->business_id.'-'.$request->heading_id.'.'. $image->getClientOriginalExtension();
            $image->move(public_path('storage/headings'), $imageName);
            GetData::syncPivotData($request->business_id, $request->heading_id, ['image'], $imageName);
        }

        return response()->json([
            "status" => 200,
            "image" => $imageName
        ]);
    }

    public function storeAdditionalKeyword(Request $request)
    {
        $request->validate([
            "additional_keyword" => 'required'
        ]);

        $newKeyword = new Keyword();
        $newKeyword->super_admin_user_id = Auth()->user()->id;
        $newKeyword->heading_id = $request->heading_id;
        $newKeyword->name = $request->additional_keyword;
        $newKeyword->save();

        GetData::syncPivotData($request->business_id, $request->heading_id, ['additional_keywords']);

        return response()->json([
            "status" => 200,
            "message" => "Keyword added successfully...",
            "data" => $newKeyword,
        ]);
    }

    public function destroyAdditionalKeyword(Request $request)
    {
        $keyword = Keyword::find($request->keyword_id);
        if ($keyword) {
            $keyword->delete();
            GetData::syncPivotData($request->business_id, $request->heading_id, ['additional_keywords']);

            return response()->json([
                "status" => 200,
                "message" => "keyword deleted successfully..."
            ]);
        }
    }
}
