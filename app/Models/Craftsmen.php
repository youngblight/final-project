<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Craftsmen extends Model
{
    use HasFactory;

    protected $table = 'craftsmen';

protected $fillable = [
    'user_id',
    'full_name',
    'phone',
    'skill_category',
    'location_name',
    'latitude',
    'longitude',
    'verification_doc',
    'profile_photo',
    'status', 
];
public function service()
{

return $this->belongsTo(Service::class, 'service_id');
 }
  public function jobRequests()
   {
    // Foreign key lazima iwe ile iliyopo kwenye table ya job_requests (craftsman_id)
    return $this->hasMany(JobRequest::class, 'craftsman_id');
   }

   public function jobs()
    {
    // Hakikisha jina la model ya kazi ni JobRequest au Assignment
    return $this->hasMany(JobRequest::class, 'craftsman_id'); 
    } 

// Uhusiano unaosema fundi huyu anamilikiwa na User fulani
public function user()
   {
    // Badilisha 'user_id' kama safu ya kiunganishi kwenye table yako ya craftsmen ina jina tofauti
    return $this->belongsTo(\App\Models\User::class, 'user_id'); 
   }
}