<?php

namespace GIS\ContactPage\Models;

use GIS\ContactPage\Interfaces\ContactItemInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactItem extends Model implements ContactItemInterface
{
    protected $fillable = [
        "type",
        "value",
        "comment",
        "additionally"
    ];

    public function contact(): BelongsTo
    {
        $contactModel = config("contact-page.customContactModel") ?? Contact::class;
        return $this->belongsTo($contactModel, "contact_id");
    }
}
