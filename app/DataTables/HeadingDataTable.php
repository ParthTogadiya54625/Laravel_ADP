<?php

namespace App\DataTables;

use App\Models\Heading;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HeadingDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $html = "";
				$user = auth()->user();
				if($user->can('heading-edit')){
					$html .= '<a href="javascript:;" onclick="editHeading('.$row->id.',`'.$row->name.'`,`'.$row->image.'`)" class="btn btn-warning rounded-circle" title="Edit"> <i class="fas fa-pencil-alt"></i> </a>';
				}
				if ($user->can('heading-delete')) {
					$html .= '<a href="javascript:;" onclick="deleteHeading('.$row->id.')" class="btn btn-danger m-1 rounded-circle" title="Delete"> <i class="fas fa-trash-alt"></i> </a>';
				}
				if ($user->can('keyword-list')) {
                    $html .= '<a href="'. route('admin.keyword.index', ['heading_id' => $row->id]) .'" class="btn btn-primary rounded-circle" title="keyword"> <i class="fab fa-rocketchat"></i> </a>';
                }
				return $html;
			})
            ->addColumn('image', function ($row) {
                $src =  $row->image ? asset('storage/headings/' . $row->image) : asset('assets/images/no-image.jpg');
                return  "<img src={$src} style='height: 70px; width: 70px' alt='heading image'>";
            })
			->rawColumns(['image','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Heading $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Heading $model)
    {
        if (!request('order')) {
			return $model->latest()->newQuery();
		}else{
			return $model->newQuery();
		}
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('heading-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
					->orders([]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')->title('#')->orderable(false)->width('5%'),
            Column::computed('image')->exportable(false)->printable(false),
            Column::make('name'),
            Column::computed('action')->exportable(false)->printable(false)->width(150)->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Heading_' . date('YmdHis');
    }
}
