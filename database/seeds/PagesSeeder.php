<?php

use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("pages")->insert([
            [
                "name" => "users",
                "displayed_name" => "Mitarbeiter",
            ],
            [
                "name" => "groups",
                "displayed_name" => "Gruppen",
            ],
            [
                "name" => "roles",
                "displayed_name" => "Rollen",
            ],
            [
                "name" => "app_users",
                "displayed_name" => "Nutzer",
            ],
            [
                "name" => "newsletter",
                "displayed_name" => "Newsletter",
            ],
            [
                "name" => "products_food",
                "displayed_name" => "(Produkte) Lebensmittel",
            ],
            [
                "name" => "products_cosmetics",
                "displayed_name" => "(Produkte) Kosmetika",
            ],
            [
                "name" => "products_feed",
                "displayed_name" => "(Produkte) Futtermittel",
            ],
            [
                "name" => "products_cleanser",
                "displayed_name" => "(Produkte) Reinigungsmittel",
            ],
            [
                "name" => "ingredients_food",
                "displayed_name" => "(Ingredienz) Lebensmittel",
            ],
            [
                "name" => "ingredients_cosmetics",
                "displayed_name" => "(Ingredienz) Kosmetika",
            ],
            [
                "name" => "ingredients_feed",
                "displayed_name" => "(Ingredienz) Futtermittel",
            ],
            [
                "name" => "ingredients_cleanser",
                "displayed_name" => "(Ingredienz) Reinigungsmittel",
            ],
            [
                "name" => "ingredientgroups_food",
                "displayed_name" => "(Ingredienz-Gruppen) Lebensmittel",
            ],
            [
                "name" => "ingredientgroups_cosmetics",
                "displayed_name" => "(Ingredienz-Gruppen) Kosmetika",
            ],
            [
                "name" => "ingredientgroups_feed",
                "displayed_name" => "(Ingredienz-Gruppen) Futtermittel",
            ],
            [
                "name" => "ingredientgroups_cleanser",
                "displayed_name" => "(Ingredienz-Gruppen) Reinigungsmittel",
            ],
            [
                "name" => "producers",
                "displayed_name" => "Hersteller",
            ],
            [
                "name" => "qualities",
                "displayed_name" => "Gütesiegel",
            ],
            [
                "name" => "openproducts_food",
                "displayed_name" => "(Offene Produkte) Lebensmittel",
            ],
            [
                "name" => "openproducts_cosmetics",
                "displayed_name" => "(Offene Produkte) Kosmetika",
            ],
            [
                "name" => "openproducts_feed",
                "displayed_name" => "(Offene Produkte) Futtermittel",
            ],
            [
                "name" => "openproducts_cleanser",
                "displayed_name" => "(Offene Produkte) Reinigungsmittel",
            ], [
                "name" => "scata_products_food",
                "displayed_name" => "(Scata-Produkte) Lebensmittel",
            ],
            [
                "name" => "scata_products_cosmetics",
                "displayed_name" => "(Scata-Produkte) Kosmetika",
            ],
            [
                "name" => "scata_products_feed",
                "displayed_name" => "(Scata-Produkte) Futtermittel",
            ],
            [
                "name" => "scata_products_cleanser",
                "displayed_name" => "(Scata-Produkte) Reinigungsmittel",
            ],
            [
                "name" => "bot_products_food",
                "displayed_name" => "(Bot Produkte) Lebensmittel",
            ],
            [
                "name" => "bot_products_cosmetics",
                "displayed_name" => "(Bot Produkte) Kosmetika",
            ],
            [
                "name" => "bot_products_feed",
                "displayed_name" => "(Bot Produkte) Futtermittel",
            ],
            [
                "name" => "bot_products_cleanser",
                "displayed_name" => "(Bot Produkte) Reinigungsmittel",
            ],
        ]);
    }
}
