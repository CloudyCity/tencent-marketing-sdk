<?php

namespace CloudyCity\TencentMarketingSDK\Kernel\Http\Parameters;

class DateRange extends TimeRange
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    protected function __toArray()
    {
        return [
            'start_date' => $this->start->toDateString(),
            'end_date'   => $this->end->toDateString(),
        ];
    }
}
