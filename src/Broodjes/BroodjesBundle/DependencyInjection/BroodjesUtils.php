<?php

namespace Broodjes\BroodjesBundle\DependencyInjection;

/**
 * Description of BroodjesUtils
 *
 * @author cyber01
 */

class BroodjesUtils
{
    private $param1;
    private $param2;
    private $param3;
    
    function __construct($param1, $param2, $param3)
    {
        $this->param1 = $param1;
        $this->param2 = $param2;
        $this->param3 = $param3;
    }
    function timeNotice()
    {
        $message = null;
        $maxTime = mktime($this->param1, $this->param2, 0);
        $currentTime = time();
        $noticeTimeDelta = $this->param3 * 60;
        if (($maxTime - $currentTime) < $noticeTimeDelta) {
            $current = new \DateTime();
            $current->setTimestamp($currentTime);
            $message = 'Broodjes bestellen kan tot '.$this->param1
                    .'u'.$this->param2.'. Het is nu '. $current->format('H:i:s');
        }
        return $message;
    }
    
    function timeCheck()
    {
        $maxTime = mktime($this->param1, $this->param2, 0);
        $currentTime = time();
        if ($currentTime >= $maxTime) {
            return false;
        } else {
            return true;
        }
    }
}
