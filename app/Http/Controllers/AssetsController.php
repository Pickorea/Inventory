<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\EditRequest;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Http\Requests\ViewRequest;
use App\Models\Asset;
use App\Models\Donor;
use App\Pdd\Services\AssetService;
use App\Pdd\Services\DonorService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use DB;
class AssetsController extends Controller
{
    private const PREFIX_VIEW = 'pdd.asset.';
    private const PREFIX_ROUTE = 'asset.';
    // private const TYPE = Asset::TYPE;

    /**
     * @var AssetService
     */
    protected $service;
    protected $donorService;

    /**
    * SpeciesController constructor.
    * @param AssetService $service
    */
    public function __construct(AssetService $service, DonorService $donorService)
    {
        $this->service = $service;
        $this->donorService = $donorService;
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
        // $request->all();
        return view(static::PREFIX_VIEW . 'create')
->withDonors($this->donorService->get());
    }

    /**
     * @param StoreAssetRequest $request
     * @return mixed
     */
    public function store(Request $request)
    {
        // $data[] = [
              
        //     'name'=> $request->input('name',[]),
        //     'quantity'=> $request->input('quantity',[]),
        //     'unit_price'=> $request->input('unit_price',[]),
         
        //  ];

        // $data[] = [
              
        //     'name'=> $request->name[0],
        //     'quantity'=> $request->quantity[0],
        //     'unit_price'=> $request->unit_price[0],
         
        //  ];

        // $data[] = [
              
        //     'name'=> $request->serialize($request->name),
        //     'quantity'=> $request->serialize($request->quantity),
        //     'unit_price'=> $request->serialize($request->unit_price),
         
        //  ];
        
        // $data[] = [
              
        //     'name'=> $request->input('name'),
        //     'quantity'=> $request->input('quantity'),
        //     'unit_price'=> $request->input('unit_price'),
         
        //  ];
          
$donor = Donor::find($request->input('donor_id'));

// dd($donor);
$assets = [];

$quantity  = $request->input('quantity', []);
$name = $request->input('name', []);
$unitprice = $request->input('unit_price', []);

// Instantiate each asset object
foreach ($quantity as $key => $qty) {
    $assets[] = new Asset([
        'unit_price' => $unitprice[$key],
        'name' => $name[$key],
        'quantity' => $qty
    ]);

    // dd($assets);
}

// Save the assets in the donor
$donor->assets()->saveMany($assets);


        return redirect()->route(static::PREFIX_ROUTE . 'index')
            ->withFlashSuccess(__('was successfully created.'));
    }

    /**
     * @param ViewRequest $request
     * @param Asset $Asset
     * @return mixed
     */
    public function show(ViewRequest $request, Asset $asset)
    {
        return view(static::PREFIX_VIEW . 'show')
            ->withItem($asset);
    }

    /**
     * @param EditRequest $request
     * @param Asset $kiAsset
     * @return mixed
     */
    public function edit(EditRequest $request, Asset $asset)
    {
        return view(static::PREFIX_VIEW . 'edit')
            ->withItem($asset);
    }

    /**
     * @param UpdateAssetRequest $request
     * @param Asset $Asset
     * @return mixed
     */
    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $this->service->update($Asset, $request->validated());

        return redirect()->route(static::PREFIX_ROUTE . 'show', $asset)
            ->withFlashSuccess(__('T was successfully updated.'));
    }

    /**
     * @param EditRequest $request
     * @param Asset $Asset
     * @return mixed
     */
    public function destroy(EditRequest $request, Asset $asset)
    {
        $this->service->delete($asset);

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
        $filename = "Assets-".Carbon::now()->toDateString().".xlsx";

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
