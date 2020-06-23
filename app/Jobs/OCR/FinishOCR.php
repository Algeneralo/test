<?php

namespace App\Jobs\Ocr;

use App\Models\Scata\Ingredient;
use App\Models\Scata\Products\Product;
use App\Models\Scata\Products\ProductImage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FinishOCR implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $labels = [
        'Zutaten',
        'zutaten',
        'zutaten',
        'Zutaten',
        ':',
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '0',
        '(',
        ')',
        '%',
        '.'
    ];

    private $product;
    private $operationUrl;
    private $image;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ProductImage $image, $operationUrl)
    {

        $this->product = Product::find($image->product);
        $this->operationUrl = $operationUrl;
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
            'ocp-apim-subscription-key' => config('scannel.ocr.azure-cognitive-api.key'),
        ])->get($this->operationUrl);

        $result = $this->removeLabels($this->getTextFromStdClass($this->stdClassByOcrResult($httpResponse)));

        $ingredients = explode(',', $result);

        foreach ($ingredients as $ingredient) {

            $dbIngredient = Ingredient::firstOrCreate([
                'slug' => Str::slug($ingredient)
            ]);

            $dbIngredient->name = [
                'de' => $ingredient
            ];

            $dbIngredient->save();

            $this->product->addIngredient($dbIngredient);

        }


        $this->image->updated_at = Carbon::now();
        $this->image->save();

    }

    private function removeLabels($string)
    {
        return str_replace($this->labels,'',$string);
    }

    private function stdClassByOcrResult($result){

        list($header,$jsonResult) = explode('{', $result, 2);
        return json_decode('{' .$jsonResult);
    }

    private function getTextFromStdClass($stdResult){
        $text = '';
        foreach ($stdResult->recognitionResult->lines as $line) {
            $text .= " " . $line->text;
        }
        return trim($text);
    }

}
