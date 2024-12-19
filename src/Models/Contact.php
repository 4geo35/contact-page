<?php

namespace GIS\ContactPage\Models;

use GIS\ContactPage\Interfaces\ContactInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model implements ContactInterface
{
    protected $fillable = [
        "title",
        "address",
        "description",
        "latitude",
        "longitude",
        "ico",
    ];

    public function items(): HasMany
    {
        $itemModel = config("contact-page.customContactItemModel") ?? ContactItem::class;
        return $this->hasMany($itemModel, "contact_id");
    }

    public function phones(): HasMany
    {
        return $this->items()->where("type", "phone");
    }

    public function emails(): HasMany
    {
        return $this->items()->where("type", "email");
    }

    public function urls(): HasMany
    {
        return $this->items()->where("type", "url");
    }

    public function socials(): HasMany
    {
        return $this->items()->where("type", "social");
    }
}
