<?php

class BottleLabel
{

    function getColour($id)
    {
        $colours = array(
            "red",
            "orange",
            "green",
            "blue",
            "purple"
        );

        $id = strtolower(preg_replace("/[^A-Za-z]/", '', $id));

        $lev = array();
        foreach ($colours as $colour) {
            $lev[$colour] = levenshtein($id, $colour);
        }

        return (array_keys($lev, min($lev))[0]);
    }

    function getNumber($id)
    {
        return substr(strrev((string) preg_replace("/[^0-9]/", "", $id)), 0, 4);
    }
}