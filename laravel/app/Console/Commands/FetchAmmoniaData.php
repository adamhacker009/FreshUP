<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\SatelliteSource;
use App\Models\SatelliteFile;
use Carbon\Carbon;

class FetchAmmoniaData extends Command
{
    protected $signature = 'fetch:ammonia';
    protected $description = 'Fetch ammonia data from AIRS';

    public function handle()
    {
        $source = SatelliteSource::firstOrCreate([
            'name' => 'AIRS',
            'data_type' => 'nh3'
        ]);

        $date = now()->subDay()->format('Y-m-d');
        $bbox = '30,50,40,60';

        $response = Http::withBasicAuth(
            env('NASA_API_KEY'),
            ''
        )->get("https://acdisc.gesdisc.eosdis.nasa.gov/opendap/Aqua_AIRS_Level3/AIRS3STD.007/{$date}/AIRS.{$date}.L3.Std.HDF", [
            'vars' => 'NH3_Mixing_Ratio_Surrogate',
            'bbox' => $bbox,
        ]);

        if ($response->successful()) {
            $filePath = "satellite_data/airs_nh3_{$date}.hdf";
            Storage::put($filePath, $response->body());

            SatelliteFile::create([
                'source_id' => $source->id,
                'file_path' => $filePath,
                'status' => 'pending',
                'metadata' => [
                    'date' => $date,
                    'region' => $bbox,
                ],
            ]);

            $this->info("Ammonia data for {$date} saved!");
        } else {
            $this->error("Failed to fetch data: " . $response->status());
        }
    }
}
