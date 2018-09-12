<?php

function check_user_permissions($request, $actionName = null, $id = null)
{
    $currentuser = $request->user();

    if($actionName)
    {
        $currentActionName =  explode('@',$actionName);

        $controller =  $currentActionName[0];
        $method = $currentActionName[1];
    }
    else
    {
        $controller = explode('-', kebab_case(class_basename(\Route::current()->controller)))[0];
    
        $method= explode('@', \Route::currentRouteAction())[1];
        
    }
    
    $crudpermissionmap = [
        'crud' => ['create', 'store', 'edit', 'update', 'destroy', 'restore', 'forceDestroy', 'index', 'view']
    ];
    $classesMap = [
        'blog' => 'post',
        'categories' => 'category',
        'users' => 'user'
    ];
    foreach($crudpermissionmap as $permission => $methods){
        if(in_array($method, $methods) && isset($classesMap[$controller]) ){
            $className = $classesMap[$controller];
            if($className == 'post' && in_array($method, ['edit', 'update', 'destroy', 'forceDestroy']))
            {
                $id = !is_null($id) ? $id : $request->route('blog');

                if( $id  &&
                    (!$currentuser->can('update-others-post') || !$currentuser->can('delete-others-post') ) )
                {
                    $post = App\Post::withTrashed()->find($id);
                    if($post->author_id !== $currentuser->id)
                    {
                       return false;
                    }
                    
                }
            }
            // if user hasn't perrmission don't allow next request
            elseif( ! $currentuser->can("{$permission}-{$className}") ){
                return false;
            }
            break;
            //dd("{$permission} {$className}");
        }
    }
    //dd($user);
    //dd(class_basename(\Route::current()->controller));

    return true;
}