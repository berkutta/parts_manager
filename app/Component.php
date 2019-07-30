<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Auth;

use Illuminate\Database\Eloquent\Builder;
use Spatie\SchemalessAttributes\SchemalessAttributes;

class Component extends Model
{
    protected $table = 'components';
    protected $fillable = ['name', 'datasheet', 'category', 'subcategory', 'package', 'supplier', 'description', 'stock'];

    use \Spatie\Tags\HasTags;
    use Searchable;

    public $asYouType = true;

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

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category,
            'description' => $this->description,
            'tags' => $this->tags()->pluck('slug')->implode(' '),
            'attribute_keys' => implode(' ', array_keys($this->extra_attributes->all()) ),
            'attribute_values' => implode(' ', array_values($this->extra_attributes->all()) ),
        ];
    }
}
