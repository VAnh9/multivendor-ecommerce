<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductDataTable extends DataTable
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
              $editBtn = "<a href='".route('vendor.products.edit', $query->id)."' class='btn btn-primary'><i class='far fa-edit'></i></a>";
              $deleteBtn = "<a href='".route('vendor.products.destroy', $query->id)."' class='btn btn-danger ms-2 me-2 delete-item'><i class='far fa-trash-alt'></i></a>";
              $moreBtn = '<div class="btn-group dropstart">
                            <button type="button" class="btn btn-secondary rounded" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fas fa-cog"></i>
                            </button>
                            <ul class="dropdown-menu">
                              <li>
                                <a class="dropdown-item" href="'.route('admin.product-image-gallery.index', ['product' => $query->id]).'"><i class="far fa-heart"></i> Image Gallery</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="'.route('admin.product-variant.index', ['product' => $query->id]).'"><i class="far fa-file"></i> Variants</a>
                              </li>
                            </ul>
                          </div>';
              return $editBtn.$deleteBtn.$moreBtn;
            })
            ->addColumn('image', function($query) {
              return '<img width="70px" src="'.asset($query->thumb_image).'"/>';
            })
            ->addColumn('type', function($query) {
              switch ($query->product_type) {
                case 'new_arrival':
                  return '<i class="badge rounded-pill bg-success">New Arrival</i>';
                  break;

                case 'featured_product':
                  return '<i class="badge rounded-pill bg-warning">Featured Product</i>';
                  break;

                case 'top_product':
                  return '<i class="badge rounded-pill bg-info">Top Product</i>';
                  break;

                case 'best_product':
                  return '<i class="badge rounded-pill bg-danger">Best Product</i>';
                  break;

                default:
                return '<i class="badge rounded-pill bg-dark">None</i>';
                  break;
              }
            })
            ->addColumn('status', function($query) {
              if($query->status == 1) {
                $button = '<div class="form-check form-switch">
                              <input class="form-check-input change-status" checked data-id="'.$query->id.'" type="checkbox" id="flexSwitchCheckDefault">
                            </div>';
              } else {
                $button = '<div class="form-check form-switch">
                            <input class="form-check-input change-status" data-id="'.$query->id.'" type="checkbox" id="flexSwitchCheckDefault">
                          </div>';
              }
              return $button;
            })
            ->rawColumns(['image', 'type', 'status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproduct-table')
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
          Column::make('id')->hidden(),
          Column::make('image')->width(250),
          Column::make('name'),
          Column::make('price'),
          Column::make('type')->width(200),
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
        return 'VendorProduct_' . date('YmdHis');
    }
}
