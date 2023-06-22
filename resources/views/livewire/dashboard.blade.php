@php
$color1 = $tasksCount == 0 ? 'gray' : 'green';
$color2 = $tasksExpiredCount == 0 ? 'gray' : 'yellow';
$color3 = $tasksScheduledCount == 0 ? 'gray' : 'blue';


@endphp
<div>
    <div>
        <div class="grid grid-cols-3 gap-1 mb-4">
            <x-card-number number="{{$tasksCount}}"
                           url="{{route('tasks')}}"
                           icon='bi bi-list-task'
                           info="Tarefas Abertas"
                           color='bg-{{$color1}}'
            />
            <x-card-number number="{{$tasksExpiredCount}}"
                           url="tarefas?statusFilter=Expirado"
                           icon='bi bi-clock'
                           info="Tarefas Expiradas"
                           color='bg-{{$color2}}'/>
{{--            <x-card-number number="{{$tasksScheduledCount}}"--}}
{{--                           url="{{route('tasks-scheduled')}}"--}}
{{--                           icon='bi bi-calendar-event'--}}
{{--                           info="Tarefas Agendadas"--}}
{{--                           color='bg-{{$color3}}'/>--}}
        </div>
    </div>
</div>
