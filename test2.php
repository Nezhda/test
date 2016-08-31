<?php
/**
 * Написать функцию которая из этого массива
 */
$data1 = [
    'parent.child.field' => 1,
    'parent.child.field2' => 2,
    'parent2.child.name' => 'test',
    'parent2.child2.name' => 'test',
    'parent2.child2.position' => 10,
    'parent3.child3.position' => 10,
];
function transformArrea($newar, $sep='.') {
    $result = array();
    foreach ($newar as $key => $val) {
        $reslink = &$result;
        foreach (explode($sep, $key) as $part)
            $reslink = &$reslink[$part];
        $reslink = is_array($val) ? transformArrea($val, $sep) : $val;
    }
    return $result;
}
echo '<pre>';print_r(transformArrea($data1));echo '</pre>';

//сделает такой и наоборот
$data = [
    'parent' => [
        'child' => [
            'field' => 1,
            'field2' => 2,
        ]
    ],
    'parent2' => [
        'child' => [
            'name' => 'test'
        ],
        'child2' => [
            'name' => 'test',
            'position' => 10
        ]
    ],
    'parent3' => [
        'child3' => [
            'position' => 10
        ]
    ],
];
function transformArrea2($dat,$sep='.',$i=0,&$slice=array(),&$res=array()) {
    foreach($dat as $key=>$val) {
        if(count($slice)==0) $i=0-$i;
        $slice[]= $key;
        if(is_array($val))
            transformArrea2($val,$sep,$i++,$slice,$res);
        else
            $res=array_merge($res,array(implode($sep,$slice)=>$val));
        if(count($slice)>$i) array_splice($slice,count($slice)-$i-1);
    }
    return $res;
};
echo '<pre>';print_r(transformArrea2($data));echo '</pre>';