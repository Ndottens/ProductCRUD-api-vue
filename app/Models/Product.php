<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'image',
        'category_id',
        'created_at'
    ];

    /**
     * @var string[]
     */
    protected $with = [
        'category'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
       return $this->belongsTo(Category::class);
    }

    public static function boot() {

        parent::boot();

        static::deleting(function ($product) {
            unlink(public_path().'/storage/'. $product->image);
        });
    }
}
