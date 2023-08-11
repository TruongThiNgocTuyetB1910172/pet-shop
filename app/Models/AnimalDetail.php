<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AnimalDetail extends Model
{
    use HasFactory;

    protected $table = 'animal_details';

    protected $fillable = [
        'variant',
        'weight',
        'animal_id',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(AnimalDetail::class,'animal_services','animal_detail_id','service_id')
            ->withTimestamps();;
    }

    public static function getAnimalDetailById(string $id): Model|Collection|Builder|array|null
    {
        return AnimalDetail::query()->findOrFail($id);
    }
}
