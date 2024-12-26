<?php

namespace GIS\ContactPage\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use GIS\Metable\Facades\MetaActions;

class ContactController extends Controller
{
    public function page()
    {
        $metas = MetaActions::renderByPage("contacts");
        debugbar()->info($metas);
        return view("ctp::web.page", compact("metas"));
    }
}
