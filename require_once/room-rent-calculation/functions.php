<?php
    
    $roomRent = 3000;
    $totalDays = 3;
    $serviceCharge = 500;
    
    function calculateRoomBill($roomRent, $totalDays, $serviceCharge)

    {   $totalRent = $roomRent * $totalDays;    

        $finalBill = $totalRent + $serviceCharge;    

        return $finalBill;
    }

   
?>