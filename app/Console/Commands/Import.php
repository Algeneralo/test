<?php

namespace App\Console\Commands;

use App\Models\Importer\Ingredients;
use App\Models\Scata\HasIngredientGroups;
use App\Models\Scata\Ingredient;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class Import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scannel:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import from Scata';

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

        $counter = 0;
        $finished = 0;
        $skipped = 0;


        $counter1 = 0;
        $imported = [];

        //$ingredients = Ingredients::where('id', '>=', '871711')->limit(10)->get();
        //->where('type', 'food')->orWhere('type', 'cosmetics')

        $ingredients = Ingredient::where('name', 'like', '%?%')->get();

        $counter = $ingredients->count();

        foreach ($ingredients as $ingredient) {

            if(strpos($ingredient->name['de'], '?')) {

                $this->info($ingredient->name['de']);

            }

            //$this->info($counter1 . ' of ' . $counter . ' done');

        }

        /*$this->info($ingredients->count());

        $insertIngredients = [];

        foreach ($ingredients as $ingredient) {

            $counter++;

            $this->info('Start Import of: ' . $ingredient->id);

            if (!Ingredient::where('id', $ingredient->id)->first()) {

                if ($ingredient->products()->count() && $ingredient->names()->count() && ($ingredient->type == "food" || $ingredient->type == "cosmetics")) {

                    $newName = [];
                    $dec = [];


                    if ($ingredient->names()->count()) {

                        foreach ($ingredient->names()->get() as $name) {
                            $newName[$name->lang] = utf8_decode($name->name);
                            $dec[$name->lang] = utf8_decode($name->descr);
                        }

                        //print_r($newName);


                    }


                    array_push($insertIngredients, [
                        'id' => $ingredient->id,
                        'slug' => Str::slug($newName[array_key_first($newName)]),
                        'type' => $ingredient->type,
                        'name' => $newName,
                        'description' => $dec
                    ]);

                    $ingredientdb = new Ingredient;

                    $ingredientdb->id = $ingredient->id;
                    if (count($newName)) {
                        $ingredientdb->slug = Str::slug($newName[array_key_first($newName)]);
                    }
                    $ingredientdb->type = $ingredient->type;
                    $ingredientdb->name = $newName;
                    $ingredientdb->description = $dec;

                    $ingredientdb->save();

                    foreach ($ingredient->groups()->get() as $group) {

                        $ingredientGroup = new HasIngredientGroups;

                        $ingredientGroup->ingredient_group_id = $group->id;
                        $ingredientGroup->hasIngredientGroup_type = "App\Models\Scata\Ingredient";
                        $ingredientGroup->hasIngredientGroup_id = $ingredientdb->id;

                        $ingredientGroup->save();

                    }

                }

                $finished++;
                $this->info('Import finished for: ' . $ingredient->id);

            } else {
                $skipped++;
                $this->warn('Import Skipped for: ' . $ingredient->id);

            }

        }*/

        $this->info('Totel: ' . $counter . ' / Finished: ' . $finished . ' / Skipped: ' . $skipped);

    }
}
