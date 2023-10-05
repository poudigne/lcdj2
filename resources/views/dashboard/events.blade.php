@extends('dashboard/layout')

@section('title', 'Page Title')

@section('content')

<h2 class="header">List of upcoming events</h2>
<div class="btn-group">
  <button type="button" class="btn btn-default" id="btn_action_create_events">Create new</button>
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a id="delete-request" data-field-link="{{ route('dashboard::event.delete.post') }}">Delete</a></li>
    <li><a id="publish-request" data-field-link="{{ route('dashboard::event.publish.post') }}">Publish</a></li>
    <li><a id="unpublish-request" data-field-link="{{ route('dashboard::event.unpublish.post') }}">Unpublish</a></li>
  </ul>
</div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th data-field="delete"><input type="checkbox" id="check-all" value="0"/></th>
      <th></th>
      <th data-field="title">Name</th>
      <th data-field="datetime">Date and Time</th>
      <th data-field="description">Description</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($events as $set)
      <tr class="@if ($set->is_published == 0) warning @endif">
        <td style="width:3%;"><input type="checkbox" data-field-id="{{ $set->id }}" class="check-box" /></td>
        <td style="width:3%;"><button type="button" class="btn btn-default btn-xs btn-edit glyphicon glyphicon-pencil" href="{{ route('dashboard::event.edit', ['id'=>$set->id]) }}"></button></td>
        <td>{{ $set->name }}</td>
        <td>{{ $set->datetime }}</td>
        <td>{{ $set->description }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
<script type="text/javascript">

  $("#btn_action_create_events").on('click',function(){
    window.location.href = "{{ route('dashboard::event.create') }}";
  });

  $(".btn-edit").click(function(){
    var link = $(this).attr('href');
    console.log(link);
    window.location.href = link;
  });

</script>

@stop