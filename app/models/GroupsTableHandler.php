<?php

class GroupsTableHandler extends Yaro\TableBuilder\Handlers\CustomHandler 
{
    
    public function handleDeleteRow($id)
    {
        $group = \Sentry::findGroupById($id);
        $group->delete();
        
        return array(
            'id'     => $id,
            'status' => true
        );
    } // end handleDeleteRow
    
    public function onInsertButtonFetch($def)
    {
        $url = URL::to(Config::get('table-builder::admin.uri') . '/tb/groups/create');
        $caption = isset($def['caption']) ? $def['caption'] : 'Add';
        $html = '<a href="'. $url .'">
                <button class="btn btn-default btn-sm" style="min-width: 66px;"
                         type="button">
                     '. $caption .'
                 </button>
                 </a>';
        
        return $html;
    } // end onInsertButtonFetch
    
            
    public function onUpdateRowResponse(array &$response)
    {
        $def = $this->controller->getDefinition();
        EventsBackend::log(array(
            'ident' => $def['db']['table'] .'_update',
            'object_table' => $def['db']['table'],
            'object_id' => Input::get('id')
        ));
    } // end onUpdateRowResponse
    
    public function onInsertRowResponse(array &$response)
    {
        $def = $this->controller->getDefinition();
        EventsBackend::log(array(
            'ident' => $def['db']['table'] .'_insert',
            'object_table' => $def['db']['table'],
            'object_id' => Input::get('id')
        ));
    } // end onInsertRowResponse
    
    public function onDeleteRowResponse(array &$response)
    {
        $def = $this->controller->getDefinition();
        EventsBackend::log(array(
            'ident' => $def['db']['table'] .'_delete',
            'object_table' => $def['db']['table'],
            'object_id' => Input::get('id')
        ));
    } // end onDeleteRowResponse
    
}