<?php
// app/ApplicationAspectKernel.php

use Go\Core\AspectKernel;
use Go\Core\AspectContainer;
use Aspect\MonitorAspect;

/**
 * Application Aspect Kernel
 */
class ApplicationAspectKernel extends AspectKernel
{

    /**
     * Configure an AspectContainer with advisors, aspects and pointcuts
     *
     * @param AspectContainer $container
     *
     * @return void
     */
    protected function configureAop(AspectContainer $container)
    {
        $container->registerAspect(new MonitorAspect());
    }
}



?>