<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests\CreateRequest;
// use App\Http\Requests\EditRequest;
// use App\Http\Requests\StoreShareRequest;
// use App\Http\Requests\UpdateShareRequest;
use App\Http\Requests\ViewRequest;
use App\Models\Share;
use App\Models\Island;
use App\Models\StockItem;
use App\Models\Asset;
use App\Models\StockTake;
use App\Models\FishCenter;
use App\Pdd\Services\ShareService;
use App\Pdd\Services\FishCenterService;
use App\Pdd\Services\AssetService;
use App\Pdd\Services\StatusService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Yajra\DataTables\Facades\DataTables;

class StockTakeController extends Controller
{
    private const PREFIX_VIEW = 'pdd.stocktake.';
    private const PREFIX_ROUTE = 'stocktake.';


    protected $shareService;
    protected $fishCenterService;
    protected $assetService;
    protected $statusService;

    public function __construct(
      
        AssetService $assetService,
        shareService $shareService,
          FishCenterService $fishCenterService,
          StatusService $statusService
          )
    {
        $this->shareService = $shareService;
   
        $this->fishCenterService = $fishCenterService;
        $this->assetService = $assetService;
        $this->statusService = $statusService;
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocktaking['items'] = DB::table("islands")
        ->leftJoin("fish_centers", function($join){
            $join->on("islands.id", "=", "fish_centers.island_id");
        })
        ->leftJoin("stock_takes", function($join){
            $join->on("fish_centers.id", "=", "stock_takes.fishcenter_id");
        })
        ->leftJoin("share_stock_takes", function($join){
            $join->on("stock_takes.id", "=", "share_stock_takes.stock_take_id");
        })
        ->leftJoin("assets", function($join){
            $join->on("share_stock_takes.asset_id", "=", "assets.id");
        })
        ->leftJoin("shares", function($join){
            $join->on("assets.id", "=", "shares.asset_id");
        })

        ->select("fish_centers.name", "stock_takes.stock_take_date", "assets.name", "shares.allocated_quantity", "share_stock_takes.quantity as onhand","share_stock_takes.defects", "islands.name as island")->selectraw('shares.allocated_quantity - share_stock_takes.quantity as Missing ')
        ->get();

        return view('pdd.stocktake.index', $stocktaking);
    }

    public function indexoffishcenter(ViewRequest $request)
    {
        // dd($this->service->paginate());
        return view(static::PREFIX_VIEW . 'fishcenter.index')
        ->withFishcenters($this->fishCenterService->paginate());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $fishcenter_id)
    {
        // dd($fishcenter_id);
           $assets   = DB::table('islands')
           ->select('fish_centers.id', 'fish_centers.name', 'shares.allocated_quantity', 'assets.name')
           ->leftJoin('fish_centers','islands.id','=','fish_centers.island_id')
           ->leftJoin('shares','fish_centers.id','=','shares.fish_center_id')
           ->leftJoin('assets','assets.id','=','shares.asset_id')
           ->where('fish_center_id','=',$fishcenter_id)
           ->get();

            // dd($this->fishCenterService->get());
     
        return view(static::PREFIX_VIEW . 'create')
            ->withItem(new StockTake())
            ->withShares($this->shareService->get())
            ->withAssets($assets)
            ->withStatus($this->statusService->get())
            ->withFishCenters($this->fishCenterService->get())
            ->withIslands(new Island());
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stocktake = new StockTake();
        $stocktake->fishcenter_id = $request->input('fishcenter_id');
        $stocktake->stock_take_date = $request->input('stock_take_date');
        $stocktake->comments = $request->input('comments');
        $stocktake->save();

        $stocktakeId =     $stocktake->id; //StockTake::find($request->input('fishcenter_id'));

        // dd($request->all());
        $items = [];
        
        $quantity  = $request->input('quantity', []);
      
        $asset_id = $request->input('asset_id', []);
        // $status_id = $request->input('status_id', []);
        $defects = $request->input('defects', []);
        // dd( $status_id);
     
        
        // Instantiate each asset object
        foreach ($quantity as $key => $qty) {
            // dd($qty);
            $items[] = new StockItem([
                'asset_id' => $asset_id[$key],
                'stock_take_id' =>  $stocktakeId,
                // 'status_id' =>  $status_id[$key],
                'defects' =>  $defects[$key],
                'quantity' => $qty
            ]);

            // dd($items);
        }
//        $d = $stocktake->stockitems();
//  dd($d);
        $stocktake->stockitems()->saveMany($items);


        return redirect()->route(static::PREFIX_ROUTE . 'index')
            ->withFlashSuccess(__('was successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
