<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmissionUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,hdf,nc|max:51200',
        ]);

        $file = $request->file('file');
        $path = $file->store('uploads');
        $ext = $file->getClientOriginalExtension();

        $output = null;
        $status = null;
        exec("python3 " . base_path("app/scripts/parse_emissions.py") . " storage/app/$path $ext", $output, $status);

        if ($status !== 0) {
            return response()->json(['error' => 'Ошибка при обработке файла'], 500);
        }

        return response()->json(['message' => 'Файл успешно обработан']);
    }

    public function getLatestEmissions()
    {
        $jsonPath = storage_path('app/emissions.json');
        if (!file_exists($jsonPath)) {
            return response()->json(['error' => 'Нет данных'], 404);
        }

        return response()->file($jsonPath);
    }
}
