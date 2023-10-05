@extends('../dashboard/layout')

@section('title', 'Page Title')

@section('content')

    <h2 class="header">Create new products</h2>

	<form method="post" action="{{ route('dashboard::product.create.post') }}" files="true" enctype="multipart/form-data">
        @include("dashboard/partials/product_form")
	</form>
    @include('dashboard.partials.product_form_script')

@stop
