<?php

namespace GIS\ContactPage\Events;

use GIS\ContactPage\Interfaces\ContactInterface;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public int $contactId,
    ) {}
}
