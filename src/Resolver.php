<?php

namespace Vx;

use Closure;
use SplStack;
use Exception;
use Throwable;
use Vx\Exception\ComponentException;
use Vx\Exception\TemplateNotFoundException;
use Vx\Exception\ViewElementException;

class Resolver
{
    /** @var SplStack */
    private SplStack $stack;

    /** @var $instance Resolver */
    protected static $instance;

    /** @var $config Config */
    protected $config;


    protected $filters = [];


    public function __construct(array $config = [])
    {
        if (!is_null(static::$instance)) {
            throw new Exception('A View instance has been declare');
        }

        static::$instance = $this;
        $this->stack = new SplStack();
    }


    public static function getInstance(): Resolver
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    /**
     * Set Config values
     * @param Config|null $config
     * @return void
     */
    public function config(?Config $config) {
        $this->config = $config;
    }

    /**
     * Start render ViewComponent
     * @param string $path
     * @param array $params
     * @throws TemplateNotFoundException
     */
    public function start(string $path, array $params = [])
    {
        $path = $this->checkConfig($path);

        if (!file_exists($path)) {
            throw new TemplateNotFoundException(sprintf('Template not found: %s', $path));
        }

        /** An output buffer is initialised. */
        ob_start();

        $this->stack->push(new Component($path, $params));
    }


    /**
     * Validate if exits config parameters
     *
     * @param $path
     * @return string
     */
    private function checkConfig($path) : string
    {
        if (is_null($this->config)) {
            return $path;
        }

        $path = $this->config->views() . DIRECTORY_SEPARATOR . $path;
        return !$this->config->useExtension() ? $path.'.php' : $path;
    }

    /**
     *  Return var in Json format
     * @param $var
     * @return false|string
     */
    public function json($var)
    {
       return json_encode($var);
    }


    /**
     * End render ViewComponent
     * @throws ComponentException
     */
    public function end()
    {
        /** @var $viewComponent Component */
        $viewComponent = $this->getLastComponent();

        $viewComponent->setContent(ob_get_clean());

        /** Create variables from array */
        $vars = $viewComponent->getParams();
        extract($vars);

        include $viewComponent->getPath();
    }


    /**
     * Slot insert content between Start and End
     * @return string
     */
    public function slot() : string
    {
        /** @var $viewComponent Component */
        $viewComponent = $this->getLastComponent(true);

        return $viewComponent->getContent();
    }


    /**
     * Render full Component
     * @param string $path
     * @param array $data
     * @return false|string
     * @throws Throwable
     */
    public function render(string $path, array $data = [])
    {
        extract($data);
        $level = ob_get_level();

        try {
            ob_start();

            include $path;
            return ob_get_clean();

        } catch (Throwable $e) {
            $this->cleanStack($level);
            throw $e;
        }
    }


    /**
     * Add filter
     *
     * @param string $name
     * @param Closure $filter
     * @return void
     */
    public function addFilter(string $name, Closure $filter)
    {
        $this->filters[$name] = $filter;
    }


    /**
     * Use registered filter
     *
     * @param $value
     * @param string $filterName
     * @return mixed
     * @throws ViewElementException
     */
    public function filter($value, string $filterName )
    {
        if (!isset($this->filters[$filterName])) {
            throw new ViewElementException(sprintf(
                'The filter "%s" does not exists', $filterName
            ));
        }

        return call_user_func($this->filters[$filterName], $value);
    }


    /**
     * Get last element from Stack
     * @param bool $remove
     * @throws ComponentException
     */
    public function getLastComponent(bool $remove = false)
    {
        if ($this->stack->isEmpty()) {
            throw new ComponentException(
                'Component no found, Make sure to Initialize the component with View::Start'
            );
        }

        if ($remove) {
            return $this->stack->pop();
        }

        return $this->stack->top();
    }

    /**
     * Clear Stack Components
     */
    public function cleanStack(int $obLevel = 0)
    {
       if($obLevel > 0) {
           $obLevel = ob_get_level();
       }

        $this->stack = new SplStack();

        while (ob_get_level() > $obLevel) {
            ob_end_clean();
        }
    }
}