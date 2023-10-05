@extends('../dashboard/layout')

@section('title', 'Page Title')

@section('content')

    <h2 class="header">Edit the event</h2>

	<form method="post" action="{{ route('dashboard::event.edit.post', ['id' => $event->id]) }}">
        @include("dashboard.partials.event_form")
	</form>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example-getting-started').multiselect();
            $('#event_datetime').datetimepicker({date: '{{ old('event_datetime') == "" ? $event->datetime : old('event_datetime') }}'});
        });
    </script>
@stop
