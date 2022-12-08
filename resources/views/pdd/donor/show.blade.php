@extends('layouts.app')

@section('title', __('Islands').' '.__('Dashboard'))

@push('after-styles')
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('/') }}/css/dataTables.bootstrap4.min.css" />
@endpush

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                    <x-frontend.card>
                        <x-slot name="header">
                        <div class="row">
                        <div class="col">
                            {{ Breadcrumbs::render('donor', $donor) }}
                            </div>
                            <!-- <div class="col">
                                <h3>@lang('Donations of') {{$donor->name}}</h3>
                            </div> -->
                            <div class="col-auto">
                           
                            <div class="box-header with-border">
                        <div class="alert alert-info clearfix">
                         
                            <a  href="{{ route('report.showpdf', $donor['id'] ) }}" class="alert-link"><button type="button" class="btn btn-primary btn-sm float-start">{{ __(' To PDF') }}</button></a>  
  
                        </div>
                        
                     </div>

                              
                            </div>
                        </div>
                        </x-slot>

                        <x-slot name="body">
                        <script src="//code.jquery.com/jquery-1.12.3.js"></script>
                        <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
                        <link rel="stylesheet"
                             href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">     
                            <table id="example" class="table table-hover mx-0 table-striped" >
                            <thead class ="table-dark">
                            <tr>
                               
                                <th>Quantity</th>
                               
                               
                                <th>
                                Asset Name
                                       
                                 
                                </th>

                                <th>
                                 
                                Unit Price
                           
                          </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($items as  $item)
                                <tr>
                                <td>{{ $item->quantity??"No donation" }}</td>
                                <td>{{ $item->name??"No donation" }}</td>
                                <td>{{ $item->unit_price??"No donation" }}</td>
                             
                               
                                </tr>
                            @empty
                            <tr>
                                <td>No donation</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                 


                        </x-slot>
                    </x-frontend.card>
                    </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
            <x-forms.post action="{{ route('comment.store') }}" class="">
                <input type="hidden" name="commentable_type" value="App\Models\Donor">
                <input type="hidden" name="commentable_id" value="{{$donor->id}}">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Create') @lang('Comments')
                    </x-slot>

                    <x-slot name="body">
           
                        <x-forms.textarea required type="text" name="body" label="{{ __('Comments') }}" value="" />
                    </x-slot> 
                    <x-slot name="footer">
                        <button type="submit" class="btn btn-primary">@lang('Save')</button>
                        <a href="{{ route('island.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
                    </x-slot>
                </x-frontend.card>
           
               
                                <div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Recent Comment</h6>
    @foreach($donor->comments as $key => $comment)
    <div class="d-flex text-muted pt-3">
      
      
    </div>
    <div class="d-flex text-muted pt-3">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#e83e8c"></rect><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text></svg>

      <p class="pb-3 mb-0 small lh-sm border-bottom">
        <strong class="d-block text-gray-dark">{{ $comment->user->name }}</strong>
        {{ $comment['body'] }}
      </p>
    </div>
    @endforeach
    
    <small class="d-block text-end mt-3">
      <a href="#">All updates</a>
    </small>
  </div>
 </x-forms.post>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                pagingType: 'full_numbers',
                "paging":true,
                "ordering":true,
                "info":true
                
            
            
            });
        });
    </script>
@endsection
