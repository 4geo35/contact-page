<?php

namespace GIS\ContactPage\Interfaces;

use ArrayAccess;
use Illuminate\Database\Eloquent\Relations\HasMany;
use JsonSerializable;
use Stringable;
use Illuminate\Contracts\Broadcasting\HasBroadcastChannel;
use Illuminate\Contracts\Queue\QueueableEntity;
use Illuminate\Contracts\Routing\UrlRoutable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\CanBeEscapedWhenCastToString;
use Illuminate\Contracts\Support\Jsonable;

interface ContactInterface extends Arrayable, ArrayAccess, CanBeEscapedWhenCastToString,
    HasBroadcastChannel, Jsonable, JsonSerializable, QueueableEntity, Stringable, UrlRoutable
{
    public function items(): HasMany;
    public function phones(): HasMany;
    public function emails(): HasMany;
    public function sites(): HasMany;
    public function socials(): HasMany;
}
