<?php
declare(strict_types=1);

namespace IkonizerCore\Base\Nodes;

class PermissionNodes
{

    /**
     * These permission nodes must be in the right order to prevent conflict or mis-alignment
     * i.e the index position of both constants must match ie. we will change the index string
     * from the permission_search constant with the string view inside the permission_search
     * constants
     */
    public const PERMISSION_SEARCHES = [
        'index',
        'new',
        'settings',
        'hardDelete',
        'changeRow',
        'chooseBulk',
        'notes',
        'preferences',
        'privilege',
        'log'
    ];

    public const PERMISSION_REPLACE = [
        'view',
        'add',
        'manage_settings',
        'hard_delete',
        'change_row',
        'manage_bulk',
        'manage_notes',
        'manage_preferences',
        'manage_privilege',
        'manage_log'
    ];

}