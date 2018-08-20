<?php

namespace Box\Mod\Paginas\Controller;

class Admin implements \Box\InjectionAwareInterface
{

    protected $di;

    /**
     * @param mixed $di
     */
    public function setDi($di)
    {
        $this->di = $di;
    }

    /**
     * @return mixed
     */
    public function getDi()
    {
        return $this->di;
    }
    
    public function fetchNavigation()
    {
        return array(
            'group'  =>  array(
                'index'     => 1511,                // menu sort order
                'location'  =>  'paginas',          // menu group identificator for subitems
                'label'     => 'Paginas',    // menu group title
                'class'     => 'iFlag',           // used for css styling menu item
            ),
            'subpages'=> array(
                array(
                    'location'  => 'paginas', // place this module in extensions group
                    'label'     => 'Paginas',
                    'index'     => 1511,
                    'uri'       => $this->di['url']->adminLink('paginas'),
                    'class'     => 'iFlag',
                ),
                array(
                    'location'  => 'add', // place this module in extensions group
                    'label'     => 'Adicionar',
                    'index'     => 1511,
                    'uri'       => $this->di['url']->adminLink('paginas/add'),
                    'class'     => 'iFlag',
                ),
            ),
        );
    }

    /**
     * Methods maps admin areas urls to corresponding methods
     * Always use your module prefix to avoid conflicts with other modules
     * in future
     *
     *
     * @example $app->get('/example/test',      'get_test', null, get_class($this)); // calls get_test method on this class
     * @example $app->get('/example/:id',        'get_index', array('id'=>'[0-9]+'), get_class($this));
     * @param Box_App $app
     */
    public function register(\Box_App &$app)
    {
        $app->get('/paginas',             'get_index', array(), get_class($this));
        $app->get('/paginas/add',             'get_add', array(), get_class($this));
        $app->get('/paginas/pagina/:id',  'get_page', array('id'=>'[0-9]+'), get_class($this));
    }

    public function get_index(\Box_App $app)
    {
        // always call this method to validate if admin is logged in
        $this->di['is_admin_logged'];
        $api = $this->di['api_admin'];

        $toArray = $this->di['db']->getAll("SELECT * FROM paginas_amv");
        
		$i=1;
		if(empty($toArray)) {
			$param = array();
			} else {
		$param['paginas'] = $toArray;
		}

        return $app->render('mod_paginas_index', $param);
    }

    public function get_add(\Box_App $app)
    {
        $this->di['is_admin_logged'];

        return $app->render('mod_pagina_add');
    }

    public function get_page(\Box_App $app, $id)
    {
        $this->di['is_admin_logged'];
        $api = $this->di['api_admin'];

        $toArray = $this->di['db']->getAll("SELECT * FROM paginas_amv WHERE id='$id'");
        
		$i=1;
		if(empty($toArray)) {
			$param = array();
			} else {
		$param['post'] = $toArray;
		}
        return $app->render('mod_paginas_article', $param);
    }

}