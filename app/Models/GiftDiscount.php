<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\GiftDiscount
 *
 * @method static \Illuminate\Database\Eloquent\Builder|GiftDiscount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GiftDiscount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GiftDiscount query()
 * @mixin \Eloquent
 */
class GiftDiscount extends Model
{
    protected $fillable = ['user_id'];
}
