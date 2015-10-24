<?php
namespace Admin\Filter;

use DateTime;
use Exception;
use Zend\Filter\FilterInterface;
use Zend\Filter\AbstractFilter;

class DateToDateTime extends AbstractFilter implements FilterInterface
{
    /**
     * @var string
     */
    protected $format = DateTime::ISO8601;

    /**
     * @param array|Traversable $options
     */
    public function __construct($options = null)
    {
        if ($options) {
            $this->setOptions($options);
        }
    }

    /**
     * @return string
     */
    public function getFormat() {
        return $this->format;
    }

    /**
     * @param string $format
     * @return \Admin\Filter\DateToDateTime
     */
    public function setFormat($format) {
        $this->format = $format;
        return $this;
    }

    /**
     * @see \Zend\Filter\FilterInterface::filter()
     * @param  string $value
     * @return string
     */
    public function filter($value)
    {
        try{
            $date = (is_int($value))
                    ? new DateTime($value)
                    : DateTime::createFromFormat($this->getFormat(), $value);
        }catch(Exception $e) {
            $date = $value;
        }

        return $date;
    }
}