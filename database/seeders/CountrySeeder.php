<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = public_path('country.csv');
        $countries = $this->getCountriesFromCSV($csvFile);

        foreach ($countries as $countryName) {
            $country = new Country();
            $country->name = $countryName;
            $country->save();
        }
    }

    private function getCountriesFromCSV($csvFile)
    {
        $countries = [];

        if (($handle = fopen($csvFile, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $countries[] = $data[0];
            }
            fclose($handle);
        }

        return $countries;
    }
}
