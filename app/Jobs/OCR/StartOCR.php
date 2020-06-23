<?php

namespace App\Jobs\OCR;

use App\Models\Scata\Products\ProductImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class StartOCR implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $apiUrl = 'https://westeurope.api.cognitive.microsoft.com/vision/v2.0/recognizeText?mode=Printed';
    private $image;
    private $operationLocation;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ProductImage $image)
    {
        $this->image = $image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $httpResponse = Http::withHeaders([
            'cache-control' => 'no-cache',
            'content-type' => 'application/json',
            'Ocp-Apim-Subscription-Key' => config('scannel.ocr.azure-cognitive-api.key'),
            'orientation' => 'Up',
        ])->post($this->apiUrl, [
            'url' => $this->image->imageUrl
        ]);

        if ($httpResponse->status() === 202) {

            $this->operationLocation = $httpResponse->header('Operation-Location');

            FinishOCR::dispatch($this->image, $this->operationLocation)->delay(now()->addSeconds(15));

        }

        if ($httpResponse->status() === 401) {

            print_r($httpResponse->body());

        }


    }
}
