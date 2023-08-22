<?php

namespace App\Services\Report;

class DiffReporter
{
    /**
     * @throws \Exception
     */
    public function diff(HomepageReporter $firstReporter, HomepageReporter $secondReporter): array
    {
        $firstReport = $firstReporter->getHomepageReport();

        if (!$firstReport['isDataReady']) {
            throw new \Exception('First reporter is not ready.');
        }

        $secondReport = $secondReporter->getHomepageReport();

        if (!$secondReport['isDataReady']) {
            throw new \Exception('Second reporter is not ready.');
        }

        dd($firstReport, $secondReport);

        return array_diff(
            $firstReport,
            $secondReport
        );
    }
}
