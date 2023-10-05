@extends('../dashboard/layout')

@section('title', 'Page Title')

@section('content')
    <h2 class="header">Create a new sale</h2>

	<form method="post" action="{{ route('dashboard::sale.create.post') }}">
        @include('dashboard.partials.sale_form')
	</form>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example-getting-started').multiselect();
            $("input[type='text']").bind("change paste keyup", function() {
                var qty = $("input[name='item_quantity']").val();
                var unit_price = $("input[name='item_price']").val();
                $("#total_price").val(qty * unit_price);
            });
        });
    </script>
@stop
