<?php

namespace CloudyCity\TencentMarketingSDK\Kernel\Http\Parameters;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Params.
 */
class Params extends ArrayCollection
{
    protected $is_multipart = false;

    /**
     * Get instance.
     *
     * @param $params
     * @return Params
     */
    public static function make($params = [])
    {
        if ($params instanceof static) {
            return $params;
        }

        return new static($params);
    }

    /**
     * Add an "order_by" param to the request.
     *
     * @param $field
     * @param string $direction
     * @return $this
     */
    public function orderBy($field, $direction = 'desc')
    {
        $key = 'order_by';

        $orderBy = $this->get($key) ?: [];

        $direction = $direction === 'desc' ? 'DESCENDING' : 'ASCENDING';

        $orderBy[] = [
            'sort_field' => $field,
            'sort_type' => $direction,
        ];

        return $this->set($key, $orderBy);
    }

    /**
     * Add an "group_by" param to the request.
     *
     * @return $this
     */
    public function groupBy()
    {
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

    /**
     * Set a param.
     *
     * @param string $key
     * @param mixed $value
     * @return $this|void
     */
    public function set($key, $value)
    {
        parent::set($key, $value);

        return $this;
    }

    /**
     * Set a param and set format to multipart.
     *
     * @param $key
     * @param $value
     * @return Params
     */
    public function multipart($key, $value)
    {
        $this->is_multipart = true;

        return $this->set($key, $value);
    }

    /**
     * Set a file to params.
     *
     * @param $field
     * @param $file
     * @param $filename
     * @return $this
     */
    public function file($field, $file, $filename = '')
    {
        if (!$file) {
            return $this;
        }

        if (is_string($file)) {
            if (!$filename) {
                $filename = basename($filename);
            }

            $file = fopen($file, 'r');
        }

        if (is_resource($file)) {
            $this->multipart($field, [
                'name' => $field,
                'contents' => $file,
                'filename' => $filename,
            ]);
        }

        return $this;
    }

    /**
     * Add an "date_range" param to the request.
     *
     * @return $this|void
     */
    public function setDateRange()
    {
        $key = 'date_range';

        $args = func_get_args();

        $argNum = count($args);

        if ($argNum === 1 && $args[0] instanceof DateRange) {
            return $this->set($key, $args[0]);
        }

        if ($argNum >= 2) {
            return $this->set($key, new DateRange($args[0], $args[1]));
        }

        throw new \InvalidArgumentException('Date range cannot be empty.');
    }

    /**
     * Add an "time_range" param to the request.
     *
     * @return $this|void
     */
    public function setTimeRange()
    {
        $key = 'time_range';

        $args = func_get_args();

        $argNum = count($args);

        if ($argNum === 1 && $args[0] instanceof TimeRange) {
            return $this->set($key, $args[0]);
        }

        if ($argNum >= 2) {
            return $this->set($key, new TimeRange($args[0], $args[1]));
        }

        throw new \InvalidArgumentException('Time range cannot be empty.');
    }

    /**
     * Get the filter of builder.
     *
     * @return Filter|mixed
     */
    public function getFilter()
    {
        $key = 'filtering';

        $filter = $this->get($key);

        if (!$filter) {
            $filter = new Filter();
            $this->set($key, $filter);
        }

        return $filter;
    }

    /**
     * Set a filter param to the request.
     *
     * @param $filter
     * @return $this|void
     */
    public function setFilter($filter)
    {
        return $this->set('filtering', $filter);
    }

    /**
     * Get the instance as a multipart.
     *
     * @return array
     */
    protected function toMultipart()
    {
        $results = [];
        foreach (parent::toArray() as $field => $value) {
            if (is_object($value) && method_exists($value, 'toArray')) {
                $results[] = [
                    'name' => $field,
                    'contents' => $value->toArray(),
                ];
            } else {
                if (is_array($value) && isset($value['name']) && isset($value['contents'])) {
                    $results[] = $value;
                } else {
                    $results[] = [
                        'name' => $field,
                        'contents' => $value
                    ];
                }
            }
        }

        return $results;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    protected function __toArray()
    {
        return array_map(function ($value) {
            if (is_object($value) && method_exists($value, 'toArray')) {
                return $value->toArray();
            } else {
                return $value;
            }
        }, parent::toArray());
    }

    /**
     * Get the instance as an array according to format.
     *
     * @return array
     */
    public function toArray()
    {
        if ($this->isMultipart()) {
            return $this->toMultipart();
        } else {
            return $this->__toArray();
        }
    }

    /**
     * Determine if it is multipart.
     *
     * @return bool
     */
    public function isMultipart()
    {
        return $this->is_multipart;
    }
}
