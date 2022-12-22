<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\EditRequest;
use App\Http\Requests\StoreIslandRequest;
use App\Http\Requests\UpdateIslandRequest;
use App\Http\Requests\ViewRequest;
use App\Models\Island;
use App\Models\FishCenter;
use App\Pdd\Services\IslandService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class IslandController extends Controller
{
    private const PREFIX_VIEW = 'pdd.island.';
    private const PREFIX_ROUTE = 'island.';
    // private const TYPE = Island::TYPE;

    /**
     * @var IslandService
     */
    protected $service;

    /**
    * SpeciesController constructor.
    * @param IslandService $service
    */
    public function __construct(IslandService $service)
    {
        $this->service = $service;
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
            ->withItem(new Island());
    }

    /**
     * @param StoreIslandRequest $request
     * @return mixed
     */
    public function store(StoreIslandRequest $request)
    {
         // dd($request->all());
        $item = $this->service->store($request->validated());

        return redirect()->route(static::PREFIX_ROUTE . 'show', $item)
            ->withFlashSuccess(__('was successfully created.'));
    }

    /**
     * @param ViewRequest $request
     * @param Island $kiisland
     * @return mixed
     */
    public function show(ViewRequest $request, Island $kiisland, FishCenter $fishcenter)
    {
        $data['island'] = Island::with('fishcenters','shares')->where('fishcenters.island_id', $kiisland);
        // dd($data['island']);

        $data['share'] = Island::with('fishcenters')->get();



        return view(static::PREFIX_VIEW . 'show')
            ->withItem($kiisland);
    }

    /**
     * @param EditRequest $request
     * @param Island $kiisland
     * @return mixed
     */
    public function edit(EditRequest $request, Island $kiisland)
    {
        $island = $kiisland->islandsThroughStockTake()->get();
        return view(static::PREFIX_VIEW . 'edit')
            ->withItem($island);
    }

    /**
     * @param UpdateIslandRequest $request
     * @param Island $kiisland
     * @return mixed
     */
    public function update(UpdateIslandRequest $request, Island $kiisland)
    {
        $this->service->update($kiisland, $request->validated());

        return redirect()->route(static::PREFIX_ROUTE . 'show', $kiisland)
            ->withFlashSuccess(__('T was successfully updated.'));
    }

    /**
     * @param EditRequest $request
     * @param Island $kiisland
     * @return mixed
     */
    public function destroy(EditRequest $request, Island $kiisland)
    {
        $this->service->delete($kiisland);

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
