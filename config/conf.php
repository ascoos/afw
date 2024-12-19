<?php 
global $afw_path;

return [
    'cacheType' => 'file',     // [ascoos], memcached, file
    'db_driver' => 'mysqli',
    'cache_path' => $afw_path.'/tmp/cache/'
];
?>