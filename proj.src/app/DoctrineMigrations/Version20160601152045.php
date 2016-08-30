<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160601152045 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $imagesPerAlbum = 5;
        for($i = 1; 5 >= $i; $i++){
            $this->addSql(sprintf("INSERT INTO `%s` (`id`, `album_name`, `created`) VALUES ('%d', '%s', '%s')", 'albums', $i, 'album'.$i, date('Y-m-d G:i:s', time())));
            
            for($j = 1; $imagesPerAlbum >= $j; $j++){
                $this->addSql(sprintf("INSERT INTO `%s` (`image_name`, `album_id`, `created`) VALUES ('%s', '%s', '%s')", 
                    'images', 
                    'favicon.ico', 
                    $i,
                    date('Y-m-d G:i:s', time()
                )));
            }
            
            $imagesPerAlbum += 15;
        }
        
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DELETE FROM `images` WHERE 1');
        $this->addSql('DELETE FROM `albums` WHERE 1');
    }
}
