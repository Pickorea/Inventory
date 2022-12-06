<?php

namespace App\Pdd\Services;

use App\Models\Share;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class ShareService.
 */
class ShareService extends BaseService
{
    /**
     * ShareService constructor.
     *
     * @param  Share  $Share
     */
    public function __construct(Share $share)
    {
        $this->model = $share;
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

    public function store(array $data = []): Share
    {
        DB::beginTransaction();

        $item = $this->model::create($data);

        
        if ($item) {
            
            $count = 0 ;
            $syncAsset = [];
            foreach ($data['asset_id'] as $species) {
                $pivot = [
                  
                    'quantity' => intval($data['quantity'][$count]),
                ];
                $syncSpecies[intval($species)] = $pivot;
                ++$count;
            }
            $item->assets()->sync($syncAsset);
           
            DB::commit();

            return $item;
        }

        DB::rollBack();

        throw new GeneralException(__('There was a problem creating this crime. Please try again.'));
    }

    /**
     * @param Share $item
     * @param array $data
     * @return bool
     */
    public function update(Share $item, array $data = []): bool
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.edit')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return $item->update($data);
    }
}
