<?php
/**
 * @author Admiko
 * @copyright Copyright (c) Admiko
 * @link https://admiko.com
 * @Help We are committed to delivering the best code quality and user experience. If you have suggestions or find any issues, please don't hesitate to contact us. Thank you.
 * This file is managed by Admiko and is not recommended to be modified.
 * Any custom code should be added elsewhere to avoid losing changes during updates.
 * However, in case your code is overwritten, you can always restore it from a backup folder.
 */

namespace app\Http\Controllers\Admin\AdminService\Traits;

use Carbon\Carbon;
use DateTime;
use DateInterval;
use DatePeriod;
use Illuminate\Support\Collection;
trait AdminWidgetsTrait
{

    public function checkDates($dateStart, $dateEnd)
    {
        $date_start = DateTime::createFromFormat('Y-m-d', $dateStart) ?? false;
        $date_end = DateTime::createFromFormat('Y-m-d', $dateEnd) ?? false;

        // Validate the dates
        if (($date_start && $date_end) && $date_start > $date_end) {
            // Check if start_date is after end_date, and if so, swap them
            return [$dateEnd, $dateStart];
        }
        return [$dateStart, $dateEnd];
    }


    public function widgetFilterData($allData,$dateStart, $dateEnd)
    {
        return $allData->when(($dateStart), function ($query) use ($dateStart) { return $query->where("created_at", ">=", $dateStart); })
            ->when(($dateEnd), function ($query) use ($dateEnd) { return $query->where("created_at", "<=", $dateEnd); })
            ->groupBy("label")
            ->havingRaw('label IS NOT NULL')
            ->orderBy("label")->get();
    }
    public function widgetFillMissingDates($allData, $dateStart, $dateEnd, $dateFormat = "")
    {
        $returnDates = collect();

        if (!$dateStart) {
            $dateStart = $allData->min('label');
        }
        if (!$dateEnd) {
            $dateEnd = $allData->max('label');
        }
        if ($dateStart && $dateEnd) {
            if (in_array($dateFormat, ['Y-m', 'Y', 'Y-m-d', 'Y-m-d H:00:00', 'Y, W'])) {
                switch ($dateFormat) {
                    case 'Y-m-d H:00:00':
                        $dateInterval = 'PT1H';
                        $dateStart = (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateStart)) ? $dateStart : $dateStart . '-01-01';
                        $dateEnd = (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateEnd)) ? $dateEnd : $dateEnd . '-01-01';
                        $dateStart = Carbon::parse($dateStart)->startOfDay();
                        $dateEnd = Carbon::parse($dateEnd)->endOfDay();
                        break;
                    case 'Y-m':
                        $dateInterval = 'P1M';
                        $dateStart = Carbon::parse($dateStart)->startOfMonth();
                        $dateEnd = Carbon::parse($dateEnd)->endOfMonth();
                        break;
                    case 'Y':
                        $dateInterval = 'P1Y';
                        $dateStart = (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateStart)) ? $dateStart : $dateStart . '-01-01';
                        $dateEnd = (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateEnd)) ? $dateEnd : $dateEnd . '-01-01';
                        $dateStart = Carbon::parse($dateStart)->startOfYear();
                        $dateEnd = Carbon::parse($dateEnd)->endOfYear();
                        break;
                    case 'Y, W':
                        $dateInterval = 'P1W';
                        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateStart)) {
                            list($year, $week) = explode(', ', $dateStart);
                            $dateStart = Carbon::now()
                                ->isoWeekYear($year)
                                ->isoWeek((int)$week);
                        }
                        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateEnd)) {
                            list($year, $week) = explode(', ', $dateEnd);
                            $dateEnd = Carbon::now()
                                ->isoWeekYear($year)
                                ->isoWeek((int)$week);
                        }
                        $dateStart = Carbon::parse($dateStart)->startOfWeek();
                        $dateEnd = Carbon::parse($dateEnd)->endOfWeek();
                        break;
                    default:
                        $dateInterval = 'P1D';
                        $dateStart = Carbon::parse($dateStart)->startOfDay();
                        $dateEnd = Carbon::parse($dateEnd)->endOfDay();
                }
                $period = new DatePeriod(
                    new DateTime($dateStart),
                    new DateInterval($dateInterval),
                    new DateTime($dateEnd)
                );

            } elseif ($dateFormat == 'G') {
                $period = range(1,24);
            } elseif ($dateFormat == 'j') {
                $period = range(1,31);
            } elseif ($dateFormat == 'n') {
                $period = range(1,12);
            } elseif ($dateFormat == 'W') {
                $period = range(1,52);
            } else {
                return $allData;
            }
            foreach ($period as $date) {
                if ($dateFormat == 'G' || $dateFormat == 'j' || $dateFormat == 'n' || $dateFormat == 'W') {
                    $formattedDate = $date;
                } else {
                    $formattedDate = $date->format($dateFormat);
                }

                $found = $allData->firstWhere('label', $formattedDate);
                if ($found) {
                    $returnDates->push((object)["label" => $formattedDate, "count" => $found->count]);
                } else {
                    $returnDates->push((object)["label" => $formattedDate, "count" => 0]);
                }
            }
        }
        return $returnDates->isNotEmpty() ? $returnDates : $allData;
    }

    public function widgetSortAndGroupLabels($labelsAll,$dateFormat,$toDateFormat='')
    {
        $collection = Collection::make($labelsAll)->flatten(1)->unique();

        if (in_array($dateFormat, ['Y-m', 'Y-m-d', 'Y-m-d H:00:00'])) {

            $returnData = $collection->sortBy(function ($data) {
                return Carbon::parse($data);
            })->map(function ($data) use ($toDateFormat){
                return Carbon::parse($data)->translatedFormat($toDateFormat);
            });
        } elseif (in_array($dateFormat, ['G', 'j', 'Y', 'W', 'Y, W'])) {
            $returnData = $collection->sort();
        } elseif ($dateFormat == 'n') {
            $returnData = $collection->sort()->map(function ($data){
                return trans('admin/config/date_time.php_short_month_names.'.$data);
            });
        } else {
            $returnData = $collection->sort()->map(function ($data){
                return (string) $data;
            });;
        }
        return $returnData->toArray();
    }

}
