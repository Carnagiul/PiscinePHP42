<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 6/7/18
 * Time: 3:03 PM
 */

if ($_SESSION["Player_to_Player"] == 1)
    $ship = $_SESSION["Vessel_P1"][$_SESSION["Vessel_P1_get"]];
if ($_SESSION["Player_to_Player"] == 2)
    $ship = $_SESSION["Vessel_P2"][$_SESSION["Vessel_P2_get"]];
