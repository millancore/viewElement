<?php

namespace Vx;

class Component
{
    private $path;
    private $content;
    private $params;

    public function __construct(string $path, array $params = [], string $content = '')
    {
        $this->path = $path;
        $this->content = $content;
        $this->params = $params;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return spl_object_id($this);
    }


    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }


    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

}
