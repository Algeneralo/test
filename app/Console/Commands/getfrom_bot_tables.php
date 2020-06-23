<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Bot\Bot_Product;
use App\Models\Scannel\Product;
use Carbon\Carbon;

class getfrom_bot_tables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getfrombot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get data from bot_tables';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $results = Bot_Product::where('productType','food')
            ->whereNull('transfer')
            ->where('ingredients', '<>', '')
            ->limit(10)
            ->get();

        foreach($results as $onebot_produkt) { 
            echo "\nid: ". $onebot_produkt->id;
            /*
            $product = new Product;
            $product->name                  = $onebot_produkt->display_name;
            $product->regulated_name        = $onebot_produkt->regulated_name;
            $product->ean                   = $onebot_produkt->ean;
            $product->pzn                   = $onebot_produkt->pzn;
            $product->ingredienz_text_orig  = $onebot_produkt->ingredients;
            $product->type                  = $onebot_produkt->productType;
            $product->src_type              = 'bot';
            $product->src_scan              = $onebot_produkt->source;
            $product->product_url           = $onebot_produkt->product_url;
            $product->bot_id                = $onebot_produkt->id;*/

            //company
            //allergene notes
            //picture

            //$product->save();
    
            //$onebot_produkt->tranfer = Carbon::now();
        }
        echo "get from bot\n";
        echo "anzahl: ".$results->count();
        //
    }
}
