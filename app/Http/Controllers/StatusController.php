<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\EditRequest;
use App\Http\Requests\StoreIslandRequest;
use App\Http\Requests\UpdateIslandRequest;
use App\Http\Requests\ViewRequest;
use App\Models\Status;
use App\Pdd\Services\StatusService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class StatusController extends Controller
{
    private const PREFIX_VIEW = 'pdd.status.';
    private const PREFIX_ROUTE = 'status.';
    // private const TYPE = Island::TYPE;

    /**
     * @var IslandService
     */
    protected $statusService;

    /**
    * SpeciesController constructor.
    * @param StatusService $service
    */
    public function __construct(StatusService $statusService)
    {
        $this->statusService = $statusService;
    }

    /**
     * @param ViewRequest $request
     * @return \Illuminate\View\View
     */
    public function index(ViewRequest $request)
    {
        return view(static::PREFIX_VIEW . 'index')
        ->withItems($this->statusService->paginate());
    }

    /**
     * @param CreateRequest $request
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        // dd($request->all());
        return view(static::PREFIX_VIEW . 'create')
            ->withItem(new Status());
    }

    /**
     * @param StoreIslandRequest $request
     * @return mixed
     */
    public function store(StoreIslandRequest $request)
    {
         // dd($request->all());
        $item = $this->statusService->store($request->validated());

        return redirect()->route(static::PREFIX_ROUTE . 'show', $item)
            ->withFlashSuccess(__('was successfully created.'));
    }

    /**
     * @param ViewRequest $request
     * @param Island $kiisland
     * @return mixed
     */
    public function show(ViewRequest $request, Status $status)
    {
        return view(static::PREFIX_VIEW . 'show')
            ->withItem($status);
    }

    /**
     * @param EditRequest $request
     * @param Island $kiisland
     * @return mixed
     */
    public function edit(EditRequest $request, Status $status)
    {
        return view(static::PREFIX_VIEW . 'edit')
            ->withItem($status);
    }

    /**
     * @param UpdateIslandRequest $request
     * @param Island $kiisland
     * @return mixed
     */
    public function update(UpdateIslandRequest $request, Status $status)
    {
        $this->service->update($status, $request->validated());

        return redirect()->route(static::PREFIX_ROUTE . 'show', $status)
            ->withFlashSuccess(__('T was successfully updated.'));
    }

    /**
     * @param EditRequest $request
     * @param Island $kiisland
     * @return mixed
     */
    public function destroy(EditRequest $request, Status $status)
    {
        $this->service->delete($status);

        return redirect()->route(static::PREFIX_ROUTE . 'index')
            ->withFlashSuccess(__(' was successfully deleted.'));
    }

    public function datatables(ViewRequest $request)
    {
        $search = $request->get('search', '');

        if (is_array($search)) {
            $search = $search['value'];
        }
        $query = $this->service->datatables($search);

        $datatables = DataTables::make($query)
            ->editColumn('created_at', function ($row) {
                return $row->created_at ? with(new Carbon($row->created_at))->format('Y-m-d') : '';
            })
            ->make(true);

        return $datatables;
    }

    /**
     * @param ViewRequest $request
     * @return string
     */
    public function exportlist(ViewRequest $request)
    {
        $order_by = 'name';
        $sort = 'asc' ;
        $search = $request->get('search', '') ;
        if (is_array($search)) {
            $search = $search['value'];
        }
        $query = $this->service->datatables($search, $order_by, $sort, $request->get('trashed'), $request->get('active'));
        $query->select(['id','name','created_at'])->limit(5000);

        $header = ['ID', 'Name', 'Created'];
        $filename = "Islands-".Carbon::now()->toDateString().".xlsx";

        /**
         * Option A do as a query export
         */
        //$export = new QueryExport($query, $header);

        /**
         * Option B do as an array.
         */
        $items = $query->get();
        // Convert each member of the returned collection into an array,
        $data = [];
        foreach ($items as $item) {
            $data[] = [ $item->id, $item->name, optional($item->created_at)->format('y-m-d') ];
        }
        // Generate and return the spreadsheet
        $export = new ArrayExport($data, $header);

        return $export->download($filename);
    }
}
