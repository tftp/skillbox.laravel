<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class SendDigest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send_digest
                            {period=weekly : Период принимает значения yearly, monthly, weekly, daily}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправка письма пользователям';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        switch ($this->argument('period')) {
            case 'yearly':
                $period = 365;
                $name = 'за год';
                break;
            case 'monthly':
                $period = 31;
                $name = 'за месяц';
                break;
            case 'weekly':
                $period = 7;
                $name = 'за неделю';
                break;
            case 'daily':
                $period = 1;
                $name = 'за день';
                break;
            default:
                $period = 7;
                $name = 'за неделю';
                break;
        }

        $users = \App\Models\User::all();
        $articles = \App\Models\Article::where('created_at', '>', Carbon::now()->subDays($period))->get();

        foreach ($users as $user) {
            $user->notify(new \App\Notifications\MailDigest($articles, $name));
        }
    }
}
