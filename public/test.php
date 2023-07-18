<?php
require __DIR__ . '/../vendor/autoload.php';


$arrays = array_chunk(range(1, 100000), 10000);

foreach ($arrays as $items) {
    foreach ($items as $item) {
        $books[] = [
            $item,
        ];
    }

    echo $sizeInBytes = memory_get_usage(true) / 1048576;
    echo PHP_EOL;
    echo count($books);
    echo PHP_EOL;
    unset($books);
}



