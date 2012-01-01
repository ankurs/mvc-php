<?php

function should_debug($level)
{
    if (defined("DEBUG_ENABLED") && DEBUG_ENABLED)
    {
        if (defined("DEBUG_LEVEL") && DEBUG_LEVEL >= $level)
        {
            return true;
        }
    }
    return false;
}

function debug($string, $level=1)
{
    if (should_debug($level))
    {
        if (DEBUG_FUNCTION == "log")
        {
            error_log($string);
        } 
        else if (DEBUG_FUNCTION == "html")
        {
            echo "<br/>".$string."<br/>";
        }
        // TODO saperate log file
    }
}

?>
