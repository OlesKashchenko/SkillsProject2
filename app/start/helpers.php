<?php
/*
if (!function_exists('__'))
{
    function __($key, $namespace = 'messages', $locale = null)
    {
 		*/
        /*
        $res = DB::table('translations')->get();
        $locale = $locale ? $locale : Lang::getlocale();
        
        $translations = array();
        foreach ($res as $item) {
            $translations[$item['locale']][$item['namespace']][$item['key']] = $item['value'];
        }
        // TODO: cache result
        
        if (isset($translations[$locale][$namespace][$key])) {
            return $translations[$locale][$namespace][$key];
        }
        
        return $key;
        */
        /*
        $locale = $locale ? $locale : Lang::getlocale();
        return Translate::get($key, $namespace, $locale);
    } // end __
}
*/

if (!function_exists('dr'))
{
    function dr($array)
    {
        echo '<pre>';
        die(print_r($array));
    } // end dr
}


if (!function_exists('format_filesize'))
{
    function format_filesize($file) 
    {
        $bytes = filesize($file);
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 1, ',', '') . ' Гб';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 1, ',', '') . ' Mб';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 1, ',', '') . ' Kб';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' байт';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' байт';
        } else {
            $bytes = '0 байтов';
        }
    
        return $bytes;
    } // end format_filesize
}

/*
 * Format price value for output
 */
function price_format($value, $decimals = 2, $point = '.', $thousands_sep = ',')
{
    return number_format($value, $decimals, $point, $thousands_sep);
}
        