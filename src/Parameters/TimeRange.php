<?php
/**
 * Created by PhpStorm.
 * User: lizhicheng@shiyuegame.com
 * Date: 2019/8/14
 * Time: 09:41
 */

namespace MrSuperLi\Tencent\Ads\Parameters;


use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

class TimeRange implements Arrayable
{
    /**
     * 开始时间
     *
     * @var Carbon
     */
    protected $start;

    /**
     * 结束时间
     *
     * @var Carbon
     */
    protected $end;

    public function __construct($start = null, $end = null)
    {
        $this->start($start);
        $this->end($end);
    }


    /**
     * @param $start
     * @return $this
     */
    public function start($start) {
        if ($start) $this->start = Carbon::make($start);

        return $this;
    }

    /**
     * @param $end
     * @return $this
     */
    public function end($end) {
        if ($end) $this->end = Carbon::make($end);

        return $this;
    }

    /**
     * @throws \Exception
     */
    protected function checkTimeRange() {
        if (! ($this->start instanceof Carbon)) {
            throw new \Exception('开始时间不能为空');
        }

        if (! ($this->end instanceof  Carbon)) {
            throw new \Exception('结束时间不能为空');
        }
    }

    /**
     * @return array
     */
    protected function _toArray() {
        return [
            'start_time' => $this->start->getTimestamp(),
            'end_time' => $this->end->getTimestamp(),
        ];
    }

    /**
     * 安全导出
     *
     * @return array
     * @throws \Exception
     */
    public function toArray() {

        $this->checkTimeRange();

        return $this->_toArray();
    }
}