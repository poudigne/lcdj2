@include('dashboard.partials.error')

<?php
    $catIds = array_map( function($val){ return $val['id']; }, $product->categories->toarray() );
?>

<div class="form-group row">
    <label for="is_published" class="col-sm-2 form-control-label">is published</label>
    <div class="col-sm-10">
        <input type="checkbox" class="" id="is_published" name="is_published" {{ old('is_published') == "" ? ($product->is_published == 1 ? "checked" : "") : (old('is_published') == 1 ? "checked" : "" )}}>
    </div>
</div>
<!-- Titre du produit -->
<div class="form-group row">
    <label for="product_title" class="col-sm-2 form-control-label">* Titre</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="product_title" value="{{ old('product_title') == "" ? $product->title : old('product_title') }}" id="product_title" placeholder="Titre du produit">
    </div>
</div>
{{-- dd(array_map( function($val){ return $val['id']; }, $product->categories->toarray() )) --}}
<!-- Titre du produit -->
<div class="form-group row">
    <label for="product_title" class="col-sm-2 form-control-label">Categorie</label>
    <div class="col-sm-10">
        <select id="example-getting-started" name="product_categories[]" multiple="multiple" class="form-control">

            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ in_array($cat->id, $catIds) ? "selected='selected'" : "" }}>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<!-- Charger des images -->
<div class="form-group row">
    <label for="product_title" class="col-sm-2 form-control-label">Upload images</label>
    <div class="col-sm-10">
        <input type="file" name="product_images[]" value="" class="form-control" multiple>
    </div>
</div>
<!-- Range du nombre de joueur -->
<div class="form-group row">
    <label for="product_title" class="col-sm-2 form-control-label">Nombre de joueurs</label>
    <div class="col-sm-10">
        <input type="text"  id="player_range" class="form-control" data-slider-value="[2,6]" data-slider-min="1" data-slider-max="20" />
        <span class="flavor-text" id="input-players"></span>
    </div>
</div>

<!-- Range de l'age pour jouer -->
<div class="form-group row">
    <label for="product_title" class="col-sm-2 form-control-label">Ages</label>
    <div class="col-sm-10">
        <input type="text" id="age_range" class="form-control">
        <span class="flavor-text" id="input-age"></span>
    </div>
</div>

<!-- description du produit -->
<div class="form-group row">
    <label for="product_title" class="col-sm-2 form-control-label">Description</label>
    <div class="col-sm-10">
        <textarea id="inputGameDescription" name="product_description"  type="text" class="materialize-textarea form-control" placeHolder="Description">{{ old('product_description') == "" ? $product->description : old('product_description') }}</textarea>
    </div>
</div>

<div class="form-group row">
    <label for="product_title" class="col-sm-2 form-control-label">Cost price</label>
    <div class="col-sm-10 input-group">
        <span class="input-group-addon">$</span>
        <input type="text" name="product_costprice" class="form-control" placeholder="Cost price" value="{{ old('product_costprice') == "" ? $product->cost_price : old('product_costprice') }}"/>
    </div>
</div>

<div class="form-group row">
    <label for="product_title" class="col-sm-2 form-control-label">Sale price</label>
    <div class="col-sm-10 input-group">
        <span class="input-group-addon">$</span>
        <input type="text" name="product_saleprice" class="form-control" placeholder="Sale price" value="{{ old('product_saleprice') == "" ? $product->sale_price : old('product_saleprice') }}"/>
    </div>
</div>

<div class="row">
    <div class="input-field col s6">

    </div>
</div>

<input type="hidden" id="input-players-min" name="product_input-players-min" value="" />
<input type="hidden" id="input-players-max" name="product_input-players-max" value="" />
<input type="hidden" id="input-age-min" name="product_input-age-min" value="" />
<input type="hidden" id="input-age-max" name="product_input-age-max" value="" />
{!! csrf_field() !!}
<button type="submit" class="btn btn-primary">Submit</button>
