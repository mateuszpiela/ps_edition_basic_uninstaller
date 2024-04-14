<?PHP
declare(strict_types=1);
if (!defined('_PS_VERSION_')) {
    exit;
}

class ps_edition_basic_uninstaller extends Module
{
	public function __construct()
	{
		$this->name = "ps_edition_basic_uninstaller";
		$this->tab = "administration";
		$this->version = "0.0.1";
		$this->author = "Mateusz Pieła";
		$this->need_instance = 0;
		$this->ps_versions_compliancy = ['min' => '8.0.0', 'max' => _PS_VERSION_];		
		$this->bootstrap = true;
		
		parent::__construct();
		
		$this->displayName = $this->trans('Prestashop Basic Edition Uninstaller', [], 'Modules.ps_edition_basic_uninstaller.Admin');
		$this->description = $this->trans('This module fixes not able to access the old dashboard after installing ps_edition_basic', [], 'Modules.ps_edition_basic_uninstaller.Admin');
	}
	
	public function install()
	{
		//TODO: Adding validation for checking if ps_edition_basic is installed
		
		//Remove parent from dashboard
		$tab = new \Tab(\Tab::getIdFromClassName('AdminDashboard'));
		$tab->id_parent = 0;
		$tab->save();
		$tab->updatePosition(false, 1);
		
		//Set admin dashboard as default for employee
		\Db::getInstance()->execute('UPDATE ' . _DB_PREFIX_ . "employee SET default_tab = '$tab->id';");
		
		return parent::install();
	}
	
	public function uninstall()
	{
		return parent::uninstall();
	}
}