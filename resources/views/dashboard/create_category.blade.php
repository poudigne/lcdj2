@extends('dashboard/layout')

@section('title', 'Page Title')

@section('content')
    <h2 class="header">Create new category</h2>

  <form method="post" action="{{ route('dashboard::category.create.post') }}">

      @include("dashboard/partials/category_form")

  </form>
@stop