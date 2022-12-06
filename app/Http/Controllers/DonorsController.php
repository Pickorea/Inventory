<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\EditRequest;
use App\Http\Requests\StoreDonorRequest;
use App\Http\Requests\UpdateDonorRequest;
use App\Http\Requests\ViewRequest;
use App\Models\Donor;
use App\Pdd\Services\DonorService;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class DonorsController extends Controller
{
    private const PREFIX_VIEW = 'pdd.donor.';
    private const PREFIX_ROUTE = 'donor.';
    // private const TYPE = Donor::TYPE;

    /**
     * @var DonorService
     */
    protected $service;

    /**
    * SpeciesController constructor.
    * @param DonorService $service
    */
    public function __construct(DonorService $service)
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
            ->withItem(new Donor());
    }

    /**
     * @param StoreDonorRequest $request
     * @return mixed
     */
    public function store(StoreDonorRequest $request)
    {
         // dd($request->all());
        $item = $this->service->store($request->validated());

        return redirect()->route(static::PREFIX_ROUTE . 'show', $item)
            ->withFlashSuccess(__('was successfully created.'));
    }

    /**
     * @param ViewRequest $request
     * @param Donor $donor
     * @return mixed
     */
    public function show(ViewRequest $request, $id)
    {
        $d = Donor::select('name','id')->find($id);

       $w = DB::table('donors')
            ->select('donors.name', 'assets.name', 'assets.quantity', 'assets.unit_price')
            ->leftJoin('assets','donors.id','=','assets.donor_id')
            ->where('donors.id','=',$id)
            ->get();
        return view(static::PREFIX_VIEW . 'show')
            ->withItems($w)->withDonor($d);
    }

    /**
     * @param EditRequest $request
     * @param Donor $kiDonor
     * @return mixed
     */
    public function edit(EditRequest $request, Donor $donor)
    {
        return view(static::PREFIX_VIEW . 'edit')
            ->withItem($donor);
    }

    /**
     * @param UpdateDonorRequest $request
     * @param Donor $donor
     * @return mixed
     */
    public function update(UpdateDonorRequest $request, Donor $donor)
    {
        $this->service->update($donor, $request->validated());

        return redirect()->route(static::PREFIX_ROUTE . 'show', $donor)
            ->withFlashSuccess(__('T was successfully updated.'));
    }

    /**
     * @param EditRequest $request
     * @param Donor $donor
     * @return mixed
     */
    public function destroy(EditRequest $request, Donor $donor)
    {
        $this->service->delete($donor);

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
        $filename = "Donors-".Carbon::now()->toDateString().".xlsx";

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
