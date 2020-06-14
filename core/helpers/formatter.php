<?php

/*
 * EXAMPLE HELPER CLASS
 */
class Formatter {

    public static function diasDaSemanaExtenso ($aulas) {
        $aux = $aulas;

        $diasExtenso = [
            "0" => "Domingo",
            "1" => "Segunda",
            "2" => "Terça",
            "3" => "Quarta",
            "4" => "Quinta",
            "5" => "Sexta",
            "6" => "Sábado"
        ];

        foreach($aux as &$aula) {
            $dias = str_split($aula["dias"]);
            foreach ($dias as &$dia) {
                $dia = $diasExtenso[$dia];
            }
            $aula["diasExtenso"] = join(", ", $dias);
        }  

        return $aux;
    }

}

?>