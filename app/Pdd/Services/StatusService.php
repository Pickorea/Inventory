<?php

namespace App\Pdd\Services;

use App\Models\Status;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

/**
 * Class IslandService.
 */
class StatusService extends BaseService
{
    /**
     * IslandService constructor.
     *
     * @param  Status  $status
     */
    public function __construct(Status $status)
    {
        $this->model = $status;
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

    public function store(array $data = []): Status
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.create')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return  $this->model::create($data);
    }

    /**
     * @param Status $item
     * @param array $data
     * @return bool
     */
    public function update(Status $item, array $data = []): bool
    {
        // $user = Auth::user();
        // if (! $user->can('kiims.edit')) {
        //     throw new GeneralException(__('You do not have access to do that.'));
        // }

        return $item->update($data);
    }
}
