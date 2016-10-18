<?php

class TranslatableModelAsController extends ModelAsController {

    /**
     * Does basically the same as it's parent class but does not bypass the locale filtering when choosing the SiteTree record.
     *
     * @return ContentController
     * @throws Exception If URLSegment not passed in as a request parameter.
     */
    public function getNestedController() {
        $request = $this->getRequest();

        if(!$URLSegment = $request->param('URLSegment')) {
            throw new Exception('ModelAsController->getNestedController(): was not passed a URLSegment value.');
        }

        // Select child page
        $conditions = array('"SiteTree"."URLSegment"' => rawurlencode($URLSegment));
        if(SiteTree::config()->nested_urls) {
            $conditions[] = array('"SiteTree"."ParentID"' => 0);
        }
        $sitetree = DataObject::get_one('SiteTree', $conditions);

        if(!$sitetree) {
            $response = ErrorPage::response_for(404);
            $this->httpError(404, $response ? $response : 'The requested page could not be found.');
        }

        // Enforce current locale setting to the loaded SiteTree object
        if(class_exists('Translatable') && $sitetree->Locale) Translatable::set_current_locale($sitetree->Locale);

        if(isset($_REQUEST['debug'])) {
            Debug::message("Using record #$sitetree->ID of type $sitetree->class with link {$sitetree->Link()}");
        }

        return self::controller_for($sitetree, $this->getRequest()->param('Action'));
    }
}