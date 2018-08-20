<?php

namespace Box\Mod\Paginas\Api;

class Admin extends \Api_Abstract
{    

    public function active($data) {
		$this->di['db']->exec("UPDATE `paginas_amv` SET `active`='1' WHERE `id`='".$data['id']."'");
		
		return true;
	}
	
	public function delete($data) {
        $this->di['db']->exec("DELETE FROM `paginas_amv` WHERE `id`='".$data['id']."'");

		return true;
	}

	public function pagina_update($data) {
		$this->di['db']->exec("UPDATE `paginas_amv` SET `slug`='".$data['slug']."', `title`='".$data['name']."', `text`='".$data['message']."' WHERE `id`='".$data['id']."'");

		return true;
	}
	
	public function deactive($data) {
        $this->di['db']->exec("UPDATE `paginas_amv` SET `active`='0' WHERE `id`='".$data['id']."'");

		return true;
	}

	public function pagina_add($data) {
		$this->di['db']->exec("INSERT INTO  `paginas_amv` (
				`id` ,
                `slug` ,
				`title` ,
				`text` ,
				`date` ,
				`active`
				)
				VALUES (
				NULL ,  '".$data['slug']."', '".$data['name']."',  '".$data['message']."',  '".date("Y-m-d H:i:s")."',  '0'
				);");
		
		return true;
	}
}