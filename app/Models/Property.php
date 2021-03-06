<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Property extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    protected $guarded = [];
    protected $extends = [
        'hrta',
        'trta',
        'tla',
        'hla'
    ];
    public function tenant()
    {
        return $this->belongsTo(User::class,'tenant_id','id');
    }
    public function household()
    {
        return $this->belongsTo(User::class,'household_id','id');
    }
    public function getTrtaAttribute()
    {
        return $this->getMedia('trta')->last();
    }
    public function getHrtaAttribute()
    {
        return $this->getMedia('hrta')->last();
    }
    public function getHlaAttribute()
    {
        return $this->getMedia('hla')->last();
    }
    public function getTlaAttribute()
    {
        return $this->getMedia('tla')->last();
    }
}
