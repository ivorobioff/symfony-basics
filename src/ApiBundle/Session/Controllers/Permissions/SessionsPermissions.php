<?php
namespace ApiBundle\Session\Controllers\Permissions;
use ApiBundle\Session\Protectors\OwnerProtector;
use ImmediateSolutions\Support\Permissions\AbstractActionsPermissions;

/**
 * @author Igor Vorobiov<igor.vorobioff@gmail.com>
 */
class SessionsPermissions extends AbstractActionsPermissions
{
    /**
     * @return array
     */
    protected function permissions()
    {
        return [
            'store' => 'all',
            'show' => OwnerProtector::class,
            'destroy' => OwnerProtector::class,
            'refresh' => OwnerProtector::class
        ];
    }
}