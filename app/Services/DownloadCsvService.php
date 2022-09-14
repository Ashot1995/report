<?php


namespace App\Services;


use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadCsvService
{
    /**
     * @param $data
     * @param $filename
     * @return BinaryFileResponse
     */
    public function download($data, $filename)
    {

        $headers = [
             'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
             'Content-type' => 'text/csv',
             'Content-Disposition' => 'attachment; filename=galleries.csv',
             'Expires' => '0',
             'Pragma' => 'public'
        ];

        return Response::download($data, $filename, $headers);
    }

}
