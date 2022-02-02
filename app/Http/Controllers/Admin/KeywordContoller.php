<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\KeywordDataTable;
use App\Http\Controllers\Controller;
use App\Models\Heading;
use App\Models\Keyword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

use function GuzzleHttp\Promise\all;

class KeywordContoller extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:keyword-list', ['only' => ['index']]);
        $this->middleware('permission:keyword-create', ['only' => ['store']]);
        $this->middleware('permission:keyword-edit', ['only' => ['update']]);
        $this->middleware('permission:keyword-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request,$heading_id)
    {
        // $this->heading = Heading::where('id', $heading_id)->first();
		// return $dataTable->render('admin.keyword.index', $this->data);
        $superAdminIDs = [1];

        if ($request->ajax()) {
            $data = Keyword::where("heading_id", $heading_id)->whereIn("super_admin_user_id",$superAdminIDs)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = "";
                    $user = auth()->user();
                    if($user->can('keyword-edit')){
                        $html .= '<a href="javascript:;" onclick="editKeyword('.$row->id.',`'.$row->name.'`)" class="btn btn-warning rounded-circle" title="Edit"> <i class="fas fa-pencil-alt"></i> </a>';
                    }
                    if ($user->can('keyword-delete')) {
                        $html .= '<a href="javascript:;" onclick="deleteKeyword('.$row->id.')" class="btn btn-danger m-1 rounded-circle" title="Delete"> <i class="fas fa-trash-alt"></i> </a>';
                    }
                    return $html;
                })
                ->addColumn('checkbox', function ($row) {
                    return '<div class="form-check mr-sm-2">
                                <input type="checkbox" class="form-check-input keyword-check" name="keyword_ids[]" value="'.$row->id.'">
                            </div>';
                })
                ->rawColumns(['checkbox','action'])
                ->make(true);
        }

        $heading = Heading::where('id', $heading_id)->first();
        return view('admin.keyword.index', compact('heading'));
    }

    public function list(Request $request,$heading_id)
    {
        $superAdminIDs = [1];

        if ($request->ajax()) {
            $data = Keyword::where("heading_id", $heading_id)->whereNotIn("super_admin_user_id",$superAdminIDs)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = "";
                    $user = auth()->user();
                    if ($user->can('keyword-delete')) {
                        $html .= '<a href="javascript:;" onclick="deleteKeyword('.$row->id.')" class="btn btn-danger rounded-circle" title="Delete"> <i class="fas fa-trash-alt"></i> </a>';
                    }
                    return $html;
                })
                ->addColumn('user_name', function ($row) {
                    return User::find($row->super_admin_user_id)->full_name;
                })
                ->addColumn('checkbox', function ($row) {
                    return '<div class="form-check mr-sm-2">
                                <input type="checkbox" class="form-check-input user-keyword-check" name="keyword_ids[]" value="'.$row->id.'">
                            </div>';
                })
                ->rawColumns(['checkbox','action','user_name'])
                ->make(true);
        }

        $heading = Heading::where('id', $heading_id)->first();
        return view('admin.keyword.index', compact('heading'));
    }

    // public function create()
    // {

    // }

    public function store(Request $request)
    {
        $request->validate([
            'keyword' => 'required',
        ]);

        $newKeyword = new Keyword();
        $newKeyword->super_admin_user_id = $request->super_admin_user_id;
        $newKeyword->heading_id = $request->heading_id;
        $newKeyword->name = $request->keyword;
        $newKeyword->save();

        return response()->json([
            "status" => 200,
            "message" => "Keyword added successfully..."
        ]);
    }

    // public function edit($id)
    // {

    // }

    public function update(Request $request)
    {
        $request->validate([
        	'keyword' => 'required',
        ]);

        $keyword = Keyword::find($request->id);
        if ($keyword) {
            $keyword->name = $request->keyword;
            $keyword->update();

            return response()->json([
                "status" => 200,
                "message" => "keyword updated successfully..."
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $keyword = Keyword::find($request->id);
        if ($keyword) {
            $keyword->delete();

            return response()->json([
                "status" => 200,
                "message" => "keyword deleted successfully..."
            ]);
        }
    }

    public function destroyMultiple(Request $request)
    {
        // return $request->all();
        Keyword::whereIn('id', $request->keyword_ids)->delete();
        return response()->json();
    }
}
