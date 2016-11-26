<?php

namespace WAZA\ComptabiliteBundle\Twig\Extension;

class ShowTabProdObjectExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('showtab', array($this, 'showTab')));
    }
    
    public function showTab($arrayOp, $puconvert1, $puconvert2, $puconvert3){
        $code = "";
        $total = 0;
        $valeur = 0;
        foreach($arrayOp as $o){
            $ptotal1 = $puconvert1[$valeur] * $o.quantite;
            $ptotal2 = $puconvert2[$valeur] * $o.quantite;
            $ptotal3 = $puconvert3[$valeur] * $o.quantite;
            $total = $total + $ptotal1;
            $code += "<tr>
                                    <td>".$o.date." | date(\"d/m/Y\")}}</td>
                                    <td>".$o.objet.nom."}}</td>
                                    <td>".$puconvert1[$valeur]."</td>
                                    <td>".$puconvert2[$valeur]."</td>
                                    <td>".$puconvert3[$valeur]."</td>
                                    <td>".$o.objet.mesure.code."</td>
                                    <td>".$o.quantite."</td>
                                    <td>".$ptotal1."</td>
                                    <td>".$ptotal2."</td>
                                    <td>".$ptotal3."</td>
                                    <td>".$total."</td>
                                </tr>";
            $valeur += 1;
        }
        $code += "
                            <tr>
                                <td colspan=\"7\">TOTAL</td>
                                <td>".$total."</td>
                                <td colspan=\"3\"></td>
                            </tr>";
        return $code;
    }
    
    public function getName(){
        return 'showtab';
    }
}