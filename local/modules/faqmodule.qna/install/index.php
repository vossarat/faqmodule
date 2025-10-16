<?php
use Bitrix\Main\Application;
use Bitrix\Main\ModuleManager;

class faqmodule_qna extends CModule
{
    public $MODULE_ID = 'faqmodule.qna';
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME = 'Вопрос-ответ';
    public $MODULE_DESCRIPTION = 'Модуль "Вопрос-ответ".';

    public function __construct()
    {
        include __DIR__.'/version.php';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
    }

    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->InstallDB();
        $this->InstallFiles();
        return true;
    }

    public function DoUninstall()
    {
        $this->UnInstallFiles();
        $this->UnInstallDB();
        ModuleManager::unRegisterModule($this->MODULE_ID);
        return true;
    }

    public function InstallDB()
    {
        $conn = Application::getConnection();
        if (!$conn->isTableExists('b_faqmodule_qna')) {
            $conn->queryExecute("
                CREATE TABLE IF NOT EXISTS b_faqmodule_qna (
                  ID int(11) NOT NULL AUTO_INCREMENT,
                  ACTIVE char(1) NOT NULL DEFAULT 'Y',
                  QUESTION varchar(1000) NOT NULL,
                  ANSWER mediumtext NOT NULL,
                  SORT int(11) NOT NULL DEFAULT '500',
                  DATE_CREATE datetime NULL,
                  PRIMARY KEY (ID),
                  KEY IX_SORT (SORT, ACTIVE)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
            ");
        }
        \Bitrix\Main\Config\Option::set($this->MODULE_ID, 'PADDING_TOP', '40');
        \Bitrix\Main\Config\Option::set($this->MODULE_ID, 'PADDING_BOTTOM', '40');
        return true;
    }

    public function UnInstallDB()
    {
        \Bitrix\Main\Config\Option::delete($this->MODULE_ID);
        return true;
    }

    public function InstallFiles()
    {
        CopyDirFiles(__DIR__.'/admin', $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin', true, true);
        return true;
    }

    public function UnInstallFiles()
    {
        DeleteDirFiles(__DIR__.'/admin', $_SERVER['DOCUMENTORY_ROOT'].'/bitrix/admin'); 
        return true;
    }
}
