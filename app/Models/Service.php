<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    // Ongeza mstari huu hapa chini
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'image',
        'description',
    ];

    /**
     * Uhusiano na Mafundi (Relationship)
     */
  // Ndani ya class Service extends Model
public function craftsmen()
{
    // Tunaiambia Laravel: "Nenda kwenye table ya Craftsmen, tafuta column ya skill_category, 
    // ilinganishe na column ya 'name' iliyopo hapa kwenye Service table."
    return $this->hasMany(\App\Models\Craftsmen::class, 'skill_category', 'name');
}
}