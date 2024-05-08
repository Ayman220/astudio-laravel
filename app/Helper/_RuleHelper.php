<?php


namespace App\Helper;


class _RuleHelper
{
    const _Rule_Require = 'required';
    const _Rule_Unique = 'unique';
    const _Rule_Require_without = 'required_without:';
    const _Rule_Email = 'email';
    const _Rule_Number = 'numeric';
    const _Rule_Date = 'date_format:Y-m-d';
    const _Rule_Date_Time = 'date_format:Y-m-d H:i:s';
    const _Rule_Time = 'date_format:H:i:s';
    const _Rule_After_Time = 'date_format:H:i:s|after:';
    const _Rule_Min = 'min:';
    const _Rule_Max = 'max:';

    const _RULE_LIST = [
        'user_store_rules' => [
            'first_name' => self::_Rule_Require,
            'date_of_birth' => self::_Rule_Date,
            'gender' => self::_Rule_Number . '|' . self::_Rule_Max . '3',
            'email' => self::_Rule_Require . '|' . self::_Rule_Email . '|' . self::_Rule_Unique . ':users',
            'password' => self::_Rule_Require . '|' . self::_Rule_Min . '6',
        ],
        'user_update_rules' => [
            'first_name' => self::_Rule_Require,
            'date_of_birth' => self::_Rule_Date,
            'gender' => self::_Rule_Number . '|' . self::_Rule_Max . '3',
        ],
        'project_rules' => [
            'name' => self::_Rule_Require,
            'department_id' => self::_Rule_Require,
            'start_date' => self::_Rule_Date,
            'end_date' => self::_Rule_Date,
            'status' => self::_Rule_Require . '|' . self::_Rule_Number . '|' . self::_Rule_Max . '4',
        ],
        'timesheet_rules' => [
            'task_name' => self::_Rule_Require,
            'date' => self::_Rule_Require . '|' . self::_Rule_Date,
            'hours' => self::_Rule_Require . '|' . self::_Rule_Number,
            'project_id' => self::_Rule_Require . '|' . self::_Rule_Number,
            'user_id' => self::_Rule_Require . '|' . self::_Rule_Number,
        ],
        'login_by_email' => [
            'email' => self::_Rule_Require . '|' . self::_Rule_Email,
            'password' => self::_Rule_Require . '|' . self::_Rule_Min . '6',
        ],
    ];

    public static function getRule($key)
    {
        return self::_RULE_LIST[$key];
    }
}
