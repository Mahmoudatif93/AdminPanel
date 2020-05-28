<?php

namespace App\DataTables;

use App\Model\Manufacturers;
use Yajra\DataTables\Services\DataTable;

class ManuFactskDatatable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		return datatables($query)
			->addColumn('checkbox', 'admin.manufacturers.btn.checkbox')
			->addColumn('edit', 'admin.manufacturers.btn.edit')
			->addColumn('delete', 'admin.manufacturers.btn.delete')
			->addColumn('icon', 'admin.manufacturers.btn.icon')
			->rawColumns([
				'edit',
				'delete',
				'checkbox',
				'icon',
			]);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\User $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query() {
		return Manufacturers::query();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
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
                    ['extend' => 'print', 'exportOptions'=>['columns'=>':visible'] , 'className' => 'btn btn-primary ', 'text' => '<i class="fa fa-print" style="font-size:18px;color:blue"></i>'],
                    ['extend' => 'colvis' ,'text' =>'<i class="fa fa-eye-slash" style="font-size:18px;color:red"></i>'.__('admin.colvis'),'className' => 'btn btn-default '],
                    ['extend' => 'pageLength' ,'className' => 'btn btn-default '],

                    ['extend' => 'csv', 'exportOptions'=>['columns'=>':visible'] ,'className' => 'btn btn-primary ', 'text' => '<i class="fa fa-file" style="font-size:18px;color:#cc5200"></i> ' . trans('admin.ex_csv')],
                    ['extend' => 'excel','exportOptions'=>['columns'=>':visible'] , 'className' => 'btn btn-primary ', 'text' => '<i class="fa fa-file-excel-o" style="font-size:18px;color:green"></i> ' . trans('admin.ex_excel')],
                    ['extend' => 'copy', 'exportOptions'=>['columns'=>':visible'] ,'className' => 'btn btn-primary ' , 'text' => '<i class="fa fa-copy" style="font-size:18px;color:blue"></i> ' . trans('admin.ex_copy')],
                    ['extend' => 'pdf','exportOptions'=>['columns'=>':visible'] , 'className' => 'btn btn-primary  ' , 'text' => '<i class="fa fa-file-pdf-o" style="font-size:18px;color:red"></i> ' . trans('admin.ex_pdf')],
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

				'language' => datatable_lang(),

			]);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns() {
		return [
			[
				'name'       => 'checkbox',
				'data'       => 'checkbox',
				'title'      => '<input type="checkbox" class="check_all" onclick="check_all()" />',
				'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
				'searchable' => false,
			], [
				'name'  => 'id',
				'data'  => 'id',
				'title' => '#',
			], [
				'name'  => 'name_ar',
				'data'  => 'name_ar',
				'title' => trans('admin.name_ar'),
			], [
				'name'  => 'name_en',
				'data'  => 'name_en',
				'title' => trans('admin.name_en'),
			], [
				'name'  => 'mobile',
				'data'  => 'mobile',
				'title' => trans('admin.mobile'),
			], [
				'name'  => 'contact_name',
				'data'  => 'contact_name',
				'title' => trans('admin.contact_name'),
			], [
				'name'  => 'icon',
				'data'  => 'icon',
				'title' => trans('admin.manufacturers_icon'),
			],
			 [
				'name'  => 'created_at',
				'data'  => 'created_at',
				'title' => trans('admin.created_at'),
			], [
				'name'  => 'updated_at',
				'data'  => 'updated_at',
				'title' => trans('admin.updated_at'),
			], [
				'name'       => 'edit',
				'data'       => 'edit',
				'title'      => trans('admin.edit'),
				'exportable' => false,
				'orderable'  => false,
				'searchable' => false,
				'printable'  => false,
			], [
				'name'       => 'delete',
				'data'       => 'delete',
				'title'      => trans('admin.delete'),
				'exportable' => false,
				'orderable'  => false,
				'searchable' => false,
				'printable'  => false,
			],

		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'manufacturers_'.date('YmdHis');
	}
}
