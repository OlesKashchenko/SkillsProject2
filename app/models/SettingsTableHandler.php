<?php

class SettingsTableHandler extends Yaro\TableBuilder\Helpers\TableHandlers\Settings 
{
    public function onUpdateRowResponse(array &$response)
    {
        $def = $this->controller->getDefinition();
        /*
        EventsBackend::log(array(
            'ident' => $def['db']['table'] .'_update',
            'object_table' => $def['db']['table'],
            'object_id' => Input::get('id')
        ));
        */
        Cache::forget('settings');
    } // end onUpdateRowResponse
    
    public function onInsertRowResponse(array &$response)
    {
        $def = $this->controller->getDefinition();
        /*
        EventsBackend::log(array(
            'ident' => $def['db']['table'] .'_insert',
            'object_table' => $def['db']['table'],
            'object_id' => Input::get('id')
        ));
        */
        Cache::forget('settings');
    } // end onInsertRowResponse
    
    public function onDeleteRowResponse(array &$response)
    {
        $def = $this->controller->getDefinition();
        /*
        EventsBackend::log(array(
            'ident' => $def['db']['table'] .'_delete',
            'object_table' => $def['db']['table'],
            'object_id' => Input::get('id')
        ));
        */
        Cache::forget('settings');
    } // end onDeleteRowResponse
}
