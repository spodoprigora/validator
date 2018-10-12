<?php


class Validator {
    /**
     * @param string $id
     * @return bool
     */
    public function validate(string $id): bool
    {
        if (strlen($id) != 13 || !is_numeric($id))
            return false;

        //region
        if ($id[7] !== '1')
            return false;

        $dd = (int)($id[0] . $id[1]);
        $mm = (int)($id[2] .$id[3]);
        if (!(1 <= $dd && $dd <= 31) || !(1 <= $mm && $mm <= 12))
            return false;

        $checkSum = 11-((7*($id[0] + $id[6]) + 6*($id[1] + $id[7]) + 5*($id[2] + $id[8]) + 4*($id[3] + $id[9]) + 3*($id[4] + $id[10]) + 2*($id[5] + $id[11])));

        $calcK = $this->mod($checkSum, 11);

        if($calcK === 10 || $calcK === 11 && $id[12] !== 0)
            return false;
        return true;

    }

    /**
     * @param int $n
     * @param int $d
     * @return int
     */
    function mod(int $n, int $d) :int
    {
        return $n - $d * floor($n/$d);
    }

}
$obj = new Validator();
echo $obj->validate('aaa');
echo $obj->validate('1aaaaaaaaaaaaa');
echo $obj->validate('1abcde1eeeeee');
echo $obj->validate('1407976101522');
echo $obj->validate('1407976101522');


