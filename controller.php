<?php
namespace Concrete\Package\TwitterPush;

use Package;
use SinglePage;
use Core;
use Events;
use Concrete\Core\Entity\Attribute\Key\PageKey;

class Controller extends Package {
	protected $pkgHandle = 'twitter_push';
	protected $appVersionRequired = '5.7.5';
	protected $pkgVersion = '0.0.5';


	public function getPackageDescription () {
		return t("Push to Twitter");
	}

	public function getPackageName () {
		return t("Twitter Push");
	}

	public function install () {

		$pkg = parent::install();
        SinglePage::add('/dashboard/pages/push',$pkg);

        $service = $this->app->make('Concrete\Core\Attribute\Category\CategoryService');
        $categoryEntity = $service->getByHandle('collection');
        $category = $categoryEntity->getController();

        $key = $category->getByHandle('push_to_twitter');
        if (!is_object($key)) {
            $key = new PageKey();
            $key->setAttributeKeyHandle('push_to_twitter');
            $key->setAttributeKeyName('Push this Page to Twitter');
            $key = $category->add('boolean', $key, null, $pkg);
        }		
	}

    public function uninstall() {
        $pkg = parent::uninstall();
    }

	public function upgrade () {
		$pkg = parent::upgrade();
		$pkg = Package::getByHandle($this->pkgHandle);
	}

    public function on_start() {   
        require $this->getPackagePath() . '/vendor/autoload.php';
        $event = Core::make('\Concrete\Package\TwitterPush\Src\Push');
        Events::addListener('on_page_type_publish', array($event, 'pageAdd'));
    }
}
