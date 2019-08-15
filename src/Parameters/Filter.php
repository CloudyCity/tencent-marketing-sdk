<?php
/**
 * Created by PhpStorm.
 * User: lizhicheng
 * Date: 2019/8/13
 * Time: 19:39
 */

namespace MrSuperLi\Tencent\Ads\Parameters;

// 当 operator 为 EQUALS、CONTAINS、LESS_EQUALS、LESS、GREATER_EQUALS、GREATER 时，values数组长度为1；
// 当 operator 为 IN 时，values数组长度为100；

// filtering=[{"field":"system_status", "operator": "EQUALS", "values":["AD_STATUS_PENDING"]}, {"field":"adgroup_name", "operator": "CONTAINS", "values": ["广告"]}]

use Illuminate\Contracts\Support\Arrayable;

class Filter implements Arrayable
{

    /**
     * filter 数据
     *
     * @var array
     */
    protected $_data = [];

    /**
     * 相等
     */
    const OP_EQUALS = 'EQUALS';

    /**
     * 小于等于
     */
    const OP_LESS_EQUALS = 'LESS_EQUALS';

    /**
     * 大于等于
     */
    const OP_GREATER_EQUALS = 'GREATER_EQUALS';

    /**
     * 小于
     */
    const OP_LESS = 'LESS';

    /**
     * 大于
     */
    const OP_GREATER = 'GREATER';

    /**
     * 其中一个值
     */
    const OP_IN = 'IN';

    /**
     * 模糊匹配
     */
    const OP_CONTAINS = 'CONTAINS';

    /**
     * 统一设置 filter 入口
     *
     * @param $field
     * @param $values
     * @param $operator
     * @return $this
     */
    protected function set($field, $values, $operator) {
        $this->_data[] = [$field, $operator, is_array($values) ? $values : [$values]];

        return $this;
    }

    /**
     * 等于
     *
     * @param $field
     * @param $values
     * @return Filter
     */
    public function eq($field, $values) {
        return $this->set($field, $values, self::OP_EQUALS);
    }

    /**
     * 小于等于
     *
     * @param $field
     * @param $values
     * @return Filter
     */
    public function ltEqual($field, $values) {
        return $this->set($field, $values, self::OP_LESS_EQUALS);
    }

    /**
     * 大于等于
     *
     * @param $field
     * @param $values
     * @return Filter
     */
    public function gtEqual($field, $values) {
        return $this->set($field, $values, self::OP_GREATER_EQUALS);
    }

    /**
     * 小于
     *
     * @param $field
     * @param $values
     * @return Filter
     */
    public function lt($field, $values) {
        return $this->set($field, $values, self::OP_LESS);
    }

    /**
     * 大于
     *
     * @param $field
     * @param $values
     * @return Filter
     */
    public function gt($field, $values) {
        return $this->set($field, $values, self::OP_GREATER);
    }

    /**
     * 其中一个值
     *
     * @param $field
     * @param $values
     * @return Filter
     */
    public function in($field, $values) {
        return $this->set($field, $values, self::OP_IN);
    }

    /**
     * 模糊匹配
     *
     * @param $field
     * @param $values
     * @return Filter
     */
    public function contains($field, $values) {
        return $this->set($field, $values, self::OP_CONTAINS);
    }


    /**
     * 输出数组
     *
     * @return array
     */
    public function toArray() {
        $result = [];

        foreach ($this->_data as list($field, $operator, $values)) {
            $result[] = [
                'field' => $field,
                'operator' => $operator,
                'values' => $values,
            ];
        }

        return $result;
    }

}