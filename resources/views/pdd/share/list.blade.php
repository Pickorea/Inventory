@extends('layouts.app')

@section('title', __('Dashboard'))

@section('content')

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />   -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>
        $(document).ready(function(){
        let row_number = 1;
        $("#add_row").click(function(e){
            e.preventDefault();
            let new_row_number = row_number - 1;
            $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
            $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
            row_number++;
        });
        
        $("#delete_row").click(function(e){
            e.preventDefault();
            if(row_number > 1){
            $("#product" + (row_number - 1)).html('');
            row_number--;
            }
        });
        });
        
</script>
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
            <div class="card-body">
        <form action="{{ route("share.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            

            <div class="card">
                <div class="card-header">
                    Add Share
                </div>

                <div class="card-body">
                <div class="form-group {{ $errors->has('fishcenter_id') ? 'has-error' : '' }}">
                <label for="donor_name">Donor Name*</label>
                <br>
                @foreach ($donors as $indexKey => $donor )
                  
                                {{--<input  name="name[]" type="radio" value="{{$donor->id}}" {{$donor->name}}--}}
                                <input type="hidden" name="donor->id" value="{{$donor->id}}" />
                                <input type="radio" name="donor->id"  value="{{$donor->id}}" @if (!$indexKey) {!! "checked" !!} @endif>{{$donor->name}}</td>
  
                @endforeach

            
                <div class="form-group {{ $errors->has('fishcenter_id') ? 'has-error' : '' }}">
                <label for="customer_name">Recipient*</label>
                <select name="fishcenter_id" class="form-control">
                                            <option value="">-- choose reciepient --</option>
                                            @foreach ($fishCenters as $fishcenter)
                                                <option value="{{ $fishcenter->id }}"}>
                                                    {{ $fishcenter->name }} 
                                                </option>
                                            @endforeach
                                        </select>
                @if($errors->has('fishcenter_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('fishcenter_id') }}
                    </em>
                @endif
                
            </div>

            <div class="form-group {{ $errors->has('share_date') ? 'has-error' : '' }}">
                <label for="customer_name">Date*</label>
                <input type="date" name="share_date" class="form-control" />
                @if($errors->has('share_date'))
                    <em class="invalid-feedback">
                        {{ $errors->first('share_date') }}
                    </em>
                @endif
                
            </div>
                <table class="table" id="products_table">
                        <thead>
                            <tr>
                                <th>Assets</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            <tr id="product0">
                                    <td>
                                        <select name="asset_id[]" class="form-control">
                                            <option value="">-- choose product --</option>
                                            @foreach ($assets as $asset)
                                                <option value="{{ $asset->id }}">
                                                    {{ $asset->name }} (${{ number_format($asset->unit_price, 2) }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="quantity[]" class="form-control" value="1" />
                                    </td>
                                </tr>
                           
                                <tr id="product1"></tr>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-12">
                            <button id="add_row" class="pull-left">+ Add Row</button>
                            <button id='delete_row' class="pull-right">- Delete Row</button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <input  type="submit" value="Save">
            </div>
        </form>


    </div>
</div>
@endsection


