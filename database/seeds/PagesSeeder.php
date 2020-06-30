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
                "displayed_name" => "Lebensmittel (Produkte)",
            ],
            [
                "name" => "products_cosmetics",
                "displayed_name" => "Kosmetika (Produkte)",
            ],
            [
                "name" => "products_feed",
                "displayed_name" => "Futtermittel (Produkte)",
            ],
            [
                "name" => "products_cleanser",
                "displayed_name" => "Reinigungsmittel (Produkte)",
            ],
            [
                "name" => "ingredients_food",
                "displayed_name" => "Lebensmittel (Ingredienz)",
            ],
            [
                "name" => "ingredients_cosmetics",
                "displayed_name" => "Kosmetika (Ingredienz)",
            ],
            [
                "name" => "ingredients_feed",
                "displayed_name" => "Futtermittel (Ingredienz)",
            ],
            [
                "name" => "ingredients_cleanser",
                "displayed_name" => "Reinigungsmittel (Ingredienz)",
            ],
            [
                "name" => "ingredientgroups_food",
                "displayed_name" => "Lebensmittel (Ingredienz-Gruppen)",
            ],
            [
                "name" => "ingredientgroups_cosmetics",
                "displayed_name" => "Kosmetika (Ingredienz-Gruppen)",
            ],
            [
                "name" => "ingredientgroups_feed",
                "displayed_name" => "Futtermittel (Ingredienz-Gruppen)",
            ],
            [
                "name" => "ingredientgroups_cleanser",
                "displayed_name" => "Reinigungsmittel (Ingredienz-Gruppen)",
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
                "displayed_name" => "Lebensmittel (Offene Produkte)",
            ],
            [
                "name" => "openproducts_cosmetics",
                "displayed_name" => "Kosmetika (Offene Produkte)",
            ],
            [
                "name" => "openproducts_feed",
                "displayed_name" => "Futtermittel (Offene Produkte)",
            ],
            [
                "name" => "openproducts_cleanser",
                "displayed_name" => "Reinigungsmittel (Offene Produkte)",
            ], [
                "name" => "scata_products_food",
                "displayed_name" => "Lebensmittel (Scata-Produkte)",
            ],
            [
                "name" => "scata_products_cosmetics",
                "displayed_name" => "Kosmetika (Scata-Produkte)",
            ],
            [
                "name" => "scata_products_feed",
                "displayed_name" => "Futtermittel (Scata-Produkte)",
            ],
            [
                "name" => "scata_products_cleanser",
                "displayed_name" => "Reinigungsmittel (Scata-Produkte)",
            ],
            [
                "name" => "bot_products_food",
                "displayed_name" => "Lebensmittel (Bot Produkte)",
            ],
            [
                "name" => "bot_products_cosmetics",
                "displayed_name" => "Kosmetika (Bot Produkte)",
            ],
            [
                "name" => "bot_products_feed",
                "displayed_name" => "Futtermittel (Bot Produkte)",
            ],
            [
                "name" => "bot_products_cleanser",
                "displayed_name" => "Reinigungsmittel (Bot Produkte)",
            ],
        ]);
    }
}
