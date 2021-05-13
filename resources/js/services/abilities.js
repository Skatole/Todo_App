import { defineAbility } from '@casl/ability';



export default (user) => defineAbility((can, cannot) => {
    if (user.isLoggedIn) {
        if (user.role === 'Admin') {
            can('manage', 'all');
            can('edit posts', 'Post');
            can('delete posts', 'Post');
            can('do posts', 'Post');
            can('add posts', 'Post');
            can('delete', 'User');
        }
        if (user.role === 'Developer') {
            can('edit posts', 'Post');
            can('delete posts', 'Post');
            can('do posts', 'Post');
            can('add posts', 'Post');
            cannot('delete', 'User');
        }
        if (user.role === 'Manager') {
            can('edit posts', 'Post');
            can('delete posts', 'Post');
            can('add posts', 'Post');
            cannot('delete', 'User');
        }
    }
});

