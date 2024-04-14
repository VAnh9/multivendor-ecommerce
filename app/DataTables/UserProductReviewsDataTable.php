<?php

namespace App\DataTables;

use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserProductReviewsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('image', function($query) {
              $showBtn = "<a href='".route('user.review.image-gallery', $query->id)."' class='btn btn-primary'><i class='fas fa-images'></i></a>";

              return $showBtn;
            })
            ->addColumn('product', function($query) {
              return "<a target='_blank' href='".route('product-detail', $query->product->slug)."'>".$query->product->name."</a>";
            })
            ->addColumn('user', function($query) {
              return $query->user->name;
            })
            ->addColumn('rating', function($query) {
              switch ($query->rating) {
                case '1':
                  return '<i class="fas fa-star" style="color:gold;"></i>';
                  break;
                case '2':
                  return '<i class="fas fa-star" style="color:gold;"></i>
                          <i class="fas fa-star" style="color:gold;"></i>';
                  break;
                case '3':
                  return '<i class="fas fa-star" style="color:gold;"></i>
                          <i class="fas fa-star" style="color:gold;"></i>
                          <i class="fas fa-star" style="color:gold;"></i>';
                  break;
                case '4':
                  return '<i class="fas fa-star" style="color:gold;"></i>
                          <i class="fas fa-star" style="color:gold;"></i>
                          <i class="fas fa-star" style="color:gold;"></i>
                          <i class="fas fa-star" style="color:gold;"></i>';
                  break;
                case '5':
                  return '<i class="fas fa-star" style="color:gold;"></i>
                          <i class="fas fa-star" style="color:gold;"></i>
                          <i class="fas fa-star" style="color:gold;"></i>
                          <i class="fas fa-star" style="color:gold;"></i>
                          <i class="fas fa-star" style="color:gold;"></i>
                          <i class="fas fa-star" style="color:gold;"></i>';
                  break;
                default:
                  # code...
                  break;
              }
            })
            ->addIndexColumn()
            ->rawColumns(['product', 'rating', 'image'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductReview $model): QueryBuilder
    {
        return $model->where('user_id', Auth::user()->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('userproductreviews-table')
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
            Column::make('DT_RowIndex')->width(100)->title('#')->name('id'),
            Column::make('product'),
            Column::make('user'),
            Column::make('rating'),
            Column::make('review'),
            Column::make('image'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'UserProductReviews_' . date('YmdHis');
    }
}
