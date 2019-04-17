<?php

namespace AdrHumphreys\FacebookUploader\Controllers;

use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Facebook\FacebookResponse;
use Facebook\GraphNodes\GraphAlbum;
use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Environment;


class FacebookController extends Controller
{
    /**
     * @var Facebook
     */
    private $fb;

    /**
     * @var string
     */
    private $accessToken;

    private static $allowed_actions = [
        'index',
        'login',
        'album'
    ];

    /**
     * @throws FacebookSDKException
     */
    public function init()
    {
        parent::init();

        $this->fb = $this->initFacebook();

        $session = $this->getRequest()->getSession();

        $this->accessToken = $session->get('fb_access_token');

        if(!$this->accessToken || strtotime($session->get('fb_access_token_expires')) < time()) {
            $helper = $this->fb->getJavaScriptHelper();
            $accessToken = $helper->getAccessToken();
            $this->accessToken = (string) $accessToken->getValue();
            $session->set('fb_access_token', $this->accessToken);
            $session->set('fb_access_token_expires', (int)$accessToken->getExpiresAt()->getTimestamp());
        }
    }

    public function login(HTTPRequest $request): string
    {
        return $this->fb
            ->get('me?fields=albums{name,count,cover_photo{picture}}', $this->accessToken)
            ->getBody();
    }

    public function album(HTTPRequest $request): string
    {
        $albumId = $request->getVar('album');
        return $this->fb
            ->get($albumId . '/?fields=photos{picture,images}', $this->accessToken)
            ->getBody();
    }

    public function initFacebook(): Facebook
    {
        $appId = Environment::getEnv('FACEBOOK_UPLOADER_APP_ID');
        $appSecret = Environment::getEnv('FACEBOOK_UPLOADER_APP_SECRET');
        
        return new Facebook([
            'app_id' => $appId,
            'app_secret' => $appSecret,
            'default_graph_version' => 'v3.2',
        ]);
    }
}
