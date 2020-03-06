<?php

namespace CloudyCity\TencentMarketingSDK\Kernel\Http\Parameters;

class Filter
{
    const OP_EQUALS = 'EQUALS';

    const OP_LESS_EQUALS = 'LESS_EQUALS';

    const OP_GREATER_EQUALS = 'GREATER_EQUALS';

    const OP_LESS = 'LESS';

    const OP_GREATER = 'GREATER';

    const OP_IN = 'IN';

    const OP_CONTAINS = 'CONTAINS';

    /**
     * filter data.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Add a statement to filter.
     *
     * @param $field
     * @param $values
     * @param $operator
     *
     * @return $this
     */
    protected function set($field, $values, $operator)
    {
        $this->data[] = [$field, $operator, is_array($values) ? $values : [$values]];

        return $this;
    }

    /**
     * Add an "equal to" statement to the filter.
     *
     * @param $field
     * @param $values
     *
     * @return Filter
     */
    public function eq($field, $values)
    {
        return $this->set($field, $values, self::OP_EQUALS);
    }

    /**
     * Add a "less than or equal to" statement to the filter.
     *
     * @param $field
     * @param $values
     *
     * @return Filter
     */
    public function lte($field, $values)
    {
        return $this->set($field, $values, self::OP_LESS_EQUALS);
    }

    /**
     * Add a "greater than or equal to" statement to the filter.
     *
     * @param $field
     * @param $values
     *
     * @return Filter
     */
    public function gte($field, $values)
    {
        return $this->set($field, $values, self::OP_GREATER_EQUALS);
    }

    /**
     * Add a "less than" statement to the filter.
     *
     * @param $field
     * @param $values
     *
     * @return Filter
     */
    public function lt($field, $values)
    {
        return $this->set($field, $values, self::OP_LESS);
    }

    /**
     * Add a "greater than" statement to the filter.
     *
     * @param $field
     * @param $values
     *
     * @return Filter
     */
    public function gt($field, $values)
    {
        return $this->set($field, $values, self::OP_GREATER);
    }

    /**
     * Add an "in" statement to the filter.
     *
     * @param $field
     * @param $values
     *
     * @return Filter
     */
    public function in($field, $values)
    {
        return $this->set($field, $values, self::OP_IN);
    }

    /**
     * Add an "contains" statement to the filter.
     *
     * @param $field
     * @param $values
     *
     * @return Filter
     */
    public function contains($field, $values)
    {
        return $this->set($field, $values, self::OP_CONTAINS);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        $result = [];

        foreach ($this->data as list($field, $operator, $values)) {
            $result[] = [
                'field'    => $field,
                'operator' => $operator,
                'values'   => $values,
            ];
        }

        return $result;
    }
}
