<?php
namespace Concrete\Core\Updater\Migrations\Migrations;

use Concrete\Core\Updater\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Concrete\Core\Entity\Attribute\Key\Settings\DateTimeSettings;
use Concrete\Core\Page\Page;
use SinglePage;
use Concrete\Core\Support\Facade\Application;

class Version20170202000000 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $app = Application::getFacadeApplication();
        $sp = Page::getByPath('/dashboard/system/files/thumbnails/options');
        if (!is_object($sp) || $sp->isError()) {
            $sp = SinglePage::add('/dashboard/system/files/thumbnails/options');
            $sp->update(['cName' => 'Thumbnail Options']);
            $sp->setAttribute('exclude_nav', true);
            $sp->setAttribute('meta_keywords', 'thumbnail, format, png, jpg, jpeg, quality, compression, gd, imagick, imagemagick, transparency');
        }
        $this->refreshEntities([
            DateTimeSettings::class,
        ]);
        $config = $app->make('config');
        if (!$config->get('app.curl.verifyPeer')) {
            $config->save('app.http_client.sslverifypeer', false);
        }
    }

    public function down(Schema $schema)
    {
    }
}
