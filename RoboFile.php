<?php

use Robo\ResultData;
use Robo\Tasks;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Custom RoboFile commands for this project.
 *
 * @param InputInterface $input
 * @param OutputInterface $output
 *
 * @class RoboFile
 */
class RoboFile extends Tasks
{
    /**
     * Placeholder for your own project's commands.
     *
     * @command drupal-project:custom-command
     *
     * @return void
     *
     * @throws \Exception
     */
    public function customCommand(InputInterface $input, OutputInterface $output): void
    {
        $io = new SymfonyStyle($input, $output);
        $io->comment('This is just a placeholder command, please add your own custom commands here. Please edit : ' . __FILE__);
    }

    /**
     * Generate a static site from Drupal with Tome.
     *
     * @command drupal-project:static
     *
     * @aliases static
     *
     * @param bool $incremental
     *   (Default false) If only content changes have happened, you can set this to 1 to make
     *   this command faster.
     * @param bool $start_server
     *   (Default true) Start an HTTP server with node.
     *
     * @return \Robo\ResultData
     */
    public function static(
        InputInterface $input,
        OutputInterface $output,
        bool $incremental = FALSE,
        bool $start_server = TRUE,
    ): ResultData
    {
        $io = new SymfonyStyle($input, $output);
        if (!$incremental && is_dir("html")) {
            $io->info('Removing pre-existing static site.');
            $this->_cleanDir("html");
        } else {
            $io->info('Doing an incremental update');
        }

        $this->_exec('./drush.sh tome:static');
        if ($start_server) {
            $this->_exec('npm install && npx http-server html');
        }

        return new ResultData();
    }


    /**
     * Export default content.
     *
     * @command drupal-project:export-content
     *
     * @aliases export-content
     *
     * @return \Robo\ResultData
     *
     * @throws \Exception
     */
    public function exportContent(
        InputInterface $input,
        OutputInterface $output,
        array $opts = [
            'path' => 'modules/custom/default_content_config',
            'entities' => [
                'node',
                'menu_link_content',
                'media',
                'redirect',
                'user',
                'config_pages',
                'taxonomy_term',
            ],
        ]
    ): ResultData
    {

        $path =  $opts['path'];
        $entities = $opts['entities'];
        $io = new SymfonyStyle($input, $output);
        if (is_dir("web/$path/content")) {
            $io->info('Removing existing default content exported.');
            $this->_cleanDir("web/$path/content");
        }
        foreach ($entities as $entity) {
            $io->info("Exporting $entity as default content");
            $this->_exec("./drush.sh default-content:export-references $entity --folder=$path/content");
        }
        $io->info("Finished exporting default content to $path/content");

        return new ResultData();
    }


}
