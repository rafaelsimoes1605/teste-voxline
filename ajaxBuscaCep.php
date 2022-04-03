<?php
$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

/** Inicializa o array de JSON utilizado nos callbacks */
$jSon = [];
$html = '';

validaErro($getPost);

$cep = preg_replace("/[^0-9]/", "", $getPost['cep']);
$content = file_get_contents("https://viacep.com.br/ws/" . $cep . "/json/?callback");
$arrContent = json_decode($content, true);

if (!empty($arrContent['erro'])) {
    $msg = 'Não foi possível localizar o CEP <u>' . $getPost['cep'] . '</u>. Verifique e tente novamente!';
    $getPost['cep'] = '';
    validaErro($getPost, $msg);
}

$html .= '<table class="table">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>CEP</th>';
$html .= '<th>Logradouro</th>';
$html .= '<th>Complemento</th>';
$html .= '<th>Bairro</th>';
$html .= '<th>Cidade</th>';
$html .= '<th>Estado</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
$html .= '<tr>';
$html .= '<td>' . $arrContent['cep'] . '</td>';
$html .= '<td>' . $arrContent['logradouro'] . '</td>';
$html .= '<td>' . $arrContent['complemento'] . '</td>';
$html .= '<td>' . $arrContent['bairro'] . '</td>';
$html .= '<td>' . $arrContent['localidade'] . '</td>';
$html .= '<td>' . $arrContent['uf'] . '</td>';
$html .= '<tr>';
$html .= '</tbody>';
$html .= '</table>';

$jSon['Result'] = $html;

echo json_encode($jSon);

/**
 * 
 */
function validaErro($getPost, $msg = 'Obrigatório')
{
    $jSon = [];
    foreach ($getPost as $k => $v) {
        if (empty($v)) {
            $jSon['Error'][$k] = [
                'id' => $k,
                'msg' => $msg,
            ];
        } else if (!empty($getPost['Error'])) {
            $jSon['Error'][$k] = [
                'id' => $k,
                'msg' => $msg,
            ];
        }
    }
    if (!empty($jSon)) {
        echo json_encode($jSon);
        die;
    }

    return false;
}
