<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Illuminate\Console\Command;

class RemoveExpiredBooks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'books:remove-expired-books {--days=0 : The days after which the books will be removed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove expired books from a given set of days.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $counter = collect([]);
        $deadline = now()->subDays($this->option('days'));

        Reservation::all()->each(function (Reservation $reservation) use ($counter, $deadline): void {
            $expiredBooks = $reservation->books()->whereDate('end_date', '<=', $deadline)->get();

            $counter->push($reservation->books()->detach($expiredBooks->pluck('id')));
        });

        $this->info("Done! {$counter->sum()} books were removed.");
    }
}
