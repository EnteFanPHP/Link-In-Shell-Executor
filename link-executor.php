<?php
/**
*
* Valid urls:
* Must start with https or http
*/
class LinkException extends \Exception {}

function open_link(string $link) {
    if (filter_var($link, FILTER_VALIDATE_URL)) {
        if (PHP_OS == "Linux") {
            $linux_cmd = "xdg-open";
            $cmd = $linux_cmd;
            if(command_exist_linux($linux_cmd)) {
                exec($cmd." ".$link);
            } else {
                throw new LinkException("Command '".$cmd."' does not exists, install the command first");
            }
        }
    } else {
        throw new LinkException("Link is not valid");
    }
}

function command_exist_linux($cmd) {
    $return = shell_exec(sprintf("which %s", escapeshellarg($cmd)));
    return !empty($return);
}
