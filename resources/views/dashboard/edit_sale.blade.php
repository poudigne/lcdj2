@extends('../dashboard/layout')

@section('title', 'Page Title')

@section('content')
    <h2 class="header">Edit a new sale</h2>

	<form method="post" action="{{ route('dashboard::sale.edit.post') }}">
        @include('dashboard.partials.sale_form')
	</form>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example-getting-started').multiselect();
            $("input[type='text']").bind("change paste keyup", function() {
                calculateTotal();
            });
            calculateTotal();
        });

        var calculateTotal = function(){
            var qty = $("input[name='item_quantity']").val();
            var unit_price = $("input[name='item_price']").val();
            console.log ("qty = " + qty + " * unit price = " + unit_price + " total = " + (qty * unit_price));
            $("#total_price").html(qty * unit_price);
        }


    </script>
@stop
