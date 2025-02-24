<?php

namespace GIS\ContactPage\Models;

use GIS\ContactPage\Interfaces\ContactInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contact extends Model implements ContactInterface
{
    const DAYS = ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота", "Воскресенье"];

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

    public function getDayGroupsAttribute(): array
    {
        $groups = [];
        if (! empty($this->work_time)) {
            $start = false;
            $time = false;
            $prev = false;
            $dinerTime = false;
            foreach ($this->work_time as $day) {
                if (! $start) {
                    $start = $day['name'];
                    $time = $day['workTime'];
                    $dinerTime = $day['dinerTime'];
                }
                if ($day['workTime'] == $time && $day['dinerTime'] == $dinerTime) {
                    $prev = $day['name'];
                    continue;
                }
                $groups[] = [
                    'start' => $start,
                    'end' => $prev,
                    'time' => $time,
                    'dinerTime' => $dinerTime,
                ];
                $time = $day['workTime'];
                $prev = $start = $day['name'];
                $dinerTime = $day['dinerTime'];
            }
            $groups[] = [
                'start' => $start,
                'end' => $prev,
                'time' => $time,
                'dinerTime' => $dinerTime,
            ];
        }
        return $groups;
    }

    public function items(): HasMany
    {
        $itemModel = config("contact-page.customContactItemModel") ?? ContactItem::class;
        return $this->hasMany($itemModel, "contact_id");
    }

    public function phones(): HasMany
    {
        return $this->items()->where("type", "phone")->orderBy("priority");
    }

    public function emails(): HasMany
    {
        return $this->items()->where("type", "email")->orderBy("priority");
    }

    public function urls(): HasMany
    {
        return $this->items()->where("type", "url")->orderBy("priority");
    }

    public function socials(): HasMany
    {
        return $this->items()->where("type", "social")->orderBy("priority");
    }
}
