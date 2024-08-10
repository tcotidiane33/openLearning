<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Announcement extends Model
{
    use HasFactory;

    /**
     * Les attributs qui peuvent être assignés en masse.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'link',
        'is_published',
        'publish_at',
        'expire_at',
        'created_by',
    ];

    /**
     * Obtenir l'utilisateur qui a créé l'annonce.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Définir la valeur de l'attribut "created_by" automatiquement.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::id();
        });
    }

    public static function getLatestPublished()
{
    return self::where('is_published', true)
        ->where('publish_at', '<=', now())
        ->where(function ($query) {
            $query->where('expire_at', '>', now())->orWhereNull('expire_at');
        })
        ->latest('publish_at')
        ->first();
}
}
