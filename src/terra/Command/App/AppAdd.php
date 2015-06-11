<?php

namespace terra\Command\App;

use terra\Command\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;

class AppAdd extends Command
{
  protected function configure()
  {
    $this
      ->setName('app:add')
      ->setDescription('Adds a new app.')
      ->addArgument(
        'name',
        InputArgument::OPTIONAL,
        'The name of your app.'
      )
      ->addArgument(
        'repo',
        InputArgument::OPTIONAL,
        'The URL of your git repo for your app.'
      )
      ->addOption(
        'description',
        '',
        InputArgument::OPTIONAL,
        'The description of your app.'
      )
      ->addOption(
        'create-environment',
        '',
        InputArgument::OPTIONAL,
        'Whether or not to create an environment.'
      )
      ->addOption(
        'environment-name',
        '',
        InputArgument::OPTIONAL,
        'If creating an environment, you can optionally specify a name.'
      )
    ;
  }
  protected function execute(InputInterface $input, OutputInterface $output)
  {

    // Questions.
    $name_question = new Question('System name of your project? ', '');
    $description_question = new Question('Description? ', '');
    $repo_question = new Question('Source code repository URL? ', '');

    // Prompts.
    $name = $this->getAnswer($input, $output, $name_question, 'name');
    $description = $this->getAnswer($input, $output, $description_question, 'description', 'option');
    $repo = $this->getAnswer($input, $output, $repo_question, 'repo');

    // Confirmation
    $output->writeln("Name: $name");
    $output->writeln("Description: $description");
    $output->writeln("Repo: $repo");

    $app = $this->getApplication()->getTerra();
  }
}