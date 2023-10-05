@extends('../dashboard/layout')

@section('title', 'Page Title')

@section('content')

    <h2 class="header">Create new event</h2>

	<form method="post" action="{{ route('dashboard::event.create.post') }}">
        @include("dashboard/partials/event_form")
	</form>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example-getting-started').multiselect();
            $('#event_datetime').datetimepicker();

        });
    </script>
@stop
