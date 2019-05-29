<?php


array_shift($argv);
$arguments = $argv;
$counter_argv = $argc - 1;
$tab = [];
$temp = [];
if (empty($arguments)) {

    bubbleSort(nb(100), $temp);

} else {
    createList($tab);
    print("\033[35m SIZE OF GIVEN TAB:" . count($tab) . " \033[0m" . PHP_EOL . PHP_EOL);
    print("\033[35m AMELIORATED BUBBLE SORT \033[0m" . PHP_EOL . PHP_EOL);
    bubbleSort($tab, $temp);
}

function createList(&$tab)
{
    global $arguments;
    global $counter_argv;
    for ($i = 0; $i < $counter_argv; $i++) {
        $tab[$i] = $arguments[$i];
    }
    return $tab;
}

function nb($nb)
{
    $tab = [];
    for ($i = 0; $i < 100; $i++) {
        $a = mt_rand(1, $nb);
        array_push($tab, $a);
    }
    return $tab;
}

function swap(&$x, &$y)
{
    $tmp = $x;
    $x = $y;
    $y = $tmp;
}

function sa(&$tab, $i)
{
    if (empty($tab)) {
        return 0;
    }
    swap($tab[$i], $tab[$i + 1]);
    print("sa");
    return $tab;
}

function sb(&$temp, $i)
{
    if (empty($temp)) {
        return 0;
    }
    swap($temp[$i], $temp[$i + 1]);
    print("sb");
    return $temp;
}

function sc(&$tab, &$temp, $i)
{
    swap($tab[$i], $tab[$i + 1]);
    swap($temp[$i], $temp[$i + 1]);
    print("sc");
    return array($tab, $temp);

}

function pa(&$tab, &$temp, $i)
{
    array_unshift($tab, $temp[$i]);
    $rmv = array_shift($temp);
    print("pa");
    return array($tab, $temp);
}

function pb(&$tab, &$temp, $i)
{
    array_unshift($temp, $tab[$i]);
    $rmv = array_shift($tab);
    print("pb");
    return array($tab, $temp);
}

function ra(&$tab)
{
    $head = $tab[0];
    $rmv = array_shift($tab);
    array_push($tab, $head);
    print("ra");
    return $tab;
}

function rb(&$temp)
{
    $head = $temp[0];
    $rmv = array_shift($temp);
    array_push($temp, $head);
    print("rb");
    return $temp;
}

function rr(&$tab, &$temp)
{
    $head1 = $tab[0];
    $head2 = $temp[0];
    $rmv1 = array_shift($tab);
    $rmv2 = array_shift($temp);
    array_push($tab, $head1);
    array_push($temp, $head2);
    print("rr");
    return array($tab, $temp);
}

function rra(&$tab)
{
    $tail = array_pop($tab);
    array_unshift($tab, $tail);
    print("rra");
    return $tab;
}

function rrb(&$temp)
{
    $tail = array_pop($temp);
    array_unshift($temp, $tail);
    print("rrb");
    return $temp;
}

function rrr(&$tab, &$temp)
{
    $tail1 = array_pop($tab);
    $tail2 = array_pop($temp);
    array_unshift($tab, $tail1);
    array_unshift($temp, $tail2);
    print("rrr");
    return array($tab, $temp);
}


function bubbleSort(&$tab, &$temp)
{
    $counter = 0;
    $counter_pa = 0;
    $counter_pb = 0;
    $counter_ra = 0;
    $counter_rra = 0;
    $size = count($tab);
    $max = max($tab);
    for ($i = 0; $i < $size; $i++) {
        $half = $size / 2;
        if ($i > $half && $tab[$i] == $max) {
            rra($tab);
            $counter_rra++;
            $counter++;
            $i = -1;
            if ($max === $tab[0]) {
                pb($tab, $temp, 0);
                $counter_pb++;
                $counter++;
                $max = max($tab);
                $size = count($tab);
                $i = -1;
            }
        } else if ($i <= $half && $tab[$i] == $max) {
            ra($tab);
            $counter_ra++;
            $counter++;
            $i = -1;
            if ($max === $tab[0]) {
                pb($tab, $temp, 0);
                $counter_pb++;
                $counter++;
                $size = count($tab);
                if ($size !== 0) {
                    $max = max($tab);
                }
                $i = -1;
            }
        }
    }
    $size_temp = count($temp);
    for ($i = 0; $i < $size_temp; $i++) {
        pa($tab, $temp, $i);
        $size_temp = count($temp);
        $counter++;
        $counter_pa++;
        $i = -1;
    }

    return array($tab, $temp, $counter, $counter_pa, $counter_pb, $counter_rra, $counter_ra);
}
