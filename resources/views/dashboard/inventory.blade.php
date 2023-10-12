
@extends('dashboard/partials/inventory_card')
@section('cards')
    @foreach ($products as $set)
        <div class="col-sm-5 col-lg-3" style="display:flex; flex-wrap: wrap;">
            <div class="thumbnail" data-field-id="{{ $set->id }}">
                <img data-holder-rendered="true" src="@if ($set->getFirstMedia('images') != null){{ str_replace('localhost','localhost:8000', $set->getFirstMedia('images')->getUrl()) }} @endif" style="height: 200px; width: 100%; display: block;" data-src="holder.js/100%x200" alt="">
                <div class="caption">
                    <h4>{{ $set->title }}</h4>
                    <div style="height: 25px;">
                        <a class="inv-dec float-left btn btn-xs btn-default glyphicon glyphicon-minus" role="button"></a>
                        <a class="inv-inc float-left btn btn-xs btn-default glyphicon glyphicon-plus" role="button"></a>
                        <span class="in-stock-text"><small data-field-quantity="">
                            @if ($set->inventory->quantity == 0)
                                out of stock
                            @else
                                {{ $set->inventory->quantity }} in stock
                            @endif
                        </small></span>
                        <div class="btn-group float-right">
                            <button type="button" class=" btn-edit btn btn-xs btn-default glyphicon glyphicon-pencil" href="{{ route('dashboard::product.edit', ['id'=>$set->id]) }}" ></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col-lg-12">
            {!! $products->render() !!}
        </div>
    </div>
@stop