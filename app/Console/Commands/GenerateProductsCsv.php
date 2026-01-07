<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateProductsCsv extends Command
{
    protected $signature = 'products:generate-csv';

    protected $description = 'Generate sample products CSV file for bulk import testing';

    public function handle()
    {
        $path = storage_path('app/products_sample_import.csv');

        $file = fopen($path, 'w');

        fputcsv($file, ['name','description','price','image','category_id','stock']);

        for ($i = 1; $i <= 1000000; $i++) {
            fputcsv($file, [
                "Product $i",
                "Demo description for product $i",
                100 + ($i * 1.5),
                "",                
                ($i % 5) + 1,      
                rand(1, 200),
            ]);
        }

        fclose($file);

        $this->info('✅ products_sample_import.csv generated successfully!');
        $this->info('📄 Location: storage/app/products_sample_import.csv');

        return Command::SUCCESS;
    }
}
