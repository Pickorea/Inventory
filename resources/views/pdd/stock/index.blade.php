@extends('layouts.app')

@section('title', __('Islands').' '.__('Dashboard'))

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                    <x-frontend.card>
                        <x-slot name="header">
                        <div class="row">

                            <div class="col">
                                <h3>@lang('Stocks')</h3>
                            </div>
                            <div class="col-auto">
               
                  
                    <a href="{{ route("donor.create") }}" class="btn btn-outline-info" id="exportBtn">@lang('Create')</a>

                
            </div>
                        </div>
                        </x-slot>

                        <x-slot name="body">

                            <script src="//code.jquery.com/jquery-1.12.3.js"></script>
                        <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
                        <script
                            src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js">
                        </script>
                        <script>
                            src="https://code.jquery.com/jquery-3.5.1.js">

                        </script>
                        <script>
                            src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js">
                        </script>
                        <link rel="stylesheet"
                            href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">

                        <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Fish Cernter Name</th>
                                        <th>Qty OnHand</th>
                                        <th>Number of Defect</th>
                                        <th>Year</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                                @foreach($items as $item)
                                                        <tr>
                                                            <td>{{ $item->fcName }}</td>
                                                            <td>{{ $item->onhand }}</td>
                                                            <td>{{ $item->defect }}</td>
                                                            <td>{{ $item->year }}</td>
                                                            
                                                        </tr>
                                                    @endforeach
                                
                                </tbody>
                                
                            </table>

                            </x-slot>
                                            </x-frontend.card>
                                            </div><!--col-md-10-->
                                </div><!--row-->
                            </div><!--container-->

                            <script>
                    $(document).ready(function () {
                        $('#example').DataTable({
                            pagingType: 'full_numbers',
                        
                        
                        //     columnDefs: [
                        //         {
                        //             target: 1,
                        //             visible: false,
                        //             searchable: false,
                        //         },
                        //         {
                        //             target: 2,
                        //             visible: false,
                        //         },
                        //     ],
                        });
                    });
                        </script>

                        @endsection

@push('after-scripts')

@endpush