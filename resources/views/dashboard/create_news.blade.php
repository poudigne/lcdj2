@extends('../dashboard/layout')

@section('title', 'Page Title')

@section('content')
    <h2 class="header">Créé une nouvelle</h2>

	<form method="post" action="{{ route('dashboard::news.create.post') }}">
        @include('dashboard.partials.news_form')
	</form>

    <script type="text/javascript">
    
        $(document).ready(function() {
            $('#example-getting-started').multiselect();
        });

    </script>
@stop
