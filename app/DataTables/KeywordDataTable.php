<?php

namespace App\DataTables;

use App\Models\Keyword;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KeywordDataTable extends DataTable
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
                if($user->can('keyword-edit')){
                    $html .= '<a href="javascript:;" onclick="editKeyword('.$row->id.',`'.$row->name.'`)" class="btn btn-warning"
                    title="Edit"> <i class="fas fa-pencil-alt"></i> </a>';
                }
                if ($user->can('keyword-delete')) {
                    $html .= '<a href="javascript:;" onclick="deleteKeyword('.$row->id.')" class="btn btn-danger m-2" title="Delete"> <i class="fas fa-trash-alt"></i> </a>';
                }
                return $html;
            })
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Keyword $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Keyword $model)
    {
        return $model->where("heading_id",request('heading_id'))->latest()->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        $jsScript = "data.heading = $('#heading').val();";

        return $this->builder()
                    ->setTableId('keyword-table')
                    ->columns($this->getColumns())
                    // ->minifiedAjax()
                    ->minifiedAjax('', $jsScript)
                    ->dom('Bfrtip')
                    ->orders([]);
                    // ->buttons(
                    //     Button::make('create'),
                    //     Button::make('export'),
                    //     Button::make('print'),
                    //     Button::make('reset'),
                    //     Button::make('reload')
                    // );
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
        return 'Keyword_' . date('YmdHis');
    }
}
