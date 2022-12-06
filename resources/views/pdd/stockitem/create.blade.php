@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
    <x-forms.post action="{{ route('stock.store') }}" class="">
        <x-frontend.card>
            <x-slot name="header">
                @lang('Create') @lang('Stock Take')
            </x-slot>

            <x-slot name="body">
                <x-forms.textfield required type="text" name="name" label="{{ __('Name') }}" value="" />
                 <x-forms.textfield required type="text" name="description" label="{{ __('Description') }}" value="" />
            </x-slot>
            <x-slot name="footer">
                <button type="submit" class="btn btn-primary">@lang('Save')</button>
                <a href="{{ route('stock.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
            </x-slot>
        </x-frontend.card>
    </x-forms.post>
    </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
