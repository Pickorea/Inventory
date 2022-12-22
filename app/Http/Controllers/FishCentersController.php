<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\EditRequest;
use App\Http\Requests\StoreFishCenterRequest;
use App\Http\Requests\UpdateFishCenterRequest;
use App\Http\Requests\ViewRequest;
use App\Models\FishCenter;
use App\Pdd\Services\FishCenterService;
use App\Pdd\Services\IslandService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Yajra\DataTables\Facades\DataTables;

class FishCentersController extends Controller
{
    private const PREFIX_VIEW = 'pdd.fcenter.';
    private const PREFIX_ROUTE = 'fcenter.';
    // private const TYPE = FishCenter::TYPE;

    /**
     * @var FishCenterService
     */
    protected $service;
    protected $islandService;

    /**
    * SpeciesController constructor.
    * @param FishCenterService $service
    */
    public function __construct(FishCenterService $service, IslandService $islandService)
    {
        $this->service = $service;
        $this->islandService = $islandService;
    }

    /**
     * @param ViewRequest $request
     * @return \Illuminate\View\View
     */
    public function index(ViewRequest $request)
    {
        return view(static::PREFIX_VIEW . 'index')
        ->withItems($this->service->paginate());
    }

    /**
     * @param CreateRequest $request
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        // dd($request->all());
        return view(static::PREFIX_VIEW . 'create')
            ->withItem(new FishCenter())->withIslands($this->islandService->get());
    }

    /**
     * @param StoreFishCenterRequest $request
     * @return mixed
     */
    public function store(StoreFishCenterRequest $request)
    {
         // dd($request->all());
        $item = $this->service->store($request->validated());

        return redirect()->route('fishcenter.index', $item)
            ->withFlashSuccess(__('was successfully created.'));
    }

    /**
     * @param ViewRequest $request
     * @param FishCenter $FishCenter
     * @return mixed
     */
    public function show(ViewRequest $request, $fishCenter)
    {
        $fishCer = DB::table('fish_centers')
        ->select('fish_centers.name as fishCenterName', 'assets.name as assetName', 'shares.allocated_quantity')
        ->leftJoin('shares','fish_centers.id','=','shares.fish_center_id')
        ->leftJoin('assets','assets.id','=','shares.asset_id')
        ->where('fish_centers.name','=',$fishCenter)
        ->get();
            // dd($fishCer);
        return view(static::PREFIX_VIEW . 'show')
            ->withItem($fishCer);
    }

    /**
     * @param EditRequest $request
     * @param FishCenter $kiFishCenter
     * @return mixed
     */
    public function edit(EditRequest $request, FishCenter $fishCenter)
    {
        return view(static::PREFIX_VIEW . 'edit')
            ->withItem($fishCenter);
    }

    /**
     * @param UpdateFishCenterRequest $request
     * @param FishCenter $FishCenter
     * @return mixed
     */
    public function update(UpdateFishCenterRequest $request, FishCenter $fishCenter)
    {
        $this->service->update($fishCenter, $request->validated());

        return redirect()->route(static::PREFIX_ROUTE . 'show', $fishCenter)
            ->withFlashSuccess(__('T was successfully updated.'));
    }

    /**
     * @param EditRequest $request
     * @param FishCenter $FishCenter
     * @return mixed
     */
    public function destroy(EditRequest $request, FishCenter $fishCenter)
    {
        $this->service->delete($fishCenter);

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
        $filename = "FishCenters-".Carbon::now()->toDateString().".xlsx";

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
