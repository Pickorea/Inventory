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
        <form action="{{ route("asset.store") }}" method="POST" >
            @csrf
            
            

            <div class="card">
                <div class="card-header">
                    Add Asset
                </div>

                <div class="card-body">
 
                <div class="form-group {{ $errors->has('donor_id') ? 'has-error' : '' }}">
                <label for="donor_id">@lang('Donor')</label>
                                        <select name="donor_id" name="donor_id" class="form-control" required>
                                            @foreach($donors as $donor)
                                                <option value="{{ $donor->id }}" @if($donor->id == old('donor_id', $donor->donor_id))selected="true"@endif> {{ $donor->name }}</option>
                                            @endforeach
                                        </select>
                @if($errors->has('donor_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('donor_id') }}
                    </em>
                @endif
                
            </div>

           
                <table class="table" id="products_table">
                        <thead>
                            <tr>
                                <th>Assets Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                            <tr id="product0">
                                   
                                    <td>
                                        <input type="text" name="name[]" class="form-control"/>
                                    </td>

                                    <td>
                                        <input type="number" name="quantity[]" class="form-control"/>
                                    </td>

                                    <td>
                                        <input type="number" name="unit_price[]" class="form-control"/>
                                    </td>
                                </tr>
                           
                                <tr id="product1"></tr>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-12">
                            <button id="add_row" class=" pull-left">+ Add Row</button>
                            <button id='delete_row' class="pull-right ">- Delete Row</button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <input class="btn btn-success" type="submit" value="Save">
            </div>
        </form>


    </div>
</div>
@endsection


