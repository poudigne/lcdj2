@extends('dashboard/layout')

@section('title', 'Page Title')

@section('content')
    <h2 class="header">Edit category</h2>

  <form method="post" action="{{ route('dashboard::category.edit.post', ['id' => $category->id]) }}">
      @include("dashboard/partials/category_form")
  </form>
@stop