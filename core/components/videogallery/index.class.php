<?php

/**
 * Class videoGalleryMainController
 */
abstract class videoGalleryMainController extends modExtraManagerController
{
    /** @var videoGallery $vg */
    public $vg;

    /**
     * @return void
     */
    public function initialize()
    {
        $corePath = $this->modx->getOption('videogallery_core_path', null, $this->modx->getOption('core_path') . 'components/videogallery/');
        require_once $corePath . 'model/videogallery/videogallery.class.php';

        $this->vg = new videoGallery($this->modx);
        $this->addCss($this->vg->config['cssUrl'] . 'mgr/default.css');
        $this->addJavascript($this->vg->config['jsUrl'] . 'mgr/videogallery.js');
        $this->addHtml('
		<script type="text/javascript">
			videoGallery.config = ' . $this->modx->toJSON($this->vg->config) . ';
			videoGallery.config.connector_url = "' . $this->vg->config['connectorUrl'] . '";
		</script>
		');

        parent::initialize();
    }

    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return array('videogallery:default');
    }

    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }
}

/**
 * Class IndexManagerController
 */
class IndexManagerController extends videoGalleryMainController
{
    /**
     * @return string
     */
    public static function getDefaultController()
    {
        return 'home';
    }
}