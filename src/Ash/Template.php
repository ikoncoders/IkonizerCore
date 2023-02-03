<?php
declare (strict_types = 1);

namespace IkonizerCore\Ash;

class Template extends AbstractTemplate
{

    /** @var TemplateEnvironment */
    protected TemplateEnvironment $templateEnvironment;

    /**
     * Main class constructor
     *
     * @param TemplateEnvironment $templateEnvironment
     */
    public function __construct(TemplateEnvironment $templateEnvironment)
    {
        $this->templateEnvironment = $templateEnvironment;
        parent::__construct($templateEnvironment);
    }

    /**
     * Display the template
     *
     * @param string $file
     * @param array $context
     */
    public function view(string $file, array $context = [])
    {
        $fileCache = $this->cache(TEMPLATES . $file);
        extract($context, EXTR_SKIP);
        require $fileCache;
    }

    /**
     * Display the template from the error resource directory
     *
     * @param string $file
     * @param array $context
     */
    public function errorView(string $file, array $context = [])
    {
        $fileCache = $this->cache(ERROR_RESOURCE . $file);
        extract($context, EXTR_SKIP);
        require $fileCache;
    }


}
