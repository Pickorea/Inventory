@extends('layouts.app')

@section('title', __('View Island'))

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
    <x-frontend.card>
        <x-slot name="header">
            @lang('View') @lang('Island') @lang('Stock') @lang('Take') @lang('Status')
        </x-slot>

        <x-slot name="body">
            <div class=""><label>@lang('Name')</label>
                <table class="table table-striped">
                                <thead class ="table-light">
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Stock Take Date</th>
                                    <th scope="col">Comments</th>
                                    <th scope="col">View As</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                @forelse($item->islandsThroughStockTake as $key => $thing)
                                    <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{ $thing['stock_take_date'] }}</td>
                                    <td>{{ $thing['comments'] }}</td>
                                    <td><a href="{{ route('report.islandstocktakepdf',  [$item->id, $thing['stock_take_date']]) }}" >PDF</a> </td>
                                    </tr>
                                    @empty
                                    <tr>
                                      <td><h2>No Stock Take</h2></td> 
                                    </tr>
                                @endforelse
                                </tbody>
                </table>
            </div>

            
            
        </x-slot>
  
               
    </x-frontend.card>
    </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
            <x-forms.post action="{{ route('comment.store') }}" class="">
                <input type="hidden" name="commentable_type" value="App\Models\Island">
                <input type="hidden" name="commentable_id" value="{{$item->id}}">
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
    @foreach($item->comments as $key => $comment)
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
            
    </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
