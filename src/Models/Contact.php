<?php

namespace GIS\ContactPage\Models;

use GIS\ContactPage\Interfaces\ContactInterface;
use Illuminate\Database\Eloquent\Model;

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
}
