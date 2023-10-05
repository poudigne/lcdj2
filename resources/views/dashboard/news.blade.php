@extends('dashboard/layout')

@section('title', 'Page Title')

@section('content')

<h2 class="header">List of news</h2>
<div class="btn-group">
  <button type="button" class="btn btn-default" id="btn_action_create_news">Create new</button>
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a id="delete-request" data-field-link="{{ route('dashboard::news.delete.post') }}">Delete</a></li>
    <li><a id="publish-request" data-field-link="{{ route('dashboard::news.publish.post') }}">Publish</a></li>
    <li><a id="unpublish-request" data-field-link="{{ route('dashboard::news.unpublish.post') }}">Unpublish</a></li>
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
    @foreach ($news as $set)
      <tr class="@if ($set->is_published == 0) warning @endif">
        <td style="width:3%;"><input type="checkbox" data-field-id="{{ $set->id }}" class="check-box" /></td>
        <td style="width:3%;"><button type="button" class="btn btn-default btn-xs btn-edit glyphicon glyphicon-pencil" href="{{ route('dashboard::news.edit', ['id'=>$set->id]) }}"></button></td>
        <td>{{ $set->title }}</td>
        <td>{{ $set->created_at }}</td>
        <td>{{ $set->description }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
<script type="text/javascript">

  $("#btn_action_create_news").on('click',function(){
    window.location.href = "{{ route('dashboard::news.create') }}";
  });

  $(".btn-edit").click(function(){
    var link = $(this).attr('href');
    window.location.href = link;
  });

</script>

@stop