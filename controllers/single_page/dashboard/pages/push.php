<?php
namespace Concrete\Package\TwitterPush\Controller\SinglePage\Dashboard\Pages;

use Concrete\Package\TwitterPush;
use Concrete\Core\Page\Controller\DashboardPageController;
use Core;
use Package;
use Concrete\Core\Routing\Redirect;
use Concrete\Core\Page\Single as SinglePage;

defined('C5_EXECUTE') or die("Access Denied.");
class Push extends DashboardPageController
{

    public function view() {  
        $pkg = Package::getByHandle('twitter_push');
        $consumerKey = $pkg->getConfig()->get('settings.twitter_push.consumerKey');
        $consumerSecret = $pkg->getConfig()->get('settings.twitter_push.consumerSecret');
        $accessToken = $pkg->getConfig()->get('settings.twitter_push.accessToken');
        $accessTokenSecret = $pkg->getConfig()->get('settings.twitter_push.accessTokenSecret');
        $messageString = $pkg->getConfig()->get('settings.twitter_push.messageString');
        
        $this->set('consumerKey', $consumerKey);
        $this->set('consumerSecret', $consumerSecret);
        $this->set('accessToken', $accessToken);
        $this->set('accessTokenSecret', $accessTokenSecret);
        $this->set('messageString', $messageString);
  
    }

    public function update_configuration() {
      
      if (!$this->token->validate('perform_update_configuration')) {
            $this->flash('error', $this->token->getErrorMessage());

            return Redirect::to('/dashboard/push');
        }
        
        if ($this->isPost()) {
           $consumerKey = $this->post('consumerKey');
           $consumerSecret = $this->post('consumerSecret');
           $accessToken = $this->post('accessToken');
           $accessTokenSecret = $this->post('accessTokenSecret');
           $messageString = $this->post('messageString');
               
           $pkg = Package::getByHandle('twitter_push');
           $pkg->getConfig()->save('settings.twitter_push.consumerKey', $consumerKey);
           $pkg->getConfig()->save('settings.twitter_push.consumerSecret', $consumerSecret);
           $pkg->getConfig()->save('settings.twitter_push.accessToken', $accessToken);
           $pkg->getConfig()->save('settings.twitter_push.accessTokenSecret', $accessTokenSecret);
           $pkg->getConfig()->save('settings.twitter_push.messageString', $messageString);
                    
           $this->set('message', t("Configuration saved"));
        }

        $this->view();
        
      }
    public function config_saved() {
        $this->set('message', t("Configuration saved"));
        $this->view();
    }
}
?>
