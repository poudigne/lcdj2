@include('dashboard.partials.error')
<?php
    $catIds = array_map( function($val){ return $val['id']; }, $event->categories->toarray() );
?>
<div class="form-group row">
    <label for="is_published" class="col-sm-2 form-control-label">is published</label>

    <div class="col-sm-10">
        <input type="checkbox" class="" id="is_published" name="is_published" {{ old('is_published') == "" ? ($event->is_published == 1 ? "checked" : "") : (old('is_published') == 1 ? "checked" : "" )}}>
    </div>
</div>
<!-- Titre  de levent -->
<div class="form-group row">
    <label for="event_title" class="col-sm-2 form-control-label">* Name</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" name="event_name" value="{{ old('event_name') == "" ? $event->name : old('event_name') }}" id="event_title" placeholder="Event name">
    </div>
</div>
{{-- dd(array_map( function($val){ return $val['id']; }, $event->categories->toarray() )) --}}
<!-- categories de levent -->
<div class="form-group row">
    <label for="event_title" class="col-sm-2 form-control-label">Categorie</label>
    <div class="col-sm-10">
        <select id="example-getting-started" name="event_categories[]" multiple="multiple" class="form-control">

            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ in_array($cat->id, $catIds) ? "selected='selected'" : "" }}>{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<!-- description de levent -->
<div class="form-group row">
    <label for="event_description" class="col-sm-2 form-control-label">* Description</label>
    <div class="col-sm-10">
        <textarea id="inputeventdescriptipn" name="event_description"  type="text" class="materialize-textarea form-control" placeHolder="Description">{{ old('event_description') == "" ? $event->description : old('event_description') }}</textarea>
    </div>
</div>

<!-- date de levent -->
<div class="form-group row">
    <label for="event_datetime" class="col-sm-2 form-control-label">* Date</label>
    <div class="col-sm-10">
            <div class="form-group">
                <div class='input-group date' id='event_datetime'>
                    <input type='text' class="form-control" name="event_datetime" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>

    </div>
</div>


<div class="row">
    <div class="input-field col s6">

    </div>
</div>

{!! csrf_field() !!}
<button type="submit" class="btn btn-primary">Submit</button>
