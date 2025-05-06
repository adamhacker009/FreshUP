<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class FetchAmmoniaData extends Command
{
    protected $signature = 'fetch:ammonia {date?}';
    protected $description = 'Загружает HDF-файл аммиака с Earthdata';

    public function handle()
    {
        $date = $this->argument('date')
            ? Carbon::parse($this->argument('date'))
            : now();

        $year = $date->year;
        $dayOfYear = str_pad($date->dayOfYear, 3, '0', STR_PAD_LEFT);

        $filename = "AIRSAC3MNH3.{$year}{$dayOfYear}.L3.hdf";
        $url = "https://data.gesdisc.earthdata.nasa.gov/data/Aqua_AIRS_Level3/AIRSAC3MNH3.003/{$year}/{$dayOfYear}/{$filename}";

        $this->info("Попытка загрузки: {$url}");

        $response = Http::withBasicAuth(
            env('EARTHDATA_USERNAME'),
            env('EARTHDATA_PASSWORD')
        )->get($url);

        if ($response->successful()) {
            Storage::put("satellite_data/{$filename}", $response->body());
            $this->info("Файл успешно сохранён: satellite_data/{$filename}");
        } else {
            $this->error("Ошибка загрузки: HTTP {$response->status()}");
        }
    }
}
