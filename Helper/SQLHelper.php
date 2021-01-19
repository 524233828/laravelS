<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2019/1/28
 * Time: 16:25
 */

namespace Helper;


use Medoo\Medoo;

class SQLHelper extends Medoo
{
    public function __construct($options = null)
    {
        parent::__construct($options);
    }

    public function myWhere($where)
    {
        $where_clause = '';

        if (is_array($where))
        {
            $where_keys = array_keys($where);
            $where_AND = preg_grep("/^AND\s*#?$/i", $where_keys);
            $where_OR = preg_grep("/^OR\s*#?$/i", $where_keys);

            $single_condition = array_diff_key($where, array_flip(
                ['AND', 'OR', 'GROUP', 'ORDER', 'HAVING', 'LIMIT', 'LIKE', 'MATCH']
            ));

            if ($single_condition != [])
            {
                $condition = $this->dataImplode($single_condition, ' AND');

                if ($condition != '')
                {
                    $where_clause = ' WHERE ' . $condition;
                }
            }

            if (!empty($where_AND))
            {
                $value = array_values($where_AND);
                $where_clause = ' WHERE ' . $this->dataImplode($where[ $value[ 0 ] ], ' AND');
            }

            if (!empty($where_OR))
            {
                $value = array_values($where_OR);
                $where_clause = ' WHERE ' . $this->dataImplode($where[ $value[ 0 ] ], ' OR');
            }

            if (isset($where[ 'MATCH' ]))
            {
                $MATCH = $where[ 'MATCH' ];

                if (is_array($MATCH) && isset($MATCH[ 'columns' ], $MATCH[ 'keyword' ]))
                {
                    $columns = str_replace('.', '"."', implode($MATCH[ 'columns' ], '", "'));
                    $keywords = $this->quote($MATCH[ 'keyword' ]);

                    $where_clause .= ($where_clause != '' ? ' AND ' : ' WHERE ') . ' MATCH ("' . $columns . '") AGAINST (' . $keywords . ')';
                }
            }

            if (isset($where[ 'GROUP' ]))
            {
                $where_clause .= ' GROUP BY ' . $this->columnQuote($where[ 'GROUP' ]);

                if (isset($where[ 'HAVING' ]))
                {
                    $where_clause .= ' HAVING ' . $this->dataImplode($where[ 'HAVING' ], ' AND');
                }
            }

            if (isset($where[ 'ORDER' ]))
            {
                $ORDER = $where[ 'ORDER' ];

                if (is_array($ORDER))
                {
                    $stack = [];

                    foreach ($ORDER as $column => $value)
                    {
                        if (is_array($value))
                        {
                            $stack[] = 'FIELD(' . $this->columnQuote($column) . ', ' . $this->arrayQuote($value) . ')';
                        }
                        else if ($value === 'ASC' || $value === 'DESC')
                        {
                            $stack[] = $this->columnQuote($column) . ' ' . $value;
                        }
                        else if (is_int($column))
                        {
                            $stack[] = $this->columnQuote($value);
                        }
                    }

                    $where_clause .= ' ORDER BY ' . implode($stack, ',');
                }
                else
                {
                    $where_clause .= ' ORDER BY ' . $this->columnQuote($ORDER);
                }
            }

            if (isset($where[ 'LIMIT' ]))
            {
                $LIMIT = $where[ 'LIMIT' ];

                if (is_numeric($LIMIT))
                {
                    $where_clause .= ' LIMIT ' . $LIMIT;
                }

                if (
                    is_array($LIMIT) &&
                    is_numeric($LIMIT[ 0 ]) &&
                    is_numeric($LIMIT[ 1 ])
                )
                {
                    if ($this->database_type === 'pgsql')
                    {
                        $where_clause .= ' OFFSET ' . $LIMIT[ 0 ] . ' LIMIT ' . $LIMIT[ 1 ];
                    }
                    else
                    {
                        $where_clause .= ' LIMIT ' . $LIMIT[ 0 ] . ',' . $LIMIT[ 1 ];
                    }
                }
            }
        }
        else
        {
            if ($where != null)
            {
                $where_clause .= ' ' . $where;
            }
        }

        return $where_clause;
    }


}