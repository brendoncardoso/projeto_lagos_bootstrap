<?php

function mesesArray($id=null,$key='-1') {
    $id = (int) $id;
    $meses = array($key => "Selecione o mês", "1" => "Janeiro", "2" => "Fevereiro", "3" => "Março", "4" => "Abril", "5" => "Maio", "6" => "Junho",
        "7" => "Julho", "8" => "Agosto", "9" => "Setembro", "10" => "Outubro", "11" => "Novembro", "12" => "Dezembro");
    if (!empty($id))
        return $meses[$id];
    else
        return $meses;
}

function montaSelect($options, $value, $atributos) {
    $html = "<select ";

    if (is_array($atributos)) {
        foreach ($atributos as $key => $val) {
            $html .= $key . "=\"" . $val . "\"";
        }
    } else {
        $html .= $atributos;
    }
    $html .= ">";


    if (is_array($options)) {
        foreach ($options as $key => $val) {
            if (!empty($value) && $value == $key) {
                $selected = " selected=\"selected\"";
            } else {
                $selected = "";
            }
            $html .= "<option value=\"" . $key . "\"$selected>" . $val . "</option>";
        }
    }
    $html .= "</select>";
    return $html;
}

function anosArray($inicio=null, $fim=null, $default = null) {
    if ($inicio == null)
        $inicio = date("Y") - 4;
    if ($fim == null)
        $fim = date("Y") + 1;
    $anos = array();

    if ($default !== null) {
        $anos = $default;
    }

    for ($i = $inicio; $i <= $fim; $i++) {
        $anos[$i] = $i;
    }
    return $anos;
}

?>
