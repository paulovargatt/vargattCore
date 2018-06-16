<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \Illuminate\Support\Facades\DB::table('permissions')->truncate();

        //Crud Post
        $crudPost = new Permission();
        $crudPost->name = "crud-post";
        $crudPost->save();

        //Update Others Post
        $updateOthersPosts = new Permission();
        $updateOthersPosts->name = "update-others-post";
        $updateOthersPosts->save();

        //Delete Others Post
        $deleteOthersPost = new Permission();
        $deleteOthersPost->name = "delete-others-post";
        $deleteOthersPost->save();

        //Crud Category
        $crudCategory = new Permission();
        $crudCategory->name = "crud-category";
        $crudCategory->save();

        //Crud User
        $crudUser = new Permission();
        $crudUser->name = "crud-user";
        $crudUser->save();

        //Attach roles Permission
        $admin = Role::whereName('admin')->first();
        $editor = Role::whereName('editor')->first();
        $author = Role::whereName('author')->first();

        $admin->detachPermissions([$crudPost, $updateOthersPosts, $deleteOthersPost, $crudCategory, $crudUser]);
        $admin->attachPermissions([$crudPost, $updateOthersPosts, $deleteOthersPost, $crudCategory, $crudUser]);

        $editor->detachPermissions([$crudPost, $updateOthersPosts, $deleteOthersPost,$crudCategory]);
        $editor->attachPermissions([$crudPost, $updateOthersPosts, $deleteOthersPost,$crudCategory]);

        $author->detachPermission($crudPost);
        $author->attachPermission($crudPost);
    }
}
