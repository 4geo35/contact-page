<?php

namespace GIS\ContactPage\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use GIS\ContactPage\Models\Contact;
use GIS\Metable\Facades\MetaActions;

class ContactController extends Controller
{
    public function page()
    {
        $metas = MetaActions::renderByPage("contacts");
        $contactModelClass = config("contact-page.customContactModel") ?? Contact::class;
        $contacts = $contactModelClass::query()
            ->with("phones", "emails", "urls", "socials")
            ->orderBy("priority")
            ->get();
        return view("ctp::web.page", compact("metas", "contacts"));
    }
}
