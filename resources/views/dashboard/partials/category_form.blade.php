@include('dashboard.partials.error')
<div class="form-group row">
    <label for="is_published" class="col-sm-2 form-control-label">is published</label>

    <div class="col-sm-10">
        <input type="checkbox" class="" id="is_published" name="is_published" {{ old('is_published') == "" ? ($category->is_published == 1 ? "checked" : "") : (old('is_published') == 1 ? "checked" : "" )}}>
    </div>
</div>

<!-- Nom de la categorie -->
<div class="form-group row">
    <label for="category_name" class="col-sm-2 form-control-label">* Nom</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="category_name" name="category_name" value="{{ old('category_name') == "" ? $category->name : old('category_name') }}" placeholder="Nom de la catégorie">
    </div>
</div>

<!-- Description de la categorie -->
<div class="form-group row">
    <label for="category_description" class="col-sm-2 form-control-label">Description</label>
    <div class="col-sm-10">
        <textarea id="category_description" name="category_description" type="text" class="form-control" placeHolder="Description">{{ old('category_description') == "" ? $category->description : old('category_description') }}</textarea>
    </div>
</div>

<button type="submit" class="btn btn-primary">Submit</button>
{!! csrf_field() !!}