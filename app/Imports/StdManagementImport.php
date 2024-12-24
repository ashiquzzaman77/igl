<?php

namespace App\Imports;

use App\Models\StdManagement;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class StdManagementImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            // $customer = StdManagement::where('email', $row['email'])->first();

            // if ($customer) {

            //     $customer->update([
            //         'name' => $row['Name'],
            //         'phone' => $row['phone'],
            //     ]);

            // } else {

            //     StdManagement::create([
            //         'name' => $row['name'],
            //         'email' => $row['email'],
            //         'phone' => $row['phone'],
            //     ]);
            // }

            if ($rows->isNotEmpty()) {
                $headings = $rows->first()->keys(); // Get the keys of the first row
                // Log::info('Excel Headings: ' . implode(', ', $headings->toArray()));
            }

            // Log data of the third row (if it exists)
            // if ($rows->count() >= 10) { // Ensure the collection has at least 3 rows
            //     $thirdRow = $rows->get(10); // Get the third row (index 2)
            //     Log::info('Third Row Data: ' . json_encode($thirdRow));
            // } else {
            //     Log::info('Third row does not exist.');
            // }


            $emails = [];
            $captureEmails = false;

            foreach ($rows as $row) {
                if (isset($row['2']) && $row['2'] === 'Name') {
                    $captureEmails = true; // Start capturing emails
                    continue;
                }

                if ($captureEmails && isset($row['2'])) {
                    // Extract the email from the row's additional fields
                    preg_match('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', implode(' ', $row->toArray()), $matches);

                    if (!empty($matches)) {
                        $emails[] = $matches[0]; // Save the matched email
                    }
                }
            }

            // Log the extracted emails
            Log::info('Extracted Emails: ' . implode(', ', $emails));



        }
    }
}
