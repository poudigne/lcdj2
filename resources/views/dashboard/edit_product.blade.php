@extends('../dashboard/layout')

@section('title', 'Page Title')

@section('content')

    <h2 class="header">Create new products</h2>

	<form method="post" action="{{ route('dashboard::product.edit.post', ['id' => $product->id]) }}" files="true" enctype="multipart/form-data">
        @include("dashboard.partials.product_form")
	</form>
    {{-- dd($product->getMedia()) --}}
    <div id="medias-thumbnail" class="row">
    @foreach($product->getMedia() as $media)
        <div class="col-sm-5 col-lg-3" style="display:flex; flex-wrap: wrap;">
            <div class="thumbnail" data-field-product="{{ $product->id }}" data-field-media="{{ $media->id }}">
                <img data-holder-rendered="true" src="{{ $media->getUrl() }}" style="width: 100%; display: block;"  alt="100%x200">
                <button type="button" class="btn-delete-image btn btn-default btn-xs glyphicon glyphicon-trash" href="{{ route('dashboard::product.delete.media.post') }}" />
            </div>
        </div>
    @endforeach
    </div>


    @include('dashboard.partials.product_form_script')
@stop
