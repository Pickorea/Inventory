@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
    <x-forms.patch action="{{ route('donor.update', $item->id) }}" class="">
        <x-frontend.card>
            <x-slot name="header">
                @lang('Edit') @lang('Island')
            </x-slot>

            <x-slot name="body">
                <x-forms.textfield required type="text" name="name" label="{{ __('Name') }}" value="{{ $item->name }}" />
            </x-slot>
            <x-slot name="footer">
                <button type="submit" class="btn btn-primary">@lang('Save')</button>
                <a href="{{ route('frontend.kiims.island.index') }}" class="btn btn-secondary">@lang('Cancel')</a>
            </x-slot>
        </x-frontend.card>
    </x-forms.patch>
    </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
