<?php

declare(strict_types=1);

namespace App;

class Run
{
    private const BATCH_SIZE = 10000;

    private int $noOfRows;

    public function __construct(int $noOfRows)
    {
        $this->noOfRows = $noOfRows;
    }

    public function execute(): void
    {
        $start = microtime(true);

        $this->createCSV();

        echo 'Time required: '.(microtime(true) - $start).' seconds.'.PHP_EOL;
    }

    private function createCSV(): void
    {
        $loopTimes = ceil($this->noOfRows / self::BATCH_SIZE);
        $batchSize = min($this->noOfRows, self::BATCH_SIZE);

        $file = fopen($this->noOfRows.'_contacts_test_data.csv', 'ab+');

        for ($j = 1; $j <= $loopTimes; $j++) {
            $result = [];

            if ($j === 1) {
                $result[] = [
                    'firstname',
                    'lastname',
                    'email',
                ];
            }

            for ($i = 1; $i <= $batchSize; ++$i) {
                $result[] = [
                    'first'.$i,
                    'last'.$i,
                    'first.last'.$i.'@mailtest.mautic.com',
                ];
                fputcsv($file, $result[$i - 1]);
            }
        }
    }
}
