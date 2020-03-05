<?php

function stringReduce($string):string
    {
        /*---------------------------------------------------
        | Definimo o limite aqui. Caso o limite seja
        | atualizado basta alterar aqui
        | e tudo continua funcionando
        ---------------------------------------------------*/
        $maxLenght = 13;
    
        /*---------------------------------------------------
        | stringMiniSize define o tamanho de string a ser
        | ignorada no tratamento.
        | Exemplo ["de"] em ["de Oliveira"]
        ---------------------------------------------------*/
        $stringMinSize = 2;
        $space = ' ';

        if (strlen($string) < $maxLenght) {
            return $string;
        }

        $stringPieces = explode($space, $string);
        $firstName = $stringPieces[0];
        unset($stringPieces[0]);

        $firstNameSize = strlen($firstName);

        /*---------------------------------------------------
        | Caso o primeiro nome estoure o limite, já retorna
        | a string reduzida aqui
        ---------------------------------------------------*/
        if ($firstNameSize > $maxLenght) {
            return substr($firstName, 0, ($maxLenght - 1));
        }
    
        foreach ($stringPieces as $key=>$value) {
            if (strlen($value)<= $stringMinSize) {
                unset($stringPieces[$key]);
            }
        }

        /*---------------------------------------------------
        | O limite disponível é o tamanho máximo somado ao
        | primeiro nome mais um caractere de espaço
        ---------------------------------------------------*/
        $remainingLimit = $maxLenght - ($firstNameSize + 1);

        $abreviation[] = $firstName;
        foreach ($stringPieces as $key => $value) {
            /*---------------------------------------------------
            | Enquanto o valor final estiver abaixo do limite
            | Vamos reduzindo a string
            ---------------------------------------------------*/
            if (array_sum(array_map('strlen', $abreviation)) < ($maxLenght - 4)) {
                $sizeValue = strlen($value);

                if ($sizeValue > ($remainingLimit - 3)) {
                    $abreviation[] = substr($value, 0, 1) . '.';
                    $remainingLimit = $remainingLimit  - 2;
                } else {
                    $abreviation[] = $value;
                    $remainingLimit = $remainingLimit - $sizeValue;
                }
            }
        }

        return implode($space, $abreviation);
    }  