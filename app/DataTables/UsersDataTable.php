<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class UsersDatatable  extends DataTable
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
            ->addColumn('checkbox', 'admin.users.btn.checkbox')
            ->addColumn('edit', 'admin.users.btn.edit')
            ->addColumn('delete', 'admin.users.btn.delete')
            ->addColumn('level', 'admin.users.btn.level')
            
            ->rawColumns([
                'edit',
                'delete',
                'level',
                'checkbox',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return User::query()->where(function ($q) {
            if (request()->has('level'))
                return $q->where('level',request('level'));
        });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters([
                'dom'        => 'Bfrtip',
                'destroy'=> true,
                'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50,100, trans('admin.all_record')]],
                'buttons'      => [

                    [
                        'text'      => '<i class="fa fa-plus" style="font-size:18px;color:green"></i> ' . trans('admin.add'),
                        'className' => 'btn btn-info ',
                        'action'    => 'function(){
                            window.location.href = "' . \URL::current() . '/create";
                        }'

                    ],
                   
                    ['extend' => 'print' , 'title'=> '<p class="text-center">'.__('admin.users').'</p>' , 'exportOptions'=>['columns'=>':visible'] , 'className' => 'btn btn-primary ', 'text' => '<i class="fa fa-print" style="font-size:18px;color:blue"></i>'],
                    ['extend' => 'colvis','postfixButtons'=>['colvisRestore'] ,'text' =>'<i class="fa fa-eye-slash" style="font-size:18px;color:red"></i>'.__('admin.colvis'),'className' => 'btn btn-default '],
                    //['extend' => 'colvisRestore','text' =>'<i class="fa fa-eye" style="font-size:18px;color:green"></i>'.__('admin.colvisRestore'),'className' => 'btn btn-default '],
                    ['extend' => 'pageLength' ,'className' => 'btn btn-default '],
                    ['extend' => 'collection',  'className' => 'btn btn-primary ', 'text' => '<i class="fa fa-chevron-circle-down" style="font-size:18px;color:blue"></i> Export','buttons'=>[
                        ['extend' => 'csv', 'exportOptions'=>['columns'=>':visible'] ,'className' => 'btn btn-primary ', 'text' => '<i class="fa fa-file" style="font-size:18px;color:#cc5200"></i> ' . trans('admin.ex_csv')],
                        ['extend' => 'excel','exportOptions'=>['columns'=>':visible'] , 'className' => 'btn btn-primary ', 'text' => '<i class="fa fa-file-excel-o" style="font-size:18px;color:green"></i> ' . trans('admin.ex_excel')],
                        ['extend' => 'copy', 'exportOptions'=>['columns'=>':visible'] ,'className' => 'btn btn-primary ' , 'text' => '<i class="fa fa-copy" style="font-size:18px;color:blue"></i> ' . trans('admin.ex_copy')],
                        ['extend' => 'pdf','exportOptions'=>['columns'=>':visible'] , 'className' => 'btn btn-primary  ' , 'text' => '<i class="fa fa-file-pdf-o" style="font-size:18px;color:red"></i> ' . trans('admin.ex_pdf')],
                    ]],
                    
                    //['extend' => 'reload', 'className' => 'btn btn-default bu'],
                    [
                        'text'      => '<i class="fa fa-trash" style="font-size:18px;color:red"></i> ' . trans('admin.delete'),
                        'className' => 'btn btn-danger delBtn'

                    ],

                ],
                'initComplete' => " function () {
		            this.api().columns([2,3]).every(function () {
		                var column = this;
		                var input = document.createElement(\"input\");
		                $(input).appendTo($(column.footer()).empty())
		                .on('keyup', function () {
		                    column.search($(this).val(), false, false, true).draw();
		                });
		            });
                }",
                'language'         => datatable_lang(),

            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name'       => 'checkbox',
                'data'       => 'checkbox',
                'title'      =>'<div class="checkbox"><label><input type="checkbox" class="check_all" onclick="check_all()"/><span class="cr"><i class="cr-icon glyphicon glyphicon-remove"></i></span></label></div>',
                //'title'      => '<input type="checkbox" class="check_all" onclick="check_all()"/>',
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ], [
                'name'  => 'id',
                'data'  => 'id',
                'title' => 'ID',
            ], [
                'name'  => 'name',
                'data'  => 'name',
                'title' => trans('admin.name'),
            ], [
                'name'  => 'email',
                'data'  => 'email',
                'title' => trans('admin.email'),
            ], [
                'name'  => 'level',
                'data'  => 'level',
                'title' => trans('admin.level'),
            ], [
                'name'  => 'created_at',
                'data'  => 'created_at',
                'title' => 'created at',
            ], [
                'name'  => 'updated_at',
                'data'  => 'updated_at',
                'title' => 'updated at',
            ], [
                'name'       => 'edit',
                'data'       => 'edit',
                'title'      => 'Edit',
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ], [
                'name'       => 'delete',
                'data'       => 'delete',
                'title'      => 'Delete',
                'exportable' => false,
                'autoPrint'  => false,
                'orderable'  => false,
                'searchable' => false,
            ],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
