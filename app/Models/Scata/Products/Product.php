<?php

namespace App\Models\Scata\Products;

use App\Models\Admins\Admin;
use App\Models\Scata\Ingredient;
use App\Models\Scata\Nutrients\NutrientGroup;
use App\Models\Scata\Producer;
use App\Models\Scata\QualitySeal;
use App\Models\Scata\Shop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'original_url',
        'type',
        'status',
        'netcontentVal',
        'netcontentUnit',
        'grossweightVal',
        'grossweightUnit',
        'netweightVal',
        'netweightUnit',
        'import_status',
        'import_count',
        'shop_id',
        'pzn',
        'bot_id',
        'src_type',
        'product_url',
        'regulated_name',
        'product_name',
        'bot_scan_source',
        'ingredienz_text_orig'

    ];

    // Product Images

    public function images() {

        return $this->hasMany(ProductImage::class, 'product_id', 'product_id');

    }

    // Product EAN

    public function eans() {
        return $this->hasMany(ProductEan::class, 'product_id', 'product_id');
    }

    // Ingredients

    public function ingredients() {

        return $this->morphToMany(Ingredient::class, 'hasIngredient');

    }

    public function createdBy() {

        return $this->hasOne(Admin::class, 'admin_id', 'admin_id');

    }

    public function removeIngredient(Ingredient $ingredient) {

        $this->ingredients()->detach($ingredient->id);

    }

    public function addIngredient(Ingredient $ingredient) {

        $this->ingredients()->attach($ingredient->id);

    }

    public function syncIngredient($ingredients) {

        $this->ingredients()->sync($ingredients);

    }

    // Quality Seals

    public function qualitySeals() {

        return $this->morphToMany(QualitySeal::class, 'hasQualitySeal');

    }

    public function removeQualitySeals(QualitySeal $qualitySeal) {

        $this->qualitySeals()->detach($qualitySeal->id);

    }

    public function addQualitySeals(QualitySeal $qualitySeal) {

        $this->qualitySeals()->attach($qualitySeal->id);

    }

    public function syncQualitySeals($qualitySeal) {

        $this->qualitySeals()->sync($qualitySeal);

    }

    // Producers

    public function producer() {

        return $this->morphToMany(Producer::class, 'hasProducer');

    }

    public function setProducer(Producer $producer) {

        $this->producer()->each(function($producerOld) {

            $this->producer()->detach($producerOld->id);

        });

        $this->producer()->attach($producer->id);

    }
    // Shop

    public function shop() {

        return $this->hasOne(Shop::class, 'shop_id', 'shop_id');

    }

    // Nutrients

    public function nutrients() {

        return $this->hasMany(NutrientGroup::class, 'product_id', 'product_id');

    }

}
