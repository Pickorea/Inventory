<?php

namespace App\Services\Reports\Implementations;
use App\Models\Donor;
use App\Models\Asset;
use DB;
use DateTime;
use Carbon\Carbon;
use App\Services\Reports\Interfaces\INAssetDonatedReportServices;

class IMAssetDonatedReportServices implements INAssetDonatedReportServices
{
    
    
    public function getAssetDonatedList()
    {
        
        return $assets =  DB::table('donors')
        ->select('donors.name', 'assets.name', 'assets.quantity', 'assets.unit_price')
        ->leftJoin('assets','donors.id','=','assets.donor_id')
      
        ->get();

    
    }

}