# SilverStripe Facebook Uploader

A field for uploading from Facebook

## Requirements

* SilverStripe ^4.0
* [Yarn](https://yarnpkg.com/lang/en/), [NodeJS](https://nodejs.org/en/) (6.x) and [npm](https://npmjs.com) (for building
  frontend assets)
* facebook/graph-sdk ^5.7

## Installation
After installing this module you'll need to set the following environment values:
- `FACEBOOK_UPLOADER_APP_ID`
- `FACEBOOK_UPLOADER_APP_SECRET` 

```
composer require adrhumphreys/facebook-uploader @dev
```

## Usage
You'll want to make a field e.g. `FacebookField::create('wow')`

This will show a button on the page that a user can click and then they will authenticate with facebook and be shown a list of albums. They can select an album then they're shown a list of images in that album. Once they select their image the section will hide and the chosen image will be displayed.

This has no styles applied, it's made with the intent of allowing whomever is using it to syle it how they see fit.

When a form is submitted you'll receive a URL from facebook for the image. To create the image simply use `FacebookDownloader::createImage($data['wow']);` which returns an `Image`

## License
Have at it champs, do anything with this


## Maintainers
Me, you, anyone? Make a PR and we'll smash it in
