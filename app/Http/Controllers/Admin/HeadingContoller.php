<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\HeadingDataTable;
use App\Http\Controllers\Controller;
use App\Models\Heading;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HeadingContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:heading-list', ['only' => ['index']]);
        $this->middleware('permission:heading-create', ['only' => ['store']]);
        $this->middleware('permission:heading-edit', ['only' => ['update']]);
        $this->middleware('permission:heading-delete', ['only' => ['gestroy']]);
    }

    public function index(HeadingDataTable $dataTable)
    {
		return $dataTable->render('admin.heading.index');
    }

    public function store(Request $request)
    {
        $request->validate([
        	'heading' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png',
        ]);

        $newheading = new Heading();
        $newheading->name = $request->heading;
        $newheading->save();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = 'heading-image-' . $newheading->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/headings'), $imageName);
            $newheading->image = $imageName;
        }
        $newheading->save();

        return response()->json([
            "status" => 200,
            "message" => "Heading added successfully..."
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
        	'heading' => 'required',
            'image' => 'nullable',
            // "image" => "mimes:jpeg,png,jpg|nullable"
        ]);

        $heading = Heading::find($request->id);
        if ($heading) {
            $heading->name = $request->heading;
            if ($request->hasFile('image')) {
                if ($heading->image) {
                    File::delete(public_path('storage/headings/') . $heading->image);
                }
                $image = $request->file('image');
                $imageName = 'heading-image-' . $heading->id . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/headings'), $imageName);
                $heading->image = $imageName;
            }
            $heading->update();

            return response()->json([
                "status" => 200,
                "message" => "Heading updated successfully..."
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $heading = Heading::find($request->id);
        if ($heading) {
            $keywords = Keyword::where('heading_id', $request->id)->get();
            if ($keywords->isNotEmpty()) {
                return response()->json([
                    "status" => 404,
                    "message" => "Heading has keywords, delete keywords first..."
                ]);
            }else{
                if (File::exists(public_path('storage/headings/') . $heading->image)) {
                    File::delete(public_path('storage/headings/') . $heading->image);
                }
                $heading->delete();
                return response()->json([
                    "status" => 200,
                    "message" => "Heading deleted successfully..."
                ]);
            }
        }
    }
}
