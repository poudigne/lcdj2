@include('dashboard.partials.error')

<?php
    $option = "<option value=''></option>";
        $checked = '';
    foreach ($products as $set)
    {
        if ($sale->product_id == $set->id)
            $checked = 'selected';
        $option .= "<option value='".$set->id."' ".$checked.">".$set->title."</option>";
    }
    $input = "<select class='form-control' name='product_id'>".$option."</select>";
?>

<table id="sale-table" class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Unit price</th>
            <th>Total price</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>{!! $input !!}</th>
            <th><input type="text" name="item_quantity" class="form-control" value="{{ old('item_quantity') == "" ? $sale->quantity : old('item_quantity') }}"/></th>
            <th><input type="text" name="item_price" class="form-control" value="{{ old('item_price') == "" ? $sale->unit_price : old('item_price') }}"/></th>
            <th><span id="total_price"></span></th>
        </tr>
    </tbody>
</table>

<button type="submit" class="btn btn-primary">Submit</button>
{!! csrf_field() !!}