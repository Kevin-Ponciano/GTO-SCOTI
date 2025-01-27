<?php

namespace App\Console\Commands;

use App\Models\ScheduledTask;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class scheduleTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:create-tasks-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria tarefas agendadas';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        # Finalizar a recorrencia, para verificar se nas datas anteriores foi aberto a tarefa
        # Caso não tenha sido aberta, avançar a data agendada de acordo com a frequencia todo
        $today = Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now()->format('H:i');

        $scheduleTasks = ScheduledTask::where('date', $today)->where('hour', $currentTime)->get();


        $this->info('Tarefas criadas com sucesso!');
    }

    private function createRecurringTasks($scheduleTasks)
    {
        foreach ($scheduleTasks as $scheduleTask) {
            #Tarefa Recorrente, será aberta n vezes
            if ($scheduleTask->recorrence_count > 1) {
                #Duplicar a tarefa
                $newTask = new Task();
                $newTask->fill($scheduleTask->task->getAttributes());

                #Crio a tarefa agendada
                $scheduleTask->task->situation = 'open';
                $scheduleTask->task->status = 'Em dia';
                $scheduleTask->task->date_create = Carbon::now()->format('Y-m-d');
                $scheduleTask->task->scheduled_task_id = null;
                $scheduleTask->task->save();

                $newTask->scheduled_task_id = $scheduleTask->id;
                $newTask->save();

                #PREPARAÇÃO PARA PROX TAREFA
                #Agendo novamente o scheduleTask 'daily', 'weekly', 'monthly', 'yearly'
                $frequency = $scheduleTask->frequency;
                $nextScheduleDay = Carbon::createFromFormat('Y-m-d', $scheduleTask->date);
                $nextScheduleDay->add('1', $frequency);
                $scheduleTask->date = $nextScheduleDay;

            } else {
                $scheduleTask->task->situation = 'open';
                $scheduleTask->task->status = 'Em dia';
                $scheduleTask->task->date_create = Carbon::now()->format('Y-m-d');
                $scheduleTask->task->save();

            }
            $scheduleTask->recorrence_count--;
            $scheduleTask->save();
        }
    }
}
