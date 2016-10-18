<?php

class TranslatableRootURLController extends RootURLController {

    /**
     * Ensures that TranslatableModelAsController is being used also for the root page(s).
     *
     * @param SS_HTTPRequest $request
     * @param DataModel|null $model
     * @return SS_HTTPResponse
     */
    public function handleRequest(SS_HTTPRequest $request, DataModel $model = null) {
        self::$is_at_root = true;

        $this->setDataModel($model);

        $this->pushCurrent();
        $this->init();

        if(!DB::is_active() || !ClassInfo::hasTable('SiteTree')) {
            $this->response = new SS_HTTPResponse();
            $this->response->redirect(Director::absoluteBaseURL() . 'dev/build?returnURL=' . (isset($_GET['url']) ? urlencode($_GET['url']) : null));
            return $this->response;
        }

        $request->setUrl(self::get_homepage_link() . '/');
        $request->match('$URLSegment//$Action', true);
        $controller = new TranslatableModelAsController();

        $result     = $controller->handleRequest($request, $model);

        $this->popCurrent();
        return $result;
    }
}