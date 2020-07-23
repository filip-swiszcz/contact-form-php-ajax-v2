<?php

class JSON {
    
    public function validateAjaxRequest() {
        
        // to check if its an ajax request, exit if not
        $http_request = $_SERVER['HTTP_X_REQUESTED_WITH'];
        if (! isset($http_request) && strtolower($http_request) != 'xmlhttprequest') {
            $output = $this->createJsonInstance('Not a valid AJAX request!');
            $this->endAction($output);
        }
        
    }
    
    public function endAction($output) {
        
        die($output);
        
    }
    
    public function createJsonInstance($message, $type = 'error') {
        
        $messageArray = array(
            'type' => $type,
            'text' => $message
        );
        $jsonObj = json_encode($messageArray);
        return $jsonObj;
        
    }
    
    public function getJsonValue($json, $key) {
        
        $jsonArray = json_decode($json, true);
        return $jsonArray[$key];
        
    }
    
}

?>