<?php

namespace App\Pdd\Services;

use App\Models\Asset;
use App\Models\Donor;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use DB;
/**
 * Class AssetService.
 */
class AssetService extends BaseService
{
    /**
     * AssetService constructor.
     *
     * @param  Asset  $Asset
     */
    public function __construct(Asset $asset, Donor $donor)
    {
        $this->model = $asset;
        $this->model1 = $donor;
    }

    public function searchPaginate($search = null)
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.view')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        $query = $this->model->query();
        if (! empty($search)) {
            $search = '%';
            $query->where('name', 'like', $search);
        }

        return $query->paginate();
    }


    public function datatables($search = '')
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.view')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }
        $query = $this->model->query();

        if (! empty($search)) {
            $query->whereLike(['name'], $search);
        }

        return $query;
    }

    public function store(array $data = []): Asset
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.create')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return  $this->model::create($data);
    }

    /**
     * @param Asset $item
     * @param array $data
     * @return bool
     */
    public function update(Asset $item, array $data = []): bool
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.edit')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return $item->update($data);
    }

    public function asset($id){

       return $query =  DB::table('assets')
       ->select('assets.name', 'assets.id', 'assets.quantity', 'assets.unit_price')
       ->Join('donors','donors.id','=','assets.donor_id')->where('assets.donor_id',$id)    
       ->get();


    }
}
