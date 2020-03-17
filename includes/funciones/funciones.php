<?php 

function productos_json(&$boletos, &$camisas = 0, &$etiquetas = 0){
    $dias = array(0 => "pase_dia", 1 => "pase_diario", 2 => "pase_2dias");
    $total_pedido = array_combine($dias, $boletos);
    $json = array();
    foreach($total_pedido as $key => $boletos):
        if((int) $boletos > 0):
         $json[$key] = (int) $boletos;
        endif;   
    endforeach;
    if((int) $camisas > 0):
        $json['camisas'] = $camisas;
    endif;
    if((int) $etiquetas > 0):
        $json['etiquetas'] = $etiquetas;
    endif;
    return json_encode($json);   
}
function eventos_json(&$eventos){
    $eventos_json = array();
    foreach ($eventos as $evento):
        $eventos_json['eventos'][] = $evento;
    endforeach;
    return json_encode($eventos_json);
}