<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SplFileObject;
use Illuminate\Support\Str;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('csv/currencies.csv');
        $csv = new SplFileObject($filePath, 'r');
        $csv->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
        $csv->setCsvControl(','); // Set the delimiter

        // Skip the header row
        $csv->current();

        // Iterate through each data row in the file

        foreach ($csv as $row) {
            if (!empty($row[0]) && !$this->currencyCodeExists($row[0])) {
                // Insert the row into the database
                Currency::create([
                    'id' => Str::uuid(),
                    'code' => $row[0],
                    'name' => $row[2],
                    'symbol' => $row[4],
                ]);
            }
        }
    }

    private function currencyCodeExists($code): bool
    {
        return Currency::where('code', $code)->exists();
    }
}
