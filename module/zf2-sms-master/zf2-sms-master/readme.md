ZF2 wrapper for various SMS providers.

TODO:
1) Add unit tests.
2) Implement next adapters. (If you find this repo useful and would like to contribute new adapters, you are welcome!)

To add new SMS adapter implement \SMS\Model\Adapter\AdapterInterface (1 method - send()).

Tested on ZF 2.1.4

How to use example:

```php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use SMS\Model\CountryPrefix;

class IndexController extends AbstractActionController implements CountryPrefix
{
    /**
     * @var \SMS\Facade
     */
    protected $facadeSMS;

    /**
     * @param \SMS\Facade $facade
     */
    public function setFacadeSMS(\SMS\Facade $facade)
    {
        $this->facadeSMS = $facade;
    }
    

    public function getServiceFactorySMS()
    {
    	$sm = $this->getServiceLocator();
    	
    	$factory = $sm->get('SMS\Factory');
        
        $this->setFacadeSMS($factory->getFacadeSMS());
    }

    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $sms = $this->facadeSMS->makeMock();
        $sms->setFrom(
            $this->facadeSMS->makeNumber(CountryPrefix::POLAND, '885136146')
        )->setTo(
            $this->facadeSMS->makeNumber(CountryPrefix::GREAT_BRITAIN, '123456789')
        )->setContent(
            $this->facadeSMS->makeContent('Hello world!')
        );
        $result = $sms->send();

        return new ViewModel(array('result' => $result));
    }
    
    /**
     * @return ViewModel
     */
    public function smsviaovhAction()
    {
    	
    	$this->getServiceFactorySMS();
    	
    	$sms = $this->facadeSMS->makeOVHAPI();
    	$sms->setFrom(
    			$this->facadeSMS->makeNumber(CountryPrefix::FRANCE, '612321232')
    	)->setTo(
    			$this->facadeSMS->makeNumber(CountryPrefix::GREAT_BRITAIN, '123456789')
    	)->setContent(
    			$this->facadeSMS->makeContent($message)
    	);
    	$result = $sms->send();
    	
    	return new ViewModel(array('result' => $result));
    	
        
    }
}
```

If you would like to add eg. log sms feature, the best implement it using preSend and postSend events.