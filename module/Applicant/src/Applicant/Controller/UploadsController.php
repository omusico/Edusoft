<?php
/**
 * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */


namespace Applicant\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Applicant\Entity\ApplicantInterface;
use Applicant\Form\ApplicantForm;
use Applicant\Service\ApplicantServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UploadsController extends AbstractActionController
{
      /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     *
     * @var SchoolServiceInterface
     */
    private $schoolService;


   /**
   * Holds the directory where all files are stored.
   *
   * @var string
   */
  protected $_dir = null;
  
  /**
   * Gets called in the beginning of each action in IndexController, initializing the files directory.
   *
   * @return void
   */
  public function init()
  {
    $config = $this->getServiceLocator()->get('Config');
    $fileManagerDir = $config['file_manager']['dir'];
    if ($user = $this->zfcUserAuthentication()->getIdentity()) {
      
    } else {
      return $this->redirect()->toRoute('zfc-login');   
    }

    if(!is_dir($fileManagerDir)) {
      mkdir($fileManagerDir, 0777);
    }
    
    $this->_dir = realpath($fileManagerDir) .
        DIRECTORY_SEPARATOR .
        $user->getId();
  }

    public function indexAction()
  {
    $this->init();
    
    $files = array();
      if (is_dir($this->_dir)) {
      $handle = opendir($this->_dir);
        if ($handle) {
        while (false !== ($entry = readdir($handle))) {
          if ($entry != "." && $entry != "..") {
            $files[] = $entry;
          }
        }
        closedir($handle);
        }   
    }   
    
    return new ViewModel(array('files' => $files));   
  }
  
    public function uploadAction()
    {
    $this->init();
    if (!is_dir($this->_dir)) {
      mkdir($this->_dir, 0777);
    }     
    $form = new UploadForm($this->getServiceLocator(), $this->_dir, 'upload-form');
      $request = $this->getRequest();
    if ($request->isPost()) {
      // Make certain to merge the files info!
      $post = array_merge_recursive(
        $request->getPost()->toArray(),
        $request->getFiles()->toArray()
      );

      $form->setData($post);
      if ($form->isValid()) {
        $data = $form->getData();
        // Form is valid, save the form!
        $this->setFileNames($data);
        // The data can be saved in the DataBase        
        return $this->redirect()->toRoute('uploads');
      }
    }   
    
    
    return new ViewModel(array('form' => $form));   
  }

    public function downloadAction()
    {
    $this->init();
    $file = urldecode($this->params()->fromRoute('id'));
    $filename = $this->_dir . DIRECTORY_SEPARATOR . $file;
    
    if (file_exists($filename)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename='.basename($file));
      header('Content-Transfer-Encoding: binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($filename)); // $file));
      ob_clean();
      flush();
      // readfile($file);
      readfile($filename);
      exit;
    }   
    
    return new ViewModel(array());
  }

    public function deleteAction()
    {
    $this->init();
    $file = urldecode($this->params()->fromRoute('id'));
    $filename = $this->_dir . DIRECTORY_SEPARATOR . $file;
    unlink ($filename);
    return $this->redirect()->toRoute('uploads');    
    return new ViewModel(array());
  }
  
  public function viewAction()
  {
    $this->init();
    $file = urldecode($this->params()->fromRoute('id'));
    $filename = $this->_dir . DIRECTORY_SEPARATOR . $file;
    $contents = null;
    if (file_exists($filename)) {
      $handle = fopen($filename, "r"); // "r" - not r but b for Windows "b" - keeps giving me errors no file
      $contents = fread($handle, filesize($filename));
      fclose($handle);
    }
    return new ViewModel(array('contents' => $contents));
  }
  
  public function getImageAction()
  {
    $this->init();
    $file = urldecode($this->params()->fromRoute('id'));
    $filename = $this->_dir . DIRECTORY_SEPARATOR . $file;

    if (file_exists($filename)) {
      header('Content-Type: image/jpeg');
      ob_clean();
      flush();
      readfile($filename);
      exit;   
    }
    return new ViewModel(array());
  } 
  
  /**
   * Change the names of the uploaded files to their original names. Since we don't keep anything in the DB
   *
   * @param array $data array of arrays
   * @return void
   */ 
  protected function setFileNames($data)
  {
    unset($data['submit']);
    foreach ($data['file'] as $key => $file) {
      rename($file['tmp_name'], $this->_dir . DIRECTORY_SEPARATOR . $file['name']);
    }   
  } 

   

    /**
     * Method used to inject school service.
     *
     * @param SchoolServiceInterface $service
     */
    public function setSchoolService(SchoolServiceInterface $service)
    {
        $this->schoolService = $service;
    }

        /**
     * Method used to obtain school service.
     *
     * @return SchoolService
     */
    public function getSchoolService()
    {
        return $this->schoolService;
    }

    /**
     * Method used to obtain EntityManager.
     *
     * @return EntityManager - entity manager object
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Method used to inject EntityManager.
     *
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
