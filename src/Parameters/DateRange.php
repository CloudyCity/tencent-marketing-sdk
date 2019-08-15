<?php
/**
 * Created by PhpStorm.
 * User: lizhicheng@shiyuegame.com
 * Date: 2019/8/14
 * Time: 09:42
 */

namespace MrSuperLi\Tencent\Ads\Parameters;


class DateRange extends TimeRange
{

    /**
     * @return array
     */
    protected function _toArray() {
        return [
            'start_date' => $this->start->format('Y-m-d'),
            'end_date' => $this->end->format('Y-m-d'),
        ];
    }

}