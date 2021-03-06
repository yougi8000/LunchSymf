<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200602184200 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(10) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, sex VARCHAR(20) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, birthday DATETIME DEFAULT NULL, since DATETIME DEFAULT NULL, roles LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', love VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, is_pro TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, resume LONGTEXT DEFAULT NULL, is_liked TINYINT(1) DEFAULT NULL, INDEX IDX_23A0E6612469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, category_restaurant_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, category VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, design VARCHAR(255) NOT NULL, kitchen VARCHAR(255) NOT NULL, year INT DEFAULT NULL, plat_jour VARCHAR(255) DEFAULT NULL, entree VARCHAR(255) DEFAULT NULL, plat VARCHAR(255) DEFAULT NULL, dessert VARCHAR(255) DEFAULT NULL, likes INT DEFAULT NULL, drinks VARCHAR(255) DEFAULT NULL, promotion VARCHAR(255) DEFAULT NULL, waste VARCHAR(255) DEFAULT NULL, recipe VARCHAR(255) DEFAULT NULL, openhours VARCHAR(255) DEFAULT NULL, profile VARCHAR(255) DEFAULT NULL, INDEX IDX_EB95123FAF3C5525 (category_restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, author VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_9474526C7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post_like (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_653627B84B89032C (post_id), INDEX IDX_653627B8A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_restaurant (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_CD8B424112469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES article_category (id)');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123FAF3C5525 FOREIGN KEY (category_restaurant_id) REFERENCES category_restaurant (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE post_like ADD CONSTRAINT FK_653627B84B89032C FOREIGN KEY (post_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE post_like ADD CONSTRAINT FK_653627B8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE category_restaurant ADD CONSTRAINT FK_CD8B424112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post_like DROP FOREIGN KEY FK_653627B8A76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7294869C');
        $this->addSql('ALTER TABLE post_like DROP FOREIGN KEY FK_653627B84B89032C');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6612469DE2');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123FAF3C5525');
        $this->addSql('ALTER TABLE category_restaurant DROP FOREIGN KEY FK_CD8B424112469DE2');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_category');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE post_like');
        $this->addSql('DROP TABLE category_restaurant');
        $this->addSql('DROP TABLE category');
    }
}
