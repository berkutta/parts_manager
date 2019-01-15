<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

use Illuminate\Database\Eloquent\Builder;
use Spatie\SchemalessAttributes\SchemalessAttributes;

class Component extends Model
{
    protected $table = 'components';
    protected $fillable = ['name', 'datasheet', 'category', 'subcategory', 'package', 'supplier', 'description', 'stock'];

    use \Spatie\Tags\HasTags;

    public $casts = [
        'extra_attributes' => 'array',
    ];

    public function getExtraAttributesAttribute(): SchemalessAttributes
    {
        return SchemalessAttributes::createForModel($this, 'extra_attributes');
    }

    public function scopeWithExtraAttributes(): Builder
    {
        return SchemalessAttributes::scopeWithSchemalessAttributes('extra_attributes');
    }

    public function storage() 
    {
        return $this->belongsTo('App\Storage');
    }

    public function save(array $options = array())
    {
        if( ! $this->user_id)
        {
            $this->user_id = Auth::user()->id;
        }

        parent::save($options);
    }
}
