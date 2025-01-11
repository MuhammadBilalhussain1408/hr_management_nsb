<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_date', 'to_date','organization_id','holiday_type_id','num_of_day','day','body','slug'
    ];
    public function holiday_types()
    {
        return $this->belongsTo(HolidayType::class,'holiday_type_id');
    }
}
