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
    protected $signature = 'app:automatic-select-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Start automatic select command');
        $allPosts = $this->getCurrentSlotPosts();

        if ($allPosts) {
            Log::info('retrive all the posts for current post type', ['allPosts' => $allPosts]);
            $numberSums = $allPosts->groupBy('number')
                ->map(function (Collection $group) {
                    return $group->sum('amount');
                });

            Log::info('retrive the numberSums', ['numberSums' => $numberSums]);

            $selectedNumber = $this->getWinningNumber($numberSums);

            Log::info('retrive the selectedNumber', ['selectedNumber' => $selectedNumber]);

            try {
                DB::beginTransaction();

                $winner = new Winner();
                $winner->fill([
                    'number' => $selectedNumber,
                    'date' => Date::now()->format('Y-m-d'),
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

        $this->info('End automatic select command');
    }

    public function getCurrentSlotPosts()
    {
        $postTypes = PostType::whereTime('schedule_time', Date::now()->format('H:i'))->first();

        if ($postTypes) {
            Log::info('retrive current time post Types', ['postTypes' => $postTypes]);

            return $postTypes->posts()
                ->where('title', $postTypes->id)
                ->whereDate('date', Date::now()->format('Y-m-d'))
                ->get();
        }

        return;
    }

    public function getWinningNumber(Collection $amounts)
    {
        $minAmount = $amounts->min();
        $totalAmount = $amounts->sum();
        $payableAmount = $minAmount * 9;

        if ((float)$payableAmount <= (float)$totalAmount / 2) {
            return $amounts->search(function ($value) use ($minAmount) {
                return $value === $minAmount;
            });
        } else {
            $numbers = $amounts->keys();
            return collect(range(1, 100))->diff($numbers)->random();
        }
    }
}
