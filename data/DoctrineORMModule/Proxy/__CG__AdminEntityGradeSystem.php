<?php

namespace DoctrineORMModule\Proxy\__CG__\Admin\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class GradeSystem extends \Admin\Entity\GradeSystem implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', 'id', 'grade', 'startRange', 'endRange', 'description', 'gradeFormat');
        }

        return array('__isInitialized__', 'id', 'grade', 'startRange', 'endRange', 'description', 'gradeFormat');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (GradeSystem $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setGrade($grade)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGrade', array($grade));

        return parent::setGrade($grade);
    }

    /**
     * {@inheritDoc}
     */
    public function getGrade()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGrade', array());

        return parent::getGrade();
    }

    /**
     * {@inheritDoc}
     */
    public function setStartRange($startRange)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStartRange', array($startRange));

        return parent::setStartRange($startRange);
    }

    /**
     * {@inheritDoc}
     */
    public function getStartRange()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStartRange', array());

        return parent::getStartRange();
    }

    /**
     * {@inheritDoc}
     */
    public function setEndRange($endRange)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEndRange', array($endRange));

        return parent::setEndRange($endRange);
    }

    /**
     * {@inheritDoc}
     */
    public function getEndRange()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEndRange', array());

        return parent::getEndRange();
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription($description)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDescription', array($description));

        return parent::setDescription($description);
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescription', array());

        return parent::getDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setGradeFormat(\Admin\Entity\GradeFormat $gradeFormat = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGradeFormat', array($gradeFormat));

        return parent::setGradeFormat($gradeFormat);
    }

    /**
     * {@inheritDoc}
     */
    public function getGradeFormat()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGradeFormat', array());

        return parent::getGradeFormat();
    }

}