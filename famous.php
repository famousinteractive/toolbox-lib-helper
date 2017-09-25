<?php


if(! function_exists('xcopy') ) {
    /**
     * Copy recursivly a directory and his files
     * @param $source
     * @param $dest
     * @param int $permissions
     * @return bool
     */
    function xcopy($source, $dest, $permissions = 0755)
    {
        if (is_link($source)) {
            return symlink(readlink($source), $dest);
        }
        if (is_file($source)) {
            return copy($source, $dest);
        }
        if (!is_dir($dest)) {
            mkdir($dest, $permissions);
        }
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            xcopy("$source/$entry", "$dest/$entry", $permissions);
        }
        $dir->close();
        return true;
    }
}

if (! function_exists('extractExtension')) {
    /**
     * Extract the last extension
     * @param $string
     * @return mixed
     */
    function extractExtension($string) {
        $explode = explode('.',$string);
        return end($explode);
    }
}

if (! function_exists('getDateDifferenceFromNow')) {
    function getDateDifferenceFromNow( $date) {
        $datetime1 = new DateTime();

        $datetime2 = new DateTime($date);

        $difference = $datetime1->diff($datetime2);

        return (array) $difference;
    }
}

if(! function_exists('formatDateToUser')) {
    function formatDateToUser($date, $format='d/m/Y H:i') {
        return date($format, strtotime($date));
    }
}