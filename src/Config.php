<?php

namespace Vx;

use Vx\Exception\ViewElementException;

class Config
{
    private $settings;

    public function __construct(array $settings = [])
    {
        if (isset($settings['viewDir'])) {
            $this->setViewDir($settings['viewDir']);
        }

        if (isset($settings['extension'])) {
            $this->setExtension($settings['extension']);
        } else {
            $this->settings['extension'] = true;
        }
    }


    public function setViewDir(string $path): self
    {
        if (!file_exists($path)) {
            throw new ViewElementException(sprintf('Folder not found: %s', $path));
        }

        $this->settings['viewDir'] = $path;
        return $this;
    }


    public function setExtension(bool $enable) : self
    {
        $this->settings['extension'] = $enable;
        return $this;
    }

    public function views(): string
    {
        return $this->settings['viewDir'];
    }


    public function useExtension(): bool
    {
        return $this->settings['extension'];
    }


}