<?php
    function hash16($r)
    {
        $r *= 12721;
        $u = $r & 0xAAAA; $v = $r & 0x5555;
        $r = ($u >> 11) | ($v >> 5) | ($u << 5) | ($v << 11);
        $r *= 12721;
        $u = $r & 0xAAAA; $v = $r & 0x5555;
        $r = ($u >> 11) | ($v >> 5) | ($u << 5) | ($v << 11);
        $r *= 12721;
        $u = $r & 0xAAAA; $v = $r & 0x5555;
        $r = ($u >> 11) | ($v >> 5) | ($u << 5) | ($v << 11);
        return $r % 65536;
    }
    
    function hashRandom16($r, $m)
    {
        return (int)floor(hash16($r) * $m / 65536);
    }
?>
