<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
use Laratrust\Traits\LaratrustRoleTrait;

class PermissionsTableSeeder extends Seeder
{
    use LaratrustRoleTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        Permission::truncate();

        $crudPost = new Permission();
        $crudPost->name = 'crud-post';
        $crudPost->save();

        $updateOthersPost = new Permission();
        $updateOthersPost->name = 'update-others-post';
        $updateOthersPost->save();

        $deleteOthersPost = new Permission();
        $deleteOthersPost->name = 'delete-others-post';
        $deleteOthersPost->save();


        $crudCategory = new Permission();
        $crudCategory->name = 'crud-category';
        $crudCategory->save();

        $crudCUser = new Permission();
        $crudCUser->name = 'crud-user';
        $crudCUser->save();

        $admin = Role::whereName('admin')->first();
        $editor = Role::whereName('editor')->first();
        $author = Role::whereName('author')->first();
        
        $admin->detachPermissions([
            $crudPost, $updateOthersPost, 
            $deleteOthersPost, $crudCategory, $crudCUser
        ]);
        $admin->attachPermissions([
            $crudPost, $updateOthersPost, 
            $deleteOthersPost, $crudCategory, $crudCUser
        ]);

        $editor->detachPermissions([
            $crudPost, $updateOthersPost, 
            $deleteOthersPost, $crudCategory
        ]);
        $editor->attachPermissions([
            $crudPost, $updateOthersPost, 
            $deleteOthersPost, $crudCategory
        ]);

        $author->detachPermission($crudPost);
        $author->attachPermission($crudPost); 

    }
}
