<?php

namespace App\Console\Commands;

use App\Models\PostType;
use App\Models\Post;
use App\Models\Winner;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AutomaticSelectCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:automatic-select-command {--date= : add custom date} {--time= : add custom time}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public $currentTime;

    public $currentDate;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Start automatic select command');

        $this->currentTime = $this->option('time') ?? Date::now()->format('H:i');
        $this->currentDate = $this->option('date') ?? Date::now()->format('Y-m-d');

        $allPosts = $this->getCurrentSlotPosts();

        if ($allPosts->count() > 0) {
            Log::info('retrive all the posts for current post type', ['allPosts' => $allPosts]);
            $numberSums = $allPosts->groupBy('number')
                ->map(function (Collection $group) {
                    return $group->sum('amount');
                });

            Log::info('retrive the numberSums', ['numberSums' => $numberSums]);

            $selectedNumber = $this->getWinningNumber($numberSums);

            Log::info('retrive the selectedNumber', ['selectedNumber' => $selectedNumber]);

            $postType = $allPosts->first()->title;
            $today = Date::today()->format('Y-m-d');
            $isWinnerExists = Winner::where(["post_type" => $postType, "date" => $today])->exists();

            if ($isWinnerExists) {
                Log::warning(
                    "Winner already declared",
                    ["winner" => $isWinnerExists, "post_type" => $postType, "date" => $today]
                );

                $this->info("Winner already declared");
                return 0;
            } else {
                try {
                    DB::beginTransaction();

                    $winner = new Winner();
                    $winner->fill([
                        'number' => $selectedNumber,
                        'date' => $this->currentDate,
                        'post_type' => $allPosts->first()->title,
                    ])->save();

                    Log::info('Winner data store successfully!', ['winner' => $winner]);

                    DB::commit();
                } catch (\Exception $e) {
                    Log::error('Error in Winner data store');
                    Log::error($e->getMessage());

                    DB::rollBack();
                }
            }
        }

        $this->info('End automatic select command');
    }

    public function getCurrentSlotPosts()
    {
        $postTypes = PostType::whereTime('schedule_time', $this->currentTime)->first();

        if ($postTypes) {
            Log::info('retrive current time post Types', ['postTypes' => $postTypes]);

            return $postTypes->posts()
                ->where('title', $postTypes->id)
                ->whereDate('date', $this->currentDate)
                ->get();
        }

        return;
    }

    public function getWinningNumber(Collection $amounts)
    {
        $minAmount = $amounts->min();
        $totalAmount = $amounts->sum();
        $payableAmount = $minAmount * 9;

        if ((float)$payableAmount <= (float)$totalAmount * config('settings.profit.percent')) {
            return $amounts->search(function ($value) use ($minAmount) {
                return $value === $minAmount;
            });
        } else {
            $numbers = $amounts->keys();
            return collect(range(1, 100))->diff($numbers)->random();
        }
    }
}
