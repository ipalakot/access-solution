<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220153042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE category CHANGE titel title VARCHAR(50) NOT NULL, CHANGE content description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4584665A');
        $this->addSql('DROP INDEX IDX_9474526C4584665A ON comment');
        $this->addSql('ALTER TABLE comment ADD content VARCHAR(255) DEFAULT NULL, DROP product_id, DROP titel, DROP message');
        $this->addSql('ALTER TABLE image ADD title VARCHAR(50) NOT NULL, DROP titel');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADB20B8284');
        $this->addSql('DROP INDEX IDX_D34A04ADB20B8284 ON product');
        $this->addSql('ALTER TABLE product ADD title VARCHAR(50) NOT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, DROP titel, DROP une, CHANGE category_of_product_id category_shop_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD8ACE84A3 FOREIGN KEY (category_shop_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD8ACE84A3 ON product (category_shop_id)');
        $this->addSql('ALTER TABLE user DROP full_name, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE utilisateur ADD full_name VARCHAR(50) NOT NULL, ADD delivery_address VARCHAR(100) NOT NULL, ADD zip_code VARCHAR(10) NOT NULL, ADD city VARCHAR(50) NOT NULL, ADD phone_number VARCHAR(30) DEFAULT NULL, ADD user_id INT NOT NULL, DROP first_name, DROP last_name, DROP delivery_adress, DROP postal_code, DROP locality, DROP telephone_number, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3E7927C74 ON utilisateur (email)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3A76ED395 ON utilisateur (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, headers LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, queue_name VARCHAR(190) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE category CHANGE title titel VARCHAR(50) NOT NULL, CHANGE description content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD product_id INT DEFAULT NULL, ADD titel VARCHAR(50) NOT NULL, ADD message LONGTEXT NOT NULL, DROP content');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9474526C4584665A ON comment (product_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD8ACE84A3');
        $this->addSql('DROP INDEX IDX_D34A04AD8ACE84A3 ON product');
        $this->addSql('ALTER TABLE product ADD titel VARCHAR(100) NOT NULL, ADD une TINYINT(1) DEFAULT NULL, DROP title, DROP created_at, DROP updated_at, CHANGE category_shop_id category_of_product_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADB20B8284 FOREIGN KEY (category_of_product_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D34A04ADB20B8284 ON product (category_of_product_id)');
        $this->addSql('ALTER TABLE image ADD titel VARCHAR(255) NOT NULL, DROP title');
        $this->addSql('ALTER TABLE user ADD full_name VARCHAR(50) NOT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3A76ED395');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3E7927C74 ON utilisateur');
        $this->addSql('DROP INDEX IDX_1D1C63B3A76ED395 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL, ADD delivery_adress VARCHAR(255) NOT NULL, ADD postal_code INT DEFAULT NULL, ADD locality VARCHAR(255) NOT NULL, ADD telephone_number INT DEFAULT NULL, DROP full_name, DROP delivery_address, DROP zip_code, DROP city, DROP phone_number, DROP user_id, CHANGE email email VARCHAR(255) NOT NULL');
    }
}
