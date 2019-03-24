<?php
namespace  Concrete\Package\TwitterPush\Src;
use Concrete\Core\Http\ServerInterface;
use Concrete\Core\Package\Package;
use Database;
use Core;
use Events;
use Log;
use Loader;
use Concrete\Core\Page\Collection\Collection;
use Concrete\Core\Page\Page;
use Whoops\Exception\ErrorException;

class Push {

    public function pageAdd($event)
    {

    $p = $event->getPageObject();
    $p_on = $p->getAttribute('push_to_twitter');


    if ($p_on ==1) {

        $p_name = $p->getCollectionName();
        $p_url = \URL::to($p);

        $pkg = Package::getByHandle('twitter_push');
        $consumerKey = $pkg->getConfig()->get('settings.twitter_push.consumerKey');
        $consumerSecret = $pkg->getConfig()->get('settings.twitter_push.consumerSecret');
        $accessToken = $pkg->getConfig()->get('settings.twitter_push.accessToken');
        $accessTokenSecret = $pkg->getConfig()->get('settings.twitter_push.accessTokenSecret');
        $messageString = $pkg->getConfig()->get('settings.twitter_push.messageString');
        
        require_once $pkg->getPackagePath() . "/vendor/dg/twitter-php/src/Twitter.php";
        
        $twitter = new \Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

        if (!$twitter->authenticate()) {
            Log::addInfo('not authenticated');
            die('Invalid name or password');
            } else {
                $twitter->send($messageString .' '. $p_name . ' ' . $p_url);
            }

        } else {

        }
    }
}	




