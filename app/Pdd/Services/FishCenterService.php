<?php

namespace App\Pdd\Services;

use App\Models\FishCenter;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use DB;
/**
 * Class FishCenterService.
 */
class FishCenterService extends BaseService
{
    /**
     * FishCenterService constructor.
     *
     * @param  FishCenter  $FishCenter
     */
    public function __construct(FishCenter $fishCenter)
    {
        $this->model = $fishCenter;
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

    public function store(array $data = []): FishCenter
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.create')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return  $this->model::create($data);
    }

    /**
     * @param FishCenter $item
     * @param array $data
     * @return bool
     */
    public function update(FishCenter $item, array $data = []): bool
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.edit')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return $item->update($data);
    }

    public function island($id){

        return $query =  DB::table('islands')
        ->select('islands.id', 'fish_centers.name')
        ->leftJoin('fish_centers','islands.id','=','fish_centers.island_id')
        ->where('islands.id','=',$id)
        ->get();
 
 
     }
}
