@include('dashboard.partials.error')


<?php
    $catIds = array_map( function($val){ return $val['id']; }, $news->categories->toarray() );
?>

<div class="form-group row">
    <label for="is_published" class="col-sm-2 form-control-label">is published</label>
    <div class="col-sm-10">
        <input type="checkbox" class="" id="is_published" name="is_published" {{ old('is_published') == "" ? ($news->is_published == 1 ? "checked" : "") : (old('is_published') == 1 ? "checked" : "" )}}>
    </div>
</div>
<div class="form-group row">
    <label for="news_title" class="col-sm-2 form-control-label">* Titre</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="news_title" value="{{ old('news_title') == "" ? $news->title : old('news_title') }}" id="news_title" placeholder="News' title">
    </div>
</div>

<!-- Texte de la nouvelles -->
<div class="form-group row">
    <label for="news_text" class="col-sm-2 form-control-label">* Texte</label>
    <div class="col-sm-10">
        <textarea id="input_text" name="news_text" type="text" class="materialize-textarea form-control" placeHolder="Texte...">{!! old('news_text') == "" ? $news->text : old('news_text') !!}</textarea>
    </div>
</div>

<!-- Categorie -->
<div class="form-group row">
    <label for="product_title" class="col-sm-2 form-control-label">Categorie</label>
    <div class="col-sm-10">
        <select id="example-getting-started" name="news_categories[]" multiple="multiple" class="form-control">
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ in_array($cat->id, $catIds) ? "selected='selected'" : "" }}>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<button type="submit" class="btn btn-primary">Submit</button>
{!! csrf_field() !!}