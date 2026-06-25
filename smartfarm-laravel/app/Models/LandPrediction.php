<?php

   namespace App\Models;

   use Illuminate\Database\Eloquent\Factories\HasFactory;
   use Illuminate\Database\Eloquent\Model;

   class LandPrediction extends Model
   {
       use HasFactory;

       protected $fillable = [
           'user_id',
           'N',
           'P',
           'K',
           'temperature',
           'humidity',
           'ph',
           'rainfall',
           'recommended_crop',
           'cluster',
           'land_type',
       ];

       public function user()
       {
           return $this->belongsTo(User::class);
       }
   }
