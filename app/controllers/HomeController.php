<?php

class HomeController extends BaseController
{
    private $result = array();
    private $resultHtml = '';
    private $isFound = false;

    private $clientsClasses = array(
        'DeliveryClient',
        'IntimeClient',
        'NpClient',
        'AutoLuxClient',
        'MeClient',
        'NeClient',
        'TntClient',
        'UpClient',
    );


    public function showAboutPage()
    {
        return View::make('about', array('result' => $this->resultHtml, 'ttn' => ''));
    } // end showAboutPage

    public function showWelcome()
    {
        return View::make('hello', array('result' => $this->resultHtml, 'ttn' => ''));
    } // end showWelcome

    public function showServicePage()
    {
        return View::make('service', array('result' => $this->resultHtml, 'ttn' => ''));
    } // end showServicePage

    public function getSavedDeliveryInfo()
    {
        $ids = Cookie::get('zd_ttn_numbers');

        $ttn = '';
        if ($ids) {
            //$this->formSearchResults($ids);
            $ttn = implode(' ', $ids);
        }

        return Response::json(
            array(
                'status'    => true,
                //'html'      => $this->resultHtml,
                'ttn'       => $ttn
            )
        );
    } // end getSavedDeliveryInfo

    public function getPreparedSearch()
    {
        $ids = Input::get('ids');

        if (!$ids) {
            throw new RuntimeException('Идентификаторы перевозки не получены');
        }

        Cookie::queue('zd_ttn_numbers', $ids, Settings::get('cookie_save_time'));

        foreach ($ids as $id) {
            $this->resultHtml .= View::make(
                'partials.results_waiting_table', compact('id')
            )->render();
        }

        return Response::json(
            array(
                'status'    => true,
                'html'      => $this->resultHtml
            )
        );
    } // end getPreparedSearch

    public function getDeliveryInfo()
    {
        $id = Input::get('id');

        if (!$id) {
            throw new RuntimeException('Идентификатор перевозки не получен');
        }

        $this->formSearchResult($id);

        return Response::json(
            array(
                'status'    => true,
                'html'      => $this->resultHtml
            )
        );
    } // end getDeliveryInfo

    public function removeTTN()
    {
        $id = Input::get('id');

        if (!$id) {
            throw new RuntimeException;
        }

        $idsCookie = Cookie::get('zd_ttn_numbers');

        if (($key = array_search($id, $idsCookie)) !== false) {
            unset($idsCookie[$key]);
        }

        Cookie::queue('zd_ttn_numbers', $idsCookie, Settings::get('cookie_save_time'));

        return Response::json(array('status' => true));
    } // end removeTTN

    public function showLoginPage() {

        return View::make('login');
    } // end showLoginPage

    public function showRegPage() {

        return View::make('reg');
    } // end showRegPage

    public function showUserCabinet() {
        return View::make('cabinet');
    } // end showUserCabinet

    public function showPreloader()
    {
        return View::make('preloader');
    } // end showPreloader

    private function formSearchResult($id)
    {
        $this->isFound = false;

        foreach ($this->clientsClasses as $clientClass) {
            $this->renderClient($clientClass, $id);
        }

        if (!$this->isFound) {
            $this->resultHtml .= View::make(
                'partials.no_results', array('result' => $this->result, 'identifier' => $id)
            )->render();
        }

        /*
        $savedNumbers = Cookie::get('zd_ttn_numbers');
        if (!is_array($savedNumbers)) {
            $savedNumbers = array();
        }

        if (!in_array($id, $savedNumbers)) {
            $savedNumbers[] = $id;
        }

        Cookie::queue('zd_ttn_numbers', $savedNumbers, Settings::get('cookie_save_time'));
        */
    } // end formSearchResult

    private function renderClient($client, $id)
    {
        $client = new $client();
        $client->buildRequestData($id);
        $client->sendRequest();

        if ($client->formResult()) {
            $this->isFound = true;
            $this->result = $client->getResult();
            $this->renderSearchResult($id);
        }
    } // end renderClient

    private function renderSearchResult($id)
    {
        if ($this->result && Sentry::check()) {
            $existedItem = CheckLog::where('id_user', Sentry::getUser()->id)->where('identifier', $id)->first();
            if (!$existedItem) {
                CheckLog::create(array(
                    'id_user'       => Sentry::getUser()->id,
                    'identifier'    => $id,
                    'log'           => json_encode($this->result),
                    'created_at'    => date("Y-m-d H:i:s"),
                    'update_at'     => date("Y-m-d H:i:s")
                ));
            } else {
                $existedItem->log           = json_encode($this->result);
                $existedItem->updated_at    = date("Y-m-d H:i:s");

                $existedItem->save();
            }
        }

        $this->resultHtml .= View::make(
            'partials.results_table',
            array(
                'result'        => $this->result,
                'fieldNames'    => Util::getFieldNames()
            )
        )->render();
    } // end renderSearchResult
}
