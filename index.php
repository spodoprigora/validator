<?php


class Validator {
    /**
     * @param string $id
     * @return bool
     */
    public function validate(string $id): bool
    {
        if (preg_match("/^(\d{2})(\d{2})(\d{3})(\d{2})(\d{3})(\d{1})$/", $id, $match) === 0) {
            return false;
        }

        $day = $match[1];
        $month = $match[2];
        $year = $match[3];
        $region = $match[4];
        $random = $match[5];
        $k = $match[6];

        $year = $year[0] === 0 ? 2 . $year : 1 . $year;

        $checkSum = 11-((7*($day[0] + $year[2]) + 6*($day[1] + $region[0]) + 5*($month[0] + $region[1]) + 4*($month[1] + $random[0]) + 3*($year[0] + $random[1]) + 2*($year[1] + $random[2])));

        $calcK = $this->mod($checkSum, 11);

        $result = true;
        if(($calcK === 10 || $calcK === 11) && $k === 0) {
            $result = false;
        }
        return checkdate($month, $day, $year) && ($region >= 10 && $region <= 19) && $result;
    }

    /**
     * @param int $n
     * @param int $d
     * @return int
     */
    protected function mod(int $n, int $d) :int
    {
        $res = $n % $d;
        if ($n < 0) {
            $res += $d;
        }
        return $res;
    }

}

