<?php

namespace App\Modules\Speakers\Models;

use App\Modules\Sessions\Models\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Rutorika\Sortable\SortableTrait;

class Speaker extends Model
{
    use SoftDeletes,
        SortableTrait;

    protected $fillable = [
        'position',
        'name',
        'job_title',
        'job_description',
        'bio',
        'image',
        'questionable',
        'agendable',
        'day',
    ];

    public function sessions()
    {
        return $this->belongsToMany(Session::class)->withPivot('host', 'id');
    }

    public static function getSelectOptions(): array
    {
        return self::questionable()->pluck('name', 'name')->prepend('All', 'All')->toArray();
    }

    public function getImage()
    {
        if($this->image !== null && file_exists(public_path($this->image))){
            return $this->image;
        }else{
            return 'img/speakers/no-image.png';
        }
    }

    public function scopeAgendable($query)
    {
        return $query->where('agendable', 1);
    }

    public function scopeQuestionable($query)
    {
        return $query->where('questionable', 1);
    }

    public function scopeByDay($query, $day)
    {
        return $query->where('day', $day);
    }
}
