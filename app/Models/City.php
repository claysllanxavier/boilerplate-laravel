<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state_id', 'title', 'iso', 'iso_ddd',
        'status', 'slug', 'population',
        'lat', 'long', 'income_per_capita'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Scope a query to state.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeState($query)
    {
        return $query->select(
            'cities.*',
            'states.title as state',
            'states.letter as letter'
        )
            ->join('states', 'states.id', '=', 'cities.state_id');
    }
}
