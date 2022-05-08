<?php

namespace App\DataTables;
use App\Traits\DataTableTrait;

use App\Models\ProviderPayout;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PayoutHistoryDataTable extends DataTable
{
    use DataTableTrait;
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
            ->editColumn('method', function($payout) {
                return !empty($payout->method) ? $payout->method : 'Cash';
            })
            ->editColumn('description', function($payout) {
                return !empty($payout->description) ? $payout->description : '-';
            })
            ->editColumn('provider_id', function($payout) {
                return ($payout->providers != null && isset($payout->providers)) ? $payout->providers->display_name : '-';
            })
            ->editColumn('amount', function($payout) {
                return ($payout->amount != null && isset($payout->amount)) ? getPriceFormat($payout->amount) : '-';
            })
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProviderPayout $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProviderPayout $model)
    {
        return $model->newQuery()->myPayout();
    }
    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')
                ->searchable(false)
                ->title(__('messages.no'))
                ->orderable(false),
            Column::make('provider_id')
                    ->title(__('messages.provider')),
            Column::make('method') ->title(__('messages.method')),
            Column::make('description')
                ->title(__('messages.description')),
            Column::make('amount')->title(__('messages.amount'))
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Category_' . date('YmdHis');
    }
}
