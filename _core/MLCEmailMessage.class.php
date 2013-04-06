<?php
/* 
 *
 */
class MLCEmailMessage extends QEmailMessage{

    public function __construct($strFrom,$strTo,$strSubject,$strBody) {
        parent::__construct($strFrom,$strTo,$strSubject,$strBody);
    }

}
?>
