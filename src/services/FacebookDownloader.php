<?php

namespace AdrHumphreys\FacebookUploader\Services;

use SilverStripe\Assets\Folder;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Controller\AssetAdmin;

class FacebookDownloader
{
    public static function createImage($url): Image
    {
        $folder = Folder::find_or_make('FacebookUploads');

        $contents = file_get_contents($url);

        $image = Image::create();
        $image->setFromString($contents, uniqid() . '.jpeg');
        $image->ParentID = $folder->ID;
        $image->write();

        AssetAdmin::create()->generateThumbnails($image);

        return $image;
    }
}
