<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\User;

class Article extends Model
{
    use HasFactory;


     /**
     * Get the user that wrote the article.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the tags as an array.
     */
    protected function tags(): Attribute
    {
        return Attribute::make(
            get: fn (string $json) => json_decode($json),
        );
    }


}
