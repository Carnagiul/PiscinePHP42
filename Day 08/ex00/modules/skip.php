<?php
$ship = NULL;
if ($_SESSION["PlayerTurn"] == 2)
{
    if ($ship instanceof Ship)
        $ship->setManoeuvre($ship->getMinManoeuvre());
    $_SESSION["Vessel_P2"][$_SESSION["Vessel_P2_get"]] = $ship;
    $_SESSION["Vessel_P2_get"] = $_SESSION["Vessel_P2_get"] + 1;
    $_SESSION["PlayerTurn"] = $_SESSION["PlayerTurn"] + 1;
    if ($_SESSION["Vessel_P2_get"] >= count($_SESSION["Vessel_P2"]))
    {
        $_SESSION["Vessel_P2_get"] = 0;
        $_SESSION["Turn"]++;
    }

}
if ($_SESSION["PlayerTurn"] == 1)
{
    if ($ship instanceof Ship)
        $ship->setManoeuvre($ship->getMinManoeuvre());
    $_SESSION["Vessel_P1"][$_SESSION["Vessel_P1_get"]] = $ship;
    $_SESSION["Vessel_P1_get"] = $_SESSION["Vessel_P1_get"] + 1;
    $_SESSION["PlayerTurn"] = $_SESSION["PlayerTurn"] + 1;
    if ($_SESSION["Vessel_P1_get"] >= count($_SESSION["Vessel_P1"]))
        $_SESSION["Vessel_P1_get"] = 0;
}


if ($_SESSION["PlayerTurn"] >= 3 || $_SESSION["PlayerTurn"] <= 0)
    $_SESSION["PlayerTurn"] = 1;