<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class PushCategoriesToProject2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:push-categories-to-project2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push category data from Project 1 to Project 2 based on the specified time in the Project 1 category table.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Project 2 API endpoint URL
        $project2Url = 'http://project2.test/api/categories';

        // Get the current time
        $currentTime = Carbon::now();

        // Categories from Project 1 where the time field is less than or equal to the current time
        $categories = Category::where('time', '<=', $currentTime)->get();

        // Iterate through each category
        foreach ($categories as $category) {
            // Convert the 'time' field to a Carbon instance
            $time = Carbon::parse($category->time);

            // POST request to Project 2 to push the category data
            $response = Http::post($project2Url, [
                'name' => $category->name,
                'time' => $time->toDateTimeString(),
            ]);
        }

        // Output a success message
        $this->info('Categories pushed to Project 2 successfully.');
    }
}
