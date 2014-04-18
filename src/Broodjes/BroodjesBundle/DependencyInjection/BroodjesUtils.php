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
    
    function __construct($paramName1)
    {
        $this->param1 = $paramName1;
    }
    function timeFlashNotice()
    {
        $message = null;
        $maxTime = mktime($this->param1, 0, 0);
        $currentTime = time();
        $noticeTimeDelta = 600;//10 minutes
        if (($maxTime - $currentTime) < $noticeTimeDelta) {
            $current = new \DateTime();
            $current->setTimestamp($currentTime);
            $message = 'Broodjes bestellen kan tot '.$this->param1
                    .' uur. Het is nu '. $current->format('H:i:s');
        }
        return $message;
    }
}
