@extends('layouts.app')

@section('title', __('View Crime'))

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
    <x-frontend.card>
        <x-slot name="header">
            @lang('View') @lang('Island')
        </x-slot>

        <x-slot name="body">
            <div class=""><label>@lang('Name')</label>
                <table class="table table-striped">
                                <thead class ="table-light">
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Stock Take Date</th>
                                    <th scope="col">Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                @forelse($item->islandsThroughStockTake as $key => $thing)
                                    <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{ $thing['stock_take_date'] }}</td>
                                    <td>{{ $thing['comments'] }}</td>
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
                <input type="hidden" name="commentable_type" value="Island">
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
            </x-forms.post>
    </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
