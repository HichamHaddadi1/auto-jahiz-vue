<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SplFileObject;
use Illuminate\Support\Str;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('csv/languages.csv');
        $csv = new SplFileObject($filePath, 'r');
        $csv->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
        $csv->setCsvControl(','); // Set the delimiter

        // Skip the header row
        $csv->current();

        // Iterate through each data row in the file

        foreach ($csv as $row) {
            if (!empty($row[0]) && !$this->languageCodeExists($row[0])) {
                // Insert the row into the database
                Language::create([
                    'id' => Str::uuid(),
                    'code' => $row[2],
                    'name' => $row[4],
                ]);
            }
        }
    }

    private function languageCodeExists($code): bool
    {
        return Language::where('code', $code)->exists();
    }
}
