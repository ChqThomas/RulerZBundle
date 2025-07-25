<?php

declare(strict_types=1);

namespace KPhoen\RulerZBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Clear the cache.
 *
 * @author Kévin Gomez <contact@kevingomez.fr>
 */
class CacheClearCommand extends Command
{
    private $cacheDir;

    private $filesystem;

    public function __construct(
        $cacheDir,
        $filesystem
    ) {
        parent::__construct();

        $this->cacheDir = $cacheDir;
        $this->filesystem = $filesystem;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this
            ->setName('rulerz:cache:clear')
            ->setDescription("Clear RulerZ's cache")
        ;
    }

    /**
     * {@inheritdoc}
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $cacheDir = $this->cacheDir;
        $filesystem = $this->filesystem;

        if (!is_writable($cacheDir)) {
            throw new \RuntimeException(sprintf('Unable to write in the "%s" directory', $cacheDir));
        }

        if ($filesystem->exists($cacheDir)) {
            $filesystem->remove($cacheDir);
            $filesystem->mkdir($cacheDir);
        }
        
        return Command::SUCCESS;
    }
}
