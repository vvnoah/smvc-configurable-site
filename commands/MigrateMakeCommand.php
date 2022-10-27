<?php
namespace cmd;

/**
 * Description of MigrateMakeCommand
 *
 * @author seger
 */
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use core\Application;
use Dotenv\Dotenv;

class MigrateMakeCommand extends Command {
    protected $commandName = 'make:migration';
    protected $commandDescription = "create new migration";
    protected $commandHelp = "this command creates a new migration withd the given name";
   
    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->setHelp($this->commandHelp)
            ->addArgument('migration_name', InputArgument::REQUIRED, 'name of the migration.')
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            '',
            '<info>Create new database Migration</>',
            '<info>=============================</>',
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
        $migration = $input->getArgument('migration_name');
        $migrationFileName = $app->db->createNewMigration($migration);
        if ($migrationFileName === false){
            $output->writeln("<error>".$migration." already exists"."</error>");
        }else{
            $output->writeln("<info>".$migrationFileName."</info>");
        }
        //$output->writeln("<info>".$app->db->getDatePrefix()."_".$input->getArgument('migration_name')."</info>");
        return Command::SUCCESS;
    }

}
