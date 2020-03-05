<?php

namespace CloudyCity\TencentMarketingSDK\Kernel\Http\Parameters;

use Carbon\Carbon;

class TimeRange
{
    /**
     * Starting time.
     *
     * @var Carbon
     */
    protected $start;

    /**
     * End time.
     *
     * @var Carbon
     */
    protected $end;

    /**
     * TimeRange constructor.
     *
     * @param null $start
     * @param null $end
     */
    public function __construct($start = null, $end = null)
    {
        $this->start($start);
        $this->end($end);
    }


    /**
     * Set start time.
     *
     * @param $start
     * @return $this
     */
    public function start($start)
    {
        if ($start) {
            $this->start = Carbon::make($start);
        }

        return $this;
    }

    /**
     * Set end time.
     *
     * @param $end
     * @return $this
     */
    public function end($end)
    {
        if ($end) {
            $this->end = Carbon::make($end);
        }

        return $this;
    }

    /**
     * Check start time and end time.
     *
     * @throws \Exception
     */
    protected function checkTimeRange()
    {
        if (! ($this->start instanceof Carbon)) {
            throw new \Exception('开始时间不能为空');
        }

        if (! ($this->end instanceof  Carbon)) {
            throw new \Exception('结束时间不能为空');
        }
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    protected function __toArray()
    {
        return [
            'start_time' => $this->start->getTimestamp(),
            'end_time' => $this->end->getTimestamp(),
        ];
    }

    /**
     * Check timeCheck time and get the instance as an array.
     *
     * @return array
     * @throws \Exception
     */
    public function toArray()
    {
        $this->checkTimeRange();

        return $this->__toArray();
    }
}
