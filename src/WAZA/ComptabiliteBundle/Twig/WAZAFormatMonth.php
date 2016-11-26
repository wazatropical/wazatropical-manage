<?php
namespace WAZA\ComptabiliteBundle\Twig;

use Symfony\Component\HttpKernel\KernelInterface;

class WAZAFormatMonth extends \Twig_Extension
{    
    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'datetime' => new Twig_Filter_Method($this, 'datetime')
        );
    }

    /**
     * @param string $string
     * @return int
     */
    public function datetime($format = "%B %e")
    {
        /*if ($d instanceof \DateTime) {
            $d = $d->getTimestamp();
        }*/

        //return strftime($format, $d);
        return strftime(67);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ComptabiliteBundle';
    }
}