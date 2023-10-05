@extends('dashboard/layout')

@section('title', 'Page Title')

@section('content')
@if (isset($deleted))
  @if ($deleted == '1')
    <script type="text/javascript">
      Materialize.toast('Product successfuly deleted !', 4000);
    </script>
  @else
    <script type="text/javascript">
      Materialize.toast('Error has occured : {{ $deleted }}', 4000);
    </script>
  @endif
@endif

<h2 class="header">List of products</h2>

<div class="btn-group">
  <button type="button" class="btn btn-default" id="btn_action_delete_sale" data-field-link="{{ route('dashboard::sale.delete.post') }}">Delete selected</button>
</div>



<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th data-field="delete"><input type="checkbox" id="check-all" value="0"/></th>
      <th></th>
      <th data-field="product_name">Product name</th>
      <th data-field="quantity">Quantity</th>
      <th data-field="unit_price">Unit Price</th>
      <th data-field="date">Date</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($sales as $set)
      <tr>
        <td style="width:3%;"><input type="checkbox" data-field-id="{{ $set->id }}" class="check-box" /></td>
        <td style="width:3%;"><button type="button" class="btn btn-default btn-xs btn-edit glyphicon glyphicon-trash" href="{{ route('dashboard::sale.delete', ['id'=>$set->id]) }}"></button></td>

        <td>{{ $set->product->title }}</td>
        <td>{{ $set->quantity }}</td>
        <td>{{ $set->unit_price }}</td>
        <td>{{ $set->created_at }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

<div class="row">
  <div class="col-lg-12">
    {!! $sales->render() !!}
  </div>
</div>
<script type="text/javascript">


</script>
@stop