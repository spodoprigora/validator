<?php


class Validator {
    /**
     * @param string $id
     * @return bool
     */
    public function validate(string $id): bool
    {
        if (preg_match("/^(\d{2})(\d{2})(\d{3})(\d{2})(\d{3})(\d{1})$/", $id, $match) === 0)
            return false;

        $day = $match[1];
        $month = $match[2];
        $year = $match[3];
        $region = $match[4];
        $random = $match[5];
        $k = $match[6];

        if (!(1 <= $day && $day <= 31)
            || !(1 <= $month && $month <= 12)
            || !(10 <= $region && $region <= 19))
            return false;

        $checkSum = 11-((7*($day[0] + $year[2]) + 6*($day[1] + $region[0]) + 5*($month[0] + $region[1]) + 4*($month[1] + $random[0]) + 3*($year[0] + $random[1]) + 2*($year[1] + $random[2])));

        $calcK = $this->mod($checkSum, 11);

        if($calcK === 10 || $calcK === 11 && $k !== 0)
            return false;
        return true;
    }

    /**
     * @param int $n
     * @param int $d
     * @return int
     */
    protected function mod(int $n, int $d) :int
    {
        $res = $n % $d;
        if ($n < 0)
            $res += $d;
        return $res;
    }

}
