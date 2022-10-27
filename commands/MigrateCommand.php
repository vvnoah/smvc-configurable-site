<?php
namespace cmd;

/**
 * executes migrations
 *
 * @author seger
 */

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use core\Application;
use Dotenv\Dotenv;

class MigrateCommand extends Command {
    protected $commandName = 'migrate';
    protected $commandDescription = "execute database migrations";
    protected $commandHelp = "this command executes the database migrations";
   
    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->setHelp($this->commandHelp)

        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            '',
            '<info>Database Migrations</>',
            '<info>===================</>',
        ]);

        // the value returned by someMethod() can be an iterator (https://secure.php.net/iterator)
        // that generates and returns the messages with the 'yield' PHP keyword
        //$output->writeln($this->someMethod());

        $config = [
            'application' => [
                'directory' => dirname(__DIR__).'/application',
            ],
            'db' => [
                'active' => $_ENV['DB_ACTIVE'] ?? false,
                'host' => $_ENV['DB_HOST'] ?? null,
                'name' => $_ENV['DB_NAME'] ?? null,
                'user' => $_ENV['DB_USER'] ?? '',
                'password' => $_ENV['DB_PASSWORD'] ?? '',
            ],
        ];
        $app = new Application($config);
        if (isset($app->db)){
            $app->db->migrate();
        }else{
            $output->writeln("can't execute migrations, there is no database connection");
        }
        return Command::SUCCESS;
    }
}
