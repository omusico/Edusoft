<?php 
namespace Pins\Service;

class ApplicationService 
{

public function create($quantity,$pins)
{
	$session = $entityManager->getRepository('Admin\Entity\Session')->findBy(array('status'=>1));
	$random = substr(number_format(time() * rand(), 0, "", ""),0,12);					
	$see = substr(number_format(time() * rand(), 0, "", ""),0,12);
	$pins->setSerial($see);
	$pins->setPin($random);
	$pins->setCreatedAt(date('d/m/Y'));
	$pins->setApplicantId('MIBS/'.$pins->getSerial());
	$pins->setSession($session);
	$entityManager->persist($pins);
}

public function bulkcreate($quantity){
			for($i=0; $i<$quantity; $i++){							   
			$this->create($quantity);
			}else{
				$i = $i-1;
			}
}

}