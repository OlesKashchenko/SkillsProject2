<?php

use Yaro\TableBuilder\Handlers\CustomHandler;


class EmailsTableHandler extends CustomHandler {

    public function onUpdateFastRowResponse(array &$response)
    {
        $this->removeTemplate($response['values']['ident']);

        Cache::forget('settings');
    } // end onUpdateFastRowResponse

    public function onUpdateRowResponse(array &$response)
    {
        $this->removeTemplate($response['values']['ident']);
        $def = $this->controller->getDefinition();
        EventsBackend::log(array(
            'ident' => $def['db']['table'] .'_update',
            'object_table' => $def['db']['table'],
            'object_id' => Input::get('id')
        ));
        Cache::forget('settings');
    } // end onUpdateRowResponse

    public function onInsertRowResponse(array &$response)
    {
        $this->removeTemplate($response['values']['ident']);
        $def = $this->controller->getDefinition();
        EventsBackend::log(array(
            'ident' => $def['db']['table'] .'_insert',
            'object_table' => $def['db']['table'],
            'object_id' => Input::get('id')
        ));
        Cache::forget('settings');
    } // end onInsertRowResponse

    public function onDeleteRowResponse(array &$response)
    {
        $this->removeTemplate($response['values']['ident']);
        $def = $this->controller->getDefinition();
        EventsBackend::log(array(
            'ident' => $def['db']['table'] .'_delete',
            'object_table' => $def['db']['table'],
            'object_id' => Input::get('id')
        ));
        Cache::forget('settings');
    } // end onDeleteRowResponse
    
    private function removeTemplate($template)
    {
        $subject = app_path() . '/views/emails/templates/' . $template . '_subject.blade.php';
        $body = app_path() . '/views/emails/templates/' . $template . '_body.blade.php';

        if (file_exists($subject)) {
            unlink($subject);
        }

        if (file_exists($body)) {
            unlink($body);
        }
    }
}