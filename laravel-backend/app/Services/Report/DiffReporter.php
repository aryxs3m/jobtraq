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

        //dd($firstReport);

        return [
            'pieChartPositions' => $this->diffChartData(
                $firstReport['pieChartPositions'],
                $secondReport['pieChartPositions']
            ),
            'treeMapStacks' => $this->diffChartData(
                $firstReport['treeMapStacks'],
                $secondReport['treeMapStacks']
            ),
            'positionSalaries' => $this->diffGroupedChart(
                $firstReport,
                $secondReport,
                'positionSalaries',
                'name',
                'data'),
            'barStacks' => $this->diffGroupedChart(
                $firstReport,
                $secondReport,
                'barStacks',
                'name',
                'series'),
        ];
    }

    private function diffGroupedChart(array $first, array $second, string $key, string $groupKey, string $dataKey): array
    {
        $output = [];

        $positions = array_unique(array_merge(
            array_column($first[$key], $groupKey),
            array_column($second[$key], $groupKey)
        ));

        foreach ($positions as $position) {
            $firstChartIndex = array_search($position, array_column($first[$key], $groupKey));
            $SecondChartIndex = array_search($position, array_column($second[$key], $groupKey));

            $diff = $this->diffChartData(
                $first[$key][$firstChartIndex][$dataKey],
                $second[$key][$SecondChartIndex][$dataKey],
            );

            if (empty($diff)) {
                continue;
            }

            $output[$position] = $diff;
        }

        return $output;
    }

    private function diffChartData(array $first, array $second): array
    {
        $firstValues = $this->getArrayFromChartData($first);
        $secondValues = $this->getArrayFromChartData($second);

        return $this->getValueDiff($firstValues, $secondValues);
    }

    private function getArrayFromChartData(array $array): array
    {
        $output = [];

        foreach ($array as $item) {
            if (is_object($item)) {
                $values = array_values(get_object_vars($item));
            } else {
                $values = array_values($item);
            }

            $output[$values[0]] = $values[1];
        }

        return $output;
    }

    private function getValueDiff(array $first, array $second): array
    {
        $output = [];

        $keys = array_keys(array_diff($first, $second));

        foreach ($keys as $key) {
            $firstValue = array_key_exists($key, $first) ? $first[$key] : null;
            $secondValue = array_key_exists($key, $second) ? $second[$key] : null;

            $output[$key] = [
                'first' => $firstValue,
                'second' => $secondValue,
            ];
        }

        return $output;
    }
}
