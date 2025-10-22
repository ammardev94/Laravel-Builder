<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CsvDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $csvDirectory = public_path('db');

        $seedingOrder = [
            'donor',
            'company',
            'family',
            'family_service',
            'student',
            'student_service',
            'health',
            'attendance',
        ];

        $foreignKeys = [
            'student_service' => [
                ['column' => 'student_id', 'reference_table' => 'student', 'reference_column' => 'id'],
            ],
            'health' => [
                ['column' => 'student_id', 'reference_table' => 'student', 'reference_column' => 'id'],
                ['column' => 'family_id', 'reference_table' => 'family', 'reference_column' => 'id'],
            ],
            'attendance' => [
                ['column' => 'student_id', 'reference_table' => 'student', 'reference_column' => 'id'],
            ],
        ];

        $numericLimits = [
            'donor_id'   => ['min' => 1, 'max' => 4294967295],
            'student_id' => ['min' => 1, 'max' => 4294967295],
            'family_id'  => ['min' => 1, 'max' => 4294967295],
        ];

        foreach ($seedingOrder as $tableName) {
            $filePath = $csvDirectory . '/' . $tableName . '.csv';

            if (!File::exists($filePath)) {
                $this->command->warn("⚠️ Skipped: {$tableName}, file not found.");
                continue;
            }

            $csv = fopen($filePath, 'r');
            if (!$csv) {
                $this->command->error("❌ Could not open: {$filePath}");
                continue;
            }

            $headers = fgetcsv($csv);
            if (!$headers) {
                fclose($csv);
                $this->command->warn("⚠️ Skipped: {$tableName}, no headers found.");
                continue;
            }

            $rows = [];
            $skippedCount = 0;

            while (($data = fgetcsv($csv)) !== false) {
                $row = [];

                foreach ($headers as $index => $header) {
                    $value = $data[$index] ?? null;

                    if (strtoupper($value) === 'NULL' || $value === '') {
                        $value = null;
                    }

                    $defaults = [
                        'pallor'           => 'N/A',
                        'lice'             => 'N/A',
                        'consciousness'    => 'N/A',
                        'diet'             => 'N/A',
                        'teeth'            => 'N/A',
                        'history'          => 'N/A',
                        'diagnosis'        => 'N/A',
                        'management'       => 'N/A',
                        'advice'           => 'N/A',
                        'refer'            => 'N/A',
                        'followup'         => 'N/A',
                        'session'          => 'N/A',
                        'created_on'       => now(),
                        'updated_on'       => now(),
                    ];

                    if (is_null($value) && array_key_exists($header, $defaults)) {
                        $value = $defaults[$header];
                    }

                    $row[$header] = $value;
                }

                // ✅ Numeric limits validation
                $numericError = false;
                foreach ($numericLimits as $col => $limits) {
                    if (isset($row[$col]) && is_numeric($row[$col])) {
                        $val = (int) $row[$col];
                        if ($val < $limits['min'] || $val > $limits['max']) {
                            $this->command->warn("⚠️ Skipped row in {$tableName}: {$col}={$val} out of range.");
                            $numericError = true;
                            $skippedCount++;
                            break;
                        }
                    }
                }
                if ($numericError) continue;

                // ✅ Foreign key validation
                if (isset($foreignKeys[$tableName])) {
                    $fkError = false;
                    foreach ($foreignKeys[$tableName] as $fk) {
                        $col = $fk['column'];
                        $refTable = $fk['reference_table'];
                        $refCol = $fk['reference_column'];

                        if (!isset($row[$col]) || !$this->foreignKeyExists($refTable, $refCol, $row[$col])) {
                            $this->command->warn("⚠️ Skipped row in {$tableName}: FK constraint failed for {$col} = {$row[$col]}");
                            $fkError = true;
                            $skippedCount++;
                            break;
                        }
                    }
                    if ($fkError) continue;
                }

                $rows[] = $row;
            }

            fclose($csv);

            if (!empty($rows)) {
                foreach (array_chunk($rows, 500) as $chunk) {
                    DB::table($tableName)->insert($chunk);
                }

                $this->command->info("✅ Seeded: {$tableName} (inserted: " . count($rows) . ", skipped: {$skippedCount})");
            } else {
                $this->command->warn("⚠️ Skipped: {$tableName}, no valid data found.");
            }
        }
    }

    protected function foreignKeyExists(string $table, string $column, $value): bool
    {
        return DB::table($table)->where($column, $value)->exists();
    }
}



