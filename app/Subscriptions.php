<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Subscriptions
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $stripe_id
 * @property string $stripe_status
 * @property string|null $stripe_plan
 * @property int|null $quantity
 * @property string|null $trial_ends_at
 * @property string|null $ends_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereStripePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereStripeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriptions whereUserId($value)
 * @mixin \Eloquent
 */
class Subscriptions extends Model
{
    //
}
