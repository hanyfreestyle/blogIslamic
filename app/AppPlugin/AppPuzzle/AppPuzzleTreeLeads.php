<?php

namespace App\AppPlugin\AppPuzzle;

class AppPuzzleTreeLeads {


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #  ModelTree
    static function LeadsTree() {
        $modelTree = [
            'LeadsNewsLetter' => self::treeLeadsNewsLetter(),
            'LeadsContactUs' => self::treeLeadsContactUs(),
        ];
        return $modelTree;
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #
    static function treeLeadsNewsLetter() {
        return [
            'view' => true,
            'id' => "LeadsNewsLetter",
            'CopyFolder' => "LeadsNewsLetter",
            'appFolder' => 'Leads/NewsLetter',
            'viewFolder' => 'LeadsNewsLetter',
            'routeFolder' => "leads/",
            'routeFile' => 'newsLetter.php',
            'migrations' => ['2019_12_14_000010_create_news_letters_table.php'],
            'seeder' => ['leads_news_letters.sql'],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['leadsNewsLetter.php'],
            'webLangFolder' => "web/",
            'webLangFiles' => ['newsletter.php'],
            'livewireClass' => ['Site' => 'NewsLetterForm.php'],
            'livewireView' => ['site' => 'news-letter-form.blade.php'],
        ];
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #   treeLeadsContactUs
    static function treeLeadsContactUs() {
        return [
            'view' => true,
            'id' => "LeadsContactUs",
            'CopyFolder' => "LeadsContactUs",
            'infoFile' => "LeadsContactUs.txt",
            'appFolder' => 'Leads/ContactUs',
            'viewFolder' => 'LeadsContactUs',
            'routeFolder' => "leads/",
            'routeFile' => 'contactUs.php',
            'migrations' => ['2019_12_14_000013_create_contact_us_forms_table.php'],
            'seeder' => ['leads_contact_us.sql'],
            'adminLangFolder' => "admin/",
            'adminLangFiles' => ['leadsContactUs.php'],
        ];
    }


}
