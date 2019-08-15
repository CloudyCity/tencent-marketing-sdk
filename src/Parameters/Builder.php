<?php
/**
 * 查询参数构造器
 *
 * User: lizhicheng
 * Date: 2019/8/14
 * Time: 09:55
 */

namespace MrSuperLi\Tencent\Ads\Parameters;


use Doctrine\Common\Collections\ArrayCollection;

class Builder extends ArrayCollection
{

    /**
     * 工厂函数
     *
     * @return Builder
     */
    public static function make() {
        return new static();
    }

    /**
     * 排序，可以多次调用
     *
     * @param $field
     * @param string $sortType
     * @return $this
     */
    public function orderBy($field, $sortType = 'desc') {
        $key = 'order_by';

        $orderBy = $this->get($key) ?: [];

        $sortType = $sortType === 'desc' ? 'DESCENDING' : 'ASCENDING';

        $orderBy[] = [
            'sort_field' => $field,
            'sort_type' => $sortType,
        ];

        return $this->set($key, $orderBy);
    }

    /**
     * 只能调用一次, 多次会被覆盖
     *
     * @return $this
     */
    public function groupBy() {
        $key = 'group_by';

        $args = func_get_args();

        $argNum = count($args);

        if ($argNum === 1) {
            $this->set($key, is_array($args[0]) ? $args[0] : $args);
        } elseif ($argNum > 1) {
            $this->set($key, $args);
        }

        return $this;
    }

    public function set($key, $value)
    {
        parent::set($key, $value);

        return $this;
    }

    public function setDateRange() {
        $key = 'date_range';

        $args = func_get_args();

        $argNum = count($args);

        if ($argNum === 1 && $args[0] instanceof DateRange) {
            return $this->set($key, $args[0]);
        }

        if ($argNum >= 2) {
            return $this->set($key, new DateRange($args[0], $args[1]));
        }

        throw new \InvalidArgumentException('参数不能为空');
    }

    public function setTimeRange() {
        $key = 'time_range';

        $args = func_get_args();

        $argNum = count($args);

        if ($argNum === 1 && $args[0] instanceof TimeRange) {
            return $this->set($key, $args[0]);
        }

        if ($argNum >= 2) {
            return $this->set($key, new TimeRange($args[0], $args[1]));
        }

        throw new \InvalidArgumentException('参数不能为空');
    }

    /**
     * @return Filter
     */
    public function getFilter() {
        $key = 'filtering';

        $filter = $this->get($key);

        if (! $filter) {
            $filter = new Filter();
            $this->set($key, $filter);
        }

        return $filter;
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return array_map(function ($value) {
            if ($value instanceof Arrayable) {
                return $value->toArray();
            } else {
                return $value;
            }
        }, parent::toArray());
    }

}