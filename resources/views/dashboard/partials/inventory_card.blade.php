@extends('dashboard/layout')

@section('title', 'Page Title')

@section('content')
    <style>

        .thumbnail{
            width:    300px;
            /*height:   400px;*/
            overflow: auto;
        }

        .product-description {
            display:          block;
            height:           100px;
            padding-bottom:   3px;
            width:            100%;
        }

        .in-stock-text{
            height:       25px;
            line-height:  25px;
            margin:       0 0 0 3px;
        }
        .top-spacer
        {
            margin-top: 15px;
        }
    </style>


    <h2 class="header">Inventory</h2>
    <div class="row">
        <div class="col-lg-3 btn-group">
            <button type="button" class="btn btn-default" id="btn_action_create_product">Create new product</button>
        </div>

        <div class="col-lg-4 float-right">
            <div class="input-group">
                <input type="text" class="form-control" id="search-product" placeholder="Search for...">
        <span class="input-group-btn">
            <button id="btn-search" class="btn btn-default" type="button" href="{{ route('dashboard::inventory.search.post') }}">Go!</button>
        </span>
            </div>
        </div>

        <!-- Single button -->
        <div class="input-group  col-lg-2 float-right">
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                    @if (isset($sorttype))
                        @if ($sorttype == 0) A to Z @endif
                        @if ($sorttype == 1) Z to A @endif
                        @if ($sorttype == 2) Stock Asc @endif
                        @if ($sorttype == 3) Stock Desc @endif
                        @if ($sorttype == 4) Show 'out of stock' only @endif

                    @else
                        Sort by ...
                    @endif
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('dashboard::inventory.sort',['sorttype' => 0]) }}">A to Z</a></li>
                    <li><a href="{{ route('dashboard::inventory.sort',['sorttype' => 1]) }}">Z to A</a></li>
                    <li><a href="{{ route('dashboard::inventory.sort',['sorttype' => 2]) }}">Stock Asc</a></li>
                    <li><a href="{{ route('dashboard::inventory.sort',['sorttype' => 3]) }}">Stock Desc</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ route('dashboard::inventory.sort',['sorttype' => 4]) }}">Show 'out of stock' only</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div id="product-content" class="row top-spacer">
        @yield('cards')


    </div>
    <script type="text/javascript">

            $(document).on('click', "#btn_action_create_product", function () {
                window.location.href = "{{ route('dashboard::product.create') }}";
            });

            $(document).on('click', '.inv-dec', function () {
                var found = $(this).closest("div[data-field-id]");
                var product_id = found.attr('data-field-id');
                sendSearchRequest('dec', product_id);
            });
            $(document).on('click', '.inv-inc', function () {
                var found = $(this).closest("div[data-field-id]");
                var product_id = found.attr('data-field-id');
                sendSearchRequest('inc', product_id);
            });


            $(document).on('click', "#btn-search", function () {
                $.ajax({
                    url: $(this).attr('href'),
                    type: "post",
                    data: {
                        "keywords": $("#search-product").val(),
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json"
                }).done(function (data) {
                    $("#product-content").html(data);
                }).fail(function (data) {
                    console.log("fail");
                }).always(function (data) {
                    console.log("always");
                });
            });
        var getStockString = function ($quantity) {
            var string = $quantity + " in stock";
            if ($quantity == 0)
                string = 'out of stock';
            return string;
        }
        var sendSearchRequest = function (modifier, product_id) {
            var link = '';
            if (modifier == 'inc')
                link = '{{ route("dashboard::inventory.inc.post") }}';
            else if (modifier == 'dec')
                link = '{{ route("dashboard::inventory.dec.post") }}';
            $.ajax({
                url: link,
                type: "post",
                data: {
                    "product_id": product_id,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json"
            }).always(function (data) {
                var found = $(document).find("div[data-field-id='" + data.product_id + "']");

                $(found).find('[data-field-quantity]').html(getStockString(data.quantity));
            });
        };
    </script>

@stop

