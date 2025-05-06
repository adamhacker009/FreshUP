<?php

namespace App\Jobs;

use App\Models\AgriculturalEnterprise;
use App\Models\EmissionMetric;
use App\Models\SatelliteFile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class ProcessSatelliteFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public SatelliteFile $file)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $process = new Process([
            'python3',
            base_path('scripts/process_emissions.py'),
            Storage::path($this->file->file_path)
        ]);

        $process->run();

        if (!$process->isSuccessful()) {
            $this->file->update(['status' => 'failed']);
            return;
        }

        $data = json_decode($process->getOutput(), true);

        EmissionMetric::create([
            'enterprise_id' => $this->detectEnterprise($data),
            'file_id' => $this->file->id,
            'source' => 'satellite',
            'pollutant_type' => 'CO2',
            'value' => $data['value'],
            'measured_at' => $data['measured_at'],
        ]);

        $this->file->update(['status' => 'processed']);
    }
    private function detectEnterprise(array $data): int
    {
        return AgriculturalEnterprise::nearestTo(
            $data['latitude'], $data['longitude']
        )->first()->id;
    }
}
