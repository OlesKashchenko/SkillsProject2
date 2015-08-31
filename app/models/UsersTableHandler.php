<?php

class UsersTableHandler extends Yaro\TableBuilder\Handlers\CustomHandler 
{
    
    public function handleDeleteRow($id)
    {
        $user = \Sentry::findUserById($id);
        $user->delete();
        
        return array(
            'id'     => $id,
            'status' => true
        );
    } // end handleDeleteRow
    
    public function onInsertButtonFetch($def)
    {
        $url = URL::to(Config::get('table-builder::admin.uri') . '/tb/users/create');
        $caption = isset($def['caption']) ? $def['caption'] : 'Add';
        $html = '<a href="'. $url .'">
                 <button class="btn btn-default btn-sm" style="min-width: 66px;"
                         type="button">
                     '. $caption .'
                 </button>
                 </a>';
        
        return $html;
    } // end onInsertButtonFetch
    
}