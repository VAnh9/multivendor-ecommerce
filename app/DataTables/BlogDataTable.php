<?php

namespace App\DataTables;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BlogDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query) {
              $editBtn = "<a href='".route('admin.blog.edit', $query->id)."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
              $deleteBtn = "<a href='".route('admin.blog.destroy', $query->id)."' data-tableId='blog-table' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
              return $editBtn.$deleteBtn;
            })
            ->addColumn('image', function($query) {
              return "<img width='100px' src='".asset($query->thumb_image)."'/>";
            })
            ->addColumn('category', function($query) {
              return $query->blogCategory->name;
            })
            ->addColumn('publish_date', function($query) {
              return date('d M Y', strtotime($query->created_at));
            })
            ->addColumn('status', function($query) {
              if($query->status == 1) {
                $button = ' <label class="custom-switch mt-2">
                              <input type="checkbox" data-id="'.$query->id.'" checked name="custom-switch-checkbox" class="custom-switch-input change-status">
                              <span class="custom-switch-indicator"></span>
                            </label>';
              } else {
                $button = ' <label class="custom-switch mt-2">
                              <input type="checkbox" data-id="'.$query->id.'" name="custom-switch-checkbox" class="custom-switch-input change-status">
                              <span class="custom-switch-indicator"></span>
                            </label>';
              }
              return $button;
            })
            ->rawColumns(['image', 'status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Blog $model): QueryBuilder
    {
        return $model::with('blogCategory')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('blog-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('image'),
            Column::make('title'),
            Column::make('category'),
            Column::make('publish_date'),
            Column::make('status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(200)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Blog_' . date('YmdHis');
    }
}
