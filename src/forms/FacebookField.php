<?php

namespace AdrHumphreys\FacebookUploader\Forms;

use SilverStripe\Core\Environment;
use SilverStripe\Forms\FileUploadReceiver;
use SilverStripe\Forms\FormField;
use SilverStripe\View\Requirements;

class FacebookField extends FormField
{
    public function __construct($name, $title = null, $value = null)
    {
        parent::__construct($name, $title = null, $value = null);

        $appId = Environment::getEnv('FACEBOOK_UPLOADER_APP_ID');
        $this->setAttribute('FACEBOOK_APP_ID', $appId);
    }
}
