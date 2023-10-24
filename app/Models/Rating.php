<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rating extends Model
{
    use SoftDeletes, MultiTenantModelTrait, Auditable, HasFactory;

    public $table = 'ratings';

    public static $searchable = [
        'stars',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'stars',
        'created_at',
        'book_id',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    public const STARS_SELECT = [
        '0.25' => '0.25',
        '0.5'  => '0.5',
        '0.75' => '0.75',
        '1'    => '1',
        '1.25' => '1.25',
        '1.5'  => '1.5',
        '1.75' => '1.75',
        '2'    => '2',
        '2.25' => '2.25',
        '2.5'  => '2.5',
        '2.75' => '2.75',
        '3'    => '3',
        '3.25' => '3.25',
        '3.5'  => '3.5',
        '3.75' => '3.75',
        '4'    => '4',
        '4.25' => '4.25',
        '4.5'  => '4.5',
        '4.75' => '4.75',
        '4.9'  => '4.9',
        '5'    => '5',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
