<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Book extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'books';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const LANGUAGE_SELECT = [
        'French'  => 'French',
        'Arabic'  => 'Arabic',
        'English' => 'English',
    ];

    public static $searchable = [
        'title',
        'author',
        'notes_and_description',
        'language',
        'isbn',
        'publisher',
    ];

    protected $fillable = [
        'title',
        'author',
        'genres_id',
        'notes_and_description',
        'language',
        'isbn',
        'publisher',
        'created_at',
        'status_id',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function genres()
    {
        return $this->belongsTo(BookGenresAndCategory::class, 'genres_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
