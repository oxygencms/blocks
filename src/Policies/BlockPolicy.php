<?php

namespace Oxygencms\Blocks\Policies;

use Oxygencms\Users\Models\User;
use Oxygencms\Core\Policies\BasePolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlockPolicy extends BasePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function index(User $user)
    {
        if ($user->can('see_blocks') || $user->can('manage_blocks')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create blocks.
     *
     * @param  \Oxygencms\Users\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->can('create_block') || $user->can('manage_blocks')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the block.
     *
     * @param  \Oxygencms\Users\Models\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        if ($user->can('update_block') || $user->can('manage_blocks')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the block.
     *
     * @param  \Oxygencms\Users\Models\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        if ($user->can('delete_block') || $user->can('manage_blocks')) {
            return true;
        }

        return false;
    }
}
