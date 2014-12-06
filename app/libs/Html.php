<?php

namespace Libs;

class Html
{
    /**
     * Make list options for dropdown select
     * 
     * @param array|$values List of option values, normaly a recordset from db
     * @param string|$valueField The key name of the array values that will be use for make value="" for the option
     * @param mixed|$labelField The key name of the array values that will be user for make label for the option
     * @param string|$labelTemplate IF the $labelField is array use this to make the label
     * 
     * @return array
     */ 
    public static function getListOptions(array $values, $valueField, $labelField, $labelTemplate = '%s')
    {
        $output = array();

        foreach ($values as $value) 
        {
            if (is_array($labelField))
            {
                $labelValues = array();

                foreach ($labelField as $field) 
                {
                    $labelValues[] = $value[$field];
                }
                
                $output[$value[$valueField]] = vsprintf($labelTemplate, $labelField);
            }
            else
            {
                $output[$value[$valueField]] = $value[$labelField];
            }
        }

        return $output;
    }
}