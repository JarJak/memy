<?php
namespace Helper;
// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Acceptance extends \Codeception\Module
{
    public function clickJQuerySelectedElement($element) {
        $this->executeJS('return $("' . $element . '").get(0).click()');
    }
}
