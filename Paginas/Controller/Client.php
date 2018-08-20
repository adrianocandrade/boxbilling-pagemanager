<?php

namespace Box\Mod\Paginas\Controller;

class Client implements \Box\InjectionAwareInterface
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
    
    public function register(\Box_App &$app)
    {
        $app->get('/paginas',             'get_index', array(), get_class($this));
        $app->get('/paginas/:slug',        'get_page', array('slug'), get_class($this));
    }

    public function get_page(\Box_App $app, $slug)
    {

        $api = $this->di['api_guest'];		
        $toArray = $this->di['db']->getAll("SELECT * FROM paginas_amv WHERE slug='".$slug."' AND active='0' ");
        $param['post'] = $toArray;

		$i=1;
		if(empty($toArray)) {
			$param = array();
			} else {
		$param['post'] = $toArray;
		}
        return $app->render('mod_paginas_article', $param);
    }


}