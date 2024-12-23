<?php

namespace GIS\ContactPage\Models;

use GIS\ContactPage\Interfaces\ContactInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model implements ContactInterface
{
    const DAYS = ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"];

    protected $fillable = [
        "title",
        "address",
        "description",
        "latitude",
        "longitude",
        "ico",
    ];

    protected $casts = [
        "work_time" => "array"
    ];

    public function getWorkTimesAttribute(): array
    {
        $times = $this->work_time;
        if (empty($times)) {
            $times = [];
            for ($i = 0; $i < 7; $i++) {
                $times[$i] = [
                    "workTime" => "",
                    "dinerTime" => "",
                    "name" => self::DAYS[$i],
                    "number" => $i,
                    "holiday" => $i > 4,
                ];
            }
        }
        return $times;
    }

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
