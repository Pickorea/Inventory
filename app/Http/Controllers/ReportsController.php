<?php

namespace App\Http\Controllers;
use PDF;
use App\Services\Reports\Implementations\IMAssetDonatedReportServices;
use App\Models\Donor;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
     protected $assetDonoatedtReportService;
    
    public function __construct(
        IMAssetDonatedReportServices $assetDonoatedtReportService,
       

        )
    {
        $this->assetDonoatedtReportService = $assetDonoatedtReportService;
      
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function IndexOfAssetDonated()
    {
         $items = $this->assetDonoatedtReportService->getAssetDonatedList();
// dd($items);
         return view('pdd.reports.asset_donated_report',compact('items'));
    }


    public function AssetDonatedReportPdf($id){

        $d = Donor::select('name','description')->find($id);
        $items = DB::table('donors')
             ->select('donors.name', 'assets.name', 'assets.quantity', 'assets.unit_price')
             ->leftJoin('assets','donors.id','=','assets.donor_id')
             ->where('donors.id','=', $id)
             ->get();

        $pdf= PDF::loadView('pdd.reports.donations.asset_donated_reportpdf',['items' => $items, 'd' => $d])->setOptions(['defaultFont' => 'sans-serif']);;
        
        return $pdf->stream($d->name. " &nbsp;" .'donations' . '.pdf');

    }

    public function SharesAssetReportPdf($id){

        // $d = Donor::select('name','description')->find($id);
        $items =  DB::table('shares')
        ->select('fish_centers.name as center', 'shares.id', 'assets.name as asset', 'asset_share.quantity','islands.name')
        
        ->leftJoin('asset_share','shares.id','=','asset_share.share_id')
        ->leftJoin('assets','asset_share.asset_id','=','assets.id')
        ->leftJoin('fish_centers','fish_centers.id','=','shares.fishcenter_id')
        ->leftJoin('islands','islands.id','=','fish_centers.island_id')
        ->where('share_id','=',$id)
        ->get()->toArray();
        // dd($items);
        $island =  DB::table('shares')
        ->select('fish_centers.name as center', 'shares.id', 'assets.name as asset', 'asset_share.quantity','islands.name')
        
        ->leftJoin('asset_share','shares.id','=','asset_share.share_id')
        ->leftJoin('assets','asset_share.asset_id','=','assets.id')
        ->leftJoin('fish_centers','fish_centers.id','=','shares.fishcenter_id')
        ->leftJoin('islands','islands.id','=','fish_centers.island_id')
        ->where('share_id','=',$id)
        ->first();
        $pdf= PDF::loadView('pdd.reports.shares.shares_asset_reportpdf',['items' => $items,'island' => $island])->setOptions(['defaultFont' => 'sans-serif']);;
        
        return $pdf->stream('shares.pdf');

    }

     
}
