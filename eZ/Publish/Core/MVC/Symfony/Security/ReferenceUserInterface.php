<?php

/**
 * File containing the ReferenceUserInterface class.
 *
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace eZ\Publish\Core\MVC\Symfony\Security;

/**
 * Interface for Repository based users, where we only serialize user id / Reference in session values.
 *
 * Can be used if UserProvider calls {@link setAPIUser()} during refresh stage, before object is further used. Calls
 * to {@link getAPIUser()} before that will result in an logic exception.
 */
interface ReferenceUserInterface extends UserInterface
{
    /**
     * @return \eZ\Publish\API\Repository\Values\User\UserReference
     */
    public function getAPIUserReference();

    /**
     * @throws \LogicException If {@link setAPIUser()} has not been called yet after session wake up.
     *
     * @return \eZ\Publish\API\Repository\Values\User\User
     */
    public function getAPIUser();
}
