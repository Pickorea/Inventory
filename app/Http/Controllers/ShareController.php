<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\EditRequest;
use App\Http\Requests\StoreShareRequest;
use App\Http\Requests\UpdateShareRequest;
use App\Http\Requests\ViewRequest;
use App\Models\Share;
use App\Models\Donor;
use App\Models\Asset;
use App\Models\AssetShare;
// use App\Models\DonorService;
use App\Models\FishCenter;
use App\Pdd\Services\ShareService;
use App\Pdd\Services\DonorService;
use App\Pdd\Services\AssetService;
use App\Pdd\Services\FishCenterService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Yajra\DataTables\Facades\DataTables;

class ShareController extends Controller
{
    private const PREFIX_VIEW = 'pdd.share.';
    private const PREFIX_ROUTE = 'share.';
    // private const TYPE = Share::TYPE;

    /**
     * @var ShareService
     */
    protected $service;
    protected $donorService;
    protected $assetService;
    protected $fishCenterService;

    /**
    * SpeciesController constructor.
    * @param ShareService $service
    */
    public function __construct(
        ShareService $service,
         AssetService $assetService,
          FishCenterService $fishCenterService,
          DonorService $donorService )
    {
        $this->service = $service;
        $this->assetService = $assetService;
        $this->fishCenterService = $fishCenterService;
        $this->donorService = $donorService;
    }

    /**
     * @param ViewRequest $request
     * @return \Illuminate\View\View
     */
    public function index(ViewRequest $request)
    {
        // dd($this->service->paginate());
        return view(static::PREFIX_VIEW . 'index')
        ->withItems($this->service->paginate());
    }

    public function indexofdonors(ViewRequest $request)
    {
        // dd($this->service->paginate());
        return view(static::PREFIX_VIEW . 'donor.index')
        ->withDonors($this->donorService->paginate());
    }

    /**
     * @param CreateRequest $request
     * @return mixed
     */
    public function create(Request $request, $donor_id)
    {
        //   $did = Donor::select('id')->find(1);
        //   $assets = $this->assetService->get();
        // $donor_id = $request->donor_id;
// dd($data);
        // dd($assets);
        return view(self::PREFIX_VIEW . 'create', compact('donor_id'))
            ->withItem(new Share())
            ->withAssets($this->assetService->asset($donor_id))
                ->withAssets($this->assetService->get())
            ->withFishCenters($this->fishCenterService->get())
            ->withDonors($this->donorService->get());
    }

    /**
     * @param StoreShareRequest $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $fishcenter = FishCenter::find($request->input('fish_center_id'));

        // dd($request->all());
        $assets = [];
        
        $allocated_quantity  = $request->input('allocated_quantity', []);
        // dd($allocated_quantity);
        $asset_id = $request->input('asset_id', []);
        $share_date = $request->input('share_date');
     
        
        // Instantiate each asset object
        foreach ($allocated_quantity as $key => $qty) {
            // dd($qty);
            $assets[] = new Share([
                'asset_id' => $asset_id[$key],
                'share_date' => $share_date,
                'allocated_quantity' => $qty
            ]);

            // dd( $assets);
        }
        
        // Save the assets in the fishcenter
        $fishcenter->shares()->saveMany($assets);
        
        
                return redirect()->route(static::PREFIX_ROUTE . 'index')
                    ->withFlashSuccess(__('was successfully created.'));
    }

    /**
     * @param ViewRequest $request
     * @param Share $kiShare
     * @return mixed  
     *  SELECT fish_centers.name, shares.fishcenter_id, shares.share_date, asset_share.quantity, assets.name
     * from fish_centers inner join shares on fish_centers.id = shares.fishcenter_id
     * INNER join asset_share on shares.id = asset_share.share_id INNER join assets on assets.id = asset_share.share_id where shares.id = 1
     */
   
    public function show(ViewRequest $request, $date)
    {
    //    $dd = $request->all();
    //    dd($date);
      
          $w = DB::table("assets")
          ->Join("shares", function($join){
              $join->on("assets.id", "=", "shares.asset_id");
          })
          ->Join("fish_centers", function($join){
              $join->on("shares.fish_center_id", "=", "fish_centers.id");
          })
          ->select("assets.name as asset", "shares.id","shares.allocated_quantity as allocated_quantity", "fish_centers.name as center", "shares.share_date")->groupBy('shares.id','center','allocated_quantity','asset','shares.share_date')->where('shares.share_date',$date)
        //   ->where("shares.id", "=", $id)
          ->get();

        //   dd($w);
             return view(static::PREFIX_VIEW . 'show')
            ->withItems($w);
    }

    /**
     * @param EditRequest $request
     * @param Share $kiShare
     * @return mixed
     */
    public function edit(EditRequest $request, Share $kiShare)
    {
        return view(static::PREFIX_VIEW . 'edit')
            ->withItem($kiShare);
    }

    /**
     * @param UpdateShareRequest $request
     * @param Share $kiShare
     * @return mixed
     */
    public function update(UpdateShareRequest $request, Share $kiShare)
    {
        // $this->service->update($kiShare, $request->validated());

        $shares = new Share();
        $shares->fishcenter_id = $request->input('fishcenter_id');
        $shares->save();

        $asset_id = $request->input('asset_id', []);
     
        $quantity = $request->input('quantity', []);
       

        for ($i=0; $i < count($asset_id); $i++) {
            if ($asset_id[$i] != '') {
                $shares->assets()->sync([$asset_id[$i]=> ['quantity' =>   $quantity[$i]]]);
            }
        }

        return redirect()->route(static::PREFIX_ROUTE . 'show', $kiShare)
            ->withFlashSuccess(__('T was successfully updated.'));
    }

    /**
     * @param EditRequest $request
     * @param Share $kiShare
     * @return mixed
     */
    public function destroy(EditRequest $request, Share $kiShare)
    {
        $this->service->delete($kiShare);

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
        $filename = "Shares-".Carbon::now()->toDateString().".xlsx";

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
