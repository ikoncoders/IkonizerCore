<?php
declare(strict_types=1);

namespace IkonizerCore\Base\Events;

class EventLogger
{

    /* @var array defines the database event log columns */
    public const LOG_FIELDS = [
        'event_log_name',
        'event_type',
        'user',
        'method',
        'source',
        'event_context',
        'event_browser',
        'IP',
    ];

    public const INFORMATION = 'information';
    public const WARNING = 'warning';
    public const CRITICAL = 'critical';
    public const ERROR = 'error';
    public const SYSTEM = 'system';

}