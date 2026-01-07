<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportProductsCsvJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public $path) {}

    public function handle()
    {
        DB::disableQueryLog();
        set_time_limit(0);

        $file = fopen(Storage::path($this->path), 'r');

        $batch = [];
        $chunkSize = 1000;
        $row = 0;

        while (($data = fgetcsv($file, 0, ',')) !== false) {

            if ($row++ == 0) continue; 

            $name = trim($data[0]);

            $batch[] = [
                'name' => $name,
                'slug' => Str::slug($name).'-'.uniqid(),
                'description' => $data[1] ?? null,
                'price' => $data[2] ?? 0,
                'image' => !empty($data[3]) ? $data[3] : 'images/default-product.png',
                'category_id' => $data[4],
                'stock' => $data[5] ?? 0,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($batch) >= $chunkSize) {
                DB::table('products')->insert($batch);

                Log::info('Inserted product chunk', ['rows' => count($batch)]);
                $batch = [];
            }
        }

        if (!empty($batch)) {
            DB::table('products')->insert($batch);
            Log::info('Inserted final product chunk', ['rows' => count($batch)]);
        }

        fclose($file);
    }
}
