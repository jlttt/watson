<?php

namespace jlttt\watson\Command;

use Symfony\Component\Console\Command\Command;

class FileSystemCommand extends Command
{
    protected function getUserHomePath()
    {
        $home = getenv('HOME');
        if (!empty($home)) {
            return rtrim($home, '/');
        }
        if (!empty($_SERVER['HOMEDRIVE']) && !empty($_SERVER['HOMEPATH'])) {
            $home = $_SERVER['HOMEDRIVE'] . $_SERVER['HOMEPATH'];
            return rtrim($home, '\\/');
        }
        return null;
    }

    protected function getUserWatsonFrameFile()
    {
        $userHomePath = $this->getUserHomePath();
        $userWatsonPath = $userHomePath . DIRECTORY_SEPARATOR . '.watson';
        if (!is_dir($userWatsonPath)) {
            mkdir($userWatsonPath, 0755);
        }
        return $userWatsonPath . DIRECTORY_SEPARATOR . 'frames.json';
    }
}
