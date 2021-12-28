<?php
require './../vendor/dompdf/dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();

use Dompdf\Dompdf;

if ($peticionAjax) {
    require_once "../model/reporte.modelo.php";
} else {
    require_once "./model/reporte.modelo.php";
}
class reporteControlador extends reporteModelo
{

    public function CtrCrarControldeAsistenciaWord()
    {
        $empresa = (isset($_POST['empresa'])) ? mainModel::limpiar_cadena($_POST['empresa']) : "";

        $tutor = (isset($_POST['tutor'])) ? mainModel::limpiar_cadena($_POST['tutor']) : "";
        $cargo = (isset($_POST['cargo'])) ? mainModel::limpiar_cadena($_POST['cargo']) : "";


        $id_pasante = (isset($_POST['id'])) ?  mainModel::decryption($_POST['id']) :  $_SESSION['p_id'];
        $query = "SELECT * FROM asistencia WHERE per_id = '$id_pasante' ORDER BY asi_dia";

        $sql = mainModel::ejecutar_consulta_simple($query);
        if ($sql->rowCount() >= 1) {
            $datosa = $sql->fetchAll();
            $datos = array();
            $fechas = [];
            $semana = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            $semana1 = array();

            foreach ($datosa as $key => $value) {

                $h_ingreso = $value['asi_hora_ingreso'];
                $h_almuerzo_inicio = $value['asi_hora_salida_a'];
                $h_almuerzo_fin = $value['asi_hora_regreso_a'];
                // $h_salida = $row['asi_hora_salida'];
                $h_salida = ($value['asi_hora_salida'] == "00:00:00") ? $value['asi_hora_ingreso'] : $value['asi_hora_salida'];

                //Diferencia entre horas entrada y salida
                $diff = $this->getTimeDiff($h_ingreso, $h_salida);

                //Diferencia entre horas almuerzo inicio y almuerzo fin
                $diff_a = $this->getTimeDiff($h_almuerzo_inicio, $h_almuerzo_fin);

                //Total de horas trabajadas
                $total_horas = $this->getTimeDiff($diff_a, $diff);

                // $datos[$key]['id'] = $value['asi_id'];
                $fechas[$value['asi_dia']] = $value['asi_dia'];
                $datos[$value['asi_dia']]['fecha'] = $value['asi_dia'];
                $datos[$value['asi_dia']]['dia'] = $value['asi_dia'];
                $datos[$value['asi_dia']]['h_ingreso'] = $value['asi_hora_ingreso'];
                $datos[$value['asi_dia']]['h_salida'] = $value['asi_hora_salida'];
                $datos[$value['asi_dia']]['total_h'] = $total_horas;
                // foreach ($semana as $key1 => $value1) {
                //     if (date("D",strtotime($value['asi_dia'])) == $value1) {
                //         $semana1[$key1]['fecha'] = $value['asi_dia'];
                //         $semana1[$key1]['dia'] = $value1;
                //         $semana1[$key1]['h_ingreso'] = $value['asi_hora_ingreso'];
                //         $semana1[$key1]['h_salida'] = $value['asi_hora_salida'];
                //     }else{
                //         $semana1[$key1]['fecha'] = date('Y-m-d', strtotime($value['asi_dia'], strtotime('+1 day')));
                //         $semana1[$key1]['dia'] = $value1;
                //         $semana1[$key1]['h_ingreso'] = '-';
                //         $semana1[$key1]['h_salida'] = '-';
                //     }

                // }
                if (date("D", strtotime($value['asi_dia'])) == 'Mon') {
                    $datosParse[$value['asi_dia']] = "Lunes";
                } elseif (date("D", strtotime($value['asi_dia'])) == 'Tue') {
                    $datosParse[$value['asi_dia']] = "Martes";
                } elseif (date("D", strtotime($value['asi_dia'])) == 'Wed') {
                    $datosParse[$value['asi_dia']] = "Miercoles";;
                } elseif (date("D", strtotime($value['asi_dia'])) == 'Thu') {
                    $datosParse[$value['asi_dia']] = "Jueves";
                } elseif (date("D", strtotime($value['asi_dia'])) == 'Fri') {
                    $datosParse[$value['asi_dia']] = "Viernes";
                } elseif (date("D", strtotime($value['asi_dia'])) == 'Sat') {
                    $datosParse[$value['asi_dia']] = "Sabado";
                } elseif (date("D", strtotime($value['asi_dia'])) == 'Sun') {
                    $datosParse[$value['asi_dia']] = "Domingo";
                }
            }
            // echo json_encode($datosParse);
            // exit;


            $start = new DateTime(key($fechas)); // your start key
            $end = new DateTime(array_key_last($fechas)); // your end key

            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($start, $interval, date_add($end, $interval));

            $finalArr = array();
            foreach ($period as $dt) {
                if (array_key_exists($dt->format("Y-m-d"), $datosParse)) {
                    $finalArr[$dt->format("Y-m-d")] = $datosParse[$dt->format("Y-m-d")];
                } else {
                    $finalArr[$dt->format("Y-m-d")] =  0;
                }
            }

            // echo json_encode($fechas);
            // echo json_encode($finalArr);
            // exit;

            foreach ($finalArr as $key => $value) {
                if (array_key_exists($key, $fechas)) {
                    $datosnew[$key]['fecha'] = $datos[$key]['fecha'];
                    $datosnew[$key]['dia'] = $value;
                    $datosnew[$key]['h_ingreso'] = $datos[$key]['h_ingreso'];
                    $datosnew[$key]['h_salida'] = $datos[$key]['h_salida'];
                    $datosnew[$key]['total_h'] = $datos[$key]['total_h'];
                } else {
                    // $datosnew[$key]['fecha'] = $datos[$key]['fecha'];
                    $datosnew[$key]['fecha'] = $key;
                    if (date('D', strtotime($key)) == 'Mon') {
                        $datosnew[$key]['dia'] = "Lunes";
                    } elseif (date('D', strtotime($key)) == 'Tue') {
                        $datosnew[$key]['dia'] = "Martes";
                    } elseif (date('D', strtotime($key)) == 'Wed') {
                        $datosnew[$key]['dia'] = "Miercoles";
                    } elseif (date('D', strtotime($key)) == 'Thu') {
                        $datosnew[$key]['dia'] = "Jueves";
                    } elseif (date('D', strtotime($key)) == 'Fri') {
                        $datosnew[$key]['dia'] = "Viernes";
                    } elseif (date('D', strtotime($key)) == 'Sat') {
                        $datosnew[$key]['dia'] = "Sabado";
                    } elseif (date('D', strtotime($key)) == 'Sun') {
                        $datosnew[$key]['dia'] = "Domingo";
                    }


                    $datosnew[$key]['h_ingreso'] = '00:00:00';
                    $datosnew[$key]['h_salida'] = '00:00:00';
                    $datosnew[$key]['total_h'] = '00:00:00';
                }
            }

            // echo json_encode($datosnew);
            // exit; 

            $keys = array_keys($datosnew);
            // $vWord = array();
            $length = count($datosnew);

            for ($i = 0; $i < $length; $i++) {
                $vWord[$i]['fecha'] = $datosnew[$keys[$i]]['fecha'];
                $vWord[$i]['dia'] = $datosnew[$keys[$i]]['dia'];
                // $vWord[$i]['dia']['h_ingreso'] = $datosnew[$keys[$i]]['h_ingreso'];
                $vWord[$i]['h_ingreso'] = ($datosnew[$keys[$i]]['h_ingreso'] == '00:00:00') ? "" : $datosnew[$keys[$i]]['h_ingreso'];
                // $vWord[$i]['dia']['h_salida'] = $datosnew[$keys[$i]]['h_salida'];
                if (($datosnew[$keys[$i]]['h_ingreso'] == '00:00:00') && ($datosnew[$keys[$i]]['h_salida'] == '00:00:00')) {
                    $vWord[$i]['h_salida'] = $datosnew[$keys[$i]]['h_salida'] = "";
                } else {
                    $vWord[$i]['h_salida'] = $datosnew[$keys[$i]]['h_salida'] = $datosnew[$keys[$i]]['h_salida'];
                }
                $vWord[$i]['total_h'] = $datosnew[$keys[$i]]['total_h'];
                $vWord[$i]['dSemana'] = date('N', strtotime($datosnew[$keys[$i]]['fecha']));
                $vWord[$i]['nSemana'] = date('YW', strtotime($datosnew[$keys[$i]]['fecha']));

                $vWord[$i]['nMes'] = $meses[date('n', strtotime($datosnew[$keys[$i]]['fecha'])) - 1];
            }

            // echo json_encode($vWord);
            // exit;

            $valores = array();
            // $s = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
            foreach ($vWord as $key => $value) {
                // while ($value['dSemana'] < 8) {

                $valores[$value['nSemana']]['mes'] = $value['nMes'];



                if ($value['dSemana'] == 1) {
                    $valores[$value['nSemana']]['lunes'] = $value['fecha'];
                    $valores[$value['nSemana']]['lu_s'] = $value['h_ingreso'];
                    $valores[$value['nSemana']]['lu_e'] = $value['h_salida'];
                    $valores[$value['nSemana']]['lu_t'] = $value['total_h'];
                } elseif ($value['dSemana'] == 2) {

                    $valores[$value['nSemana']]['martes'] = $value['fecha'];
                    $valores[$value['nSemana']]['ma_s'] = $value['h_ingreso'];
                    $valores[$value['nSemana']]['ma_e'] = $value['h_salida'];
                    $valores[$value['nSemana']]['ma_t'] = $value['total_h'];
                } elseif ($value['dSemana'] == 3) {

                    $valores[$value['nSemana']]['miercoles'] = $value['fecha'];
                    $valores[$value['nSemana']]['mi_s'] = $value['h_ingreso'];
                    $valores[$value['nSemana']]['mi_e'] = $value['h_salida'];
                    $valores[$value['nSemana']]['mi_t'] = $value['total_h'];
                } elseif ($value['dSemana'] == 4) {

                    $valores[$value['nSemana']]['jueves'] = $value['fecha'];
                    $valores[$value['nSemana']]['ju_s'] = $value['h_ingreso'];
                    $valores[$value['nSemana']]['ju_e'] = $value['h_salida'];
                    $valores[$value['nSemana']]['ju_t'] = $value['total_h'];
                } elseif ($value['dSemana'] == 5) {

                    $valores[$value['nSemana']]['viernes'] = $value['fecha'];
                    $valores[$value['nSemana']]['vi_s'] = $value['h_ingreso'];
                    $valores[$value['nSemana']]['vi_e'] = $value['h_salida'];
                    $valores[$value['nSemana']]['vi_t'] = $value['total_h'];
                } elseif ($value['dSemana'] == 6) {

                    $valores[$value['nSemana']]['sabado'] = $value['fecha'];
                    $valores[$value['nSemana']]['sa_s'] = $value['h_ingreso'];
                    $valores[$value['nSemana']]['sa_e'] = $value['h_salida'];
                    $valores[$value['nSemana']]['sa_t'] = $value['total_h'];
                } elseif ($value['dSemana'] == 7) {

                    $valores[$value['nSemana']]['domingo'] = $value['fecha'];
                    $valores[$value['nSemana']]['do_s'] = $value['h_ingreso'];
                    $valores[$value['nSemana']]['do_e'] = $value['h_salida'];
                    $valores[$value['nSemana']]['do_t'] = $value['total_h'];
                }

                // if ($key != count($vWord)) {
                // $valores['g']['semana']['lunes'] = (isset($vWord[$key]['fecha']) && $value['nSemana'] == 1) ? $vWord[$key]['fecha'] : '';
                // $valores['g']['semana']['martes'] = (isset($vWord[$key + 1]['fecha']) && $value['nSemana'] == 2) ? $vWord[$key + 1]['fecha'] : '';
                // $valores['g']['semana']['miercoles'] = (isset($vWord[$key + 2]['fecha']) && $value['nSemana'] == 3) ? $vWord[$key + 2]['fecha'] : '';
                // $valores['g']['semana']['jueves'] = (isset($vWord[$key + 3]['fecha']) && $value['nSemana'] == 4) ? $vWord[$key + 3]['fecha'] : '';
                // $valores['g']['semana']['viernes'] = (isset($vWord[$key + 4]['fecha']) && $value['nSemana'] == 5) ? $vWord[$key + 4]['fecha'] : '';
                // $valores['g']['semana']['sabado'] = (isset($vWord[$key + 5]['fecha']) && $value['nSemana'] == 6) ? $vWord[$key + 5]['fecha'] : '';
                // $valores['g']['semana']['domingo'] = (isset($vWord[$key + 6]['fecha']) && $value['nSemana'] == 7) ? $vWord[$key + 6]['fecha'] : '';

                // }
                // fill $valores['g']['semana']['lunes']
                // }
                // $valores['g']['semana']['lunes'] = 's'; // semana


            }
            // echo json_encode($valores);
            // exit;

            $keys2 = array_keys($valores);
            $valores2 = array();
            $length2 = count($valores);
            $g = 0;
            $a = 0;
            $am = "";
            for ($i = 0; $i < $length2; $i++) {
                // $valores2[$i]['semana'] = $keys2[$i];
                $a++;
                $am = $valores[$keys2[$i]]['mes'];
                $mes_f = @isset($valores[$keys2[$i - 1]]['mes']) ? $valores[$keys2[$i - 1]]['mes'] : $valores[$keys2[$i]]['mes'];
                $am = ($valores[$keys2[$i]]['mes'] == $mes_f) ? $am : $mes_f . ' - ' . $valores[$keys2[$i]]['mes'];
                // $am = (strpos($am, '-')) ? $am : $valores[$keys2[$i]]['mes'];
                if ($i % 4 == 0) {
                    $g++;
                    $a = 0;
                }
                $hours_tot = [];


                $valores2[$g][$a]['mes'] = $am;


                $valores2[$g][$a]['lunes'] = isset($valores[$keys2[$i]]['lunes']) ? $valores[$keys2[$i]]['lunes'] : '';
                $valores2[$g][$a]['martes'] = isset($valores[$keys2[$i]]['martes']) ? $valores[$keys2[$i]]['martes'] : '';
                $valores2[$g][$a]['miercoles'] = isset($valores[$keys2[$i]]['miercoles']) ? $valores[$keys2[$i]]['miercoles'] : '';
                $valores2[$g][$a]['jueves'] = isset($valores[$keys2[$i]]['jueves']) ? $valores[$keys2[$i]]['jueves'] : '';
                $valores2[$g][$a]['viernes'] = isset($valores[$keys2[$i]]['viernes']) ? $valores[$keys2[$i]]['viernes'] : '';
                $valores2[$g][$a]['sabado'] = isset($valores[$keys2[$i]]['sabado']) ? $valores[$keys2[$i]]['sabado'] : '';
                $valores2[$g][$a]['domingo'] = isset($valores[$keys2[$i]]['domingo']) ? $valores[$keys2[$i]]['domingo'] : '';

                $valores2[$g][$a]['lu_s'] = isset($valores[$keys2[$i]]['lu_s']) ? $valores[$keys2[$i]]['lu_s'] : '';
                $valores2[$g][$a]['lu_e'] = isset($valores[$keys2[$i]]['lu_e']) ? $valores[$keys2[$i]]['lu_e'] : '';
                $hours_tot[$g][$a][0] = isset($valores[$keys2[$i]]['lu_t']) ? $valores[$keys2[$i]]['lu_t'] : '00:00:00';

                $valores2[$g][$a]['ma_s'] = isset($valores[$keys2[$i]]['ma_s']) ? $valores[$keys2[$i]]['ma_s'] : '';
                $valores2[$g][$a]['ma_e'] = isset($valores[$keys2[$i]]['ma_e']) ? $valores[$keys2[$i]]['ma_e'] : '';
                $hours_tot[$g][$a][1] = isset($valores[$keys2[$i]]['ma_t']) ? $valores[$keys2[$i]]['ma_t'] : '00:00:00';

                $valores2[$g][$a]['mi_s'] = isset($valores[$keys2[$i]]['mi_s']) ? $valores[$keys2[$i]]['mi_s'] : '';
                $valores2[$g][$a]['mi_e'] = isset($valores[$keys2[$i]]['mi_e']) ? $valores[$keys2[$i]]['mi_e'] : '';
                $hours_tot[$g][$a][2] = isset($valores[$keys2[$i]]['mi_t']) ? $valores[$keys2[$i]]['mi_t'] : '00:00:00';

                $valores2[$g][$a]['ju_s'] = isset($valores[$keys2[$i]]['ju_s']) ? $valores[$keys2[$i]]['ju_s'] : '';
                $valores2[$g][$a]['ju_e'] = isset($valores[$keys2[$i]]['ju_e']) ? $valores[$keys2[$i]]['ju_e'] : '';
                $hours_tot[$g][$a][3] = isset($valores[$keys2[$i]]['ju_t']) ? $valores[$keys2[$i]]['ju_t'] : '00:00:00';

                $valores2[$g][$a]['vi_s'] = isset($valores[$keys2[$i]]['vi_s']) ? $valores[$keys2[$i]]['vi_s'] : '';
                $valores2[$g][$a]['vi_e'] = isset($valores[$keys2[$i]]['vi_e']) ? $valores[$keys2[$i]]['vi_e'] : '';
                $hours_tot[$g][$a][4] = isset($valores[$keys2[$i]]['vi_t']) ? $valores[$keys2[$i]]['vi_t'] : '00:00:00';


                $valores2[$g][$a]['sa_s'] = isset($valores[$keys2[$i]]['sa_s']) ? $valores[$keys2[$i]]['sa_s'] : '';
                $valores2[$g][$a]['sa_e'] = isset($valores[$keys2[$i]]['sa_e']) ? $valores[$keys2[$i]]['sa_e'] : '';
                $hours_tot[$g][$a][5] = isset($valores[$keys2[$i]]['sa_t']) ? $valores[$keys2[$i]]['sa_t'] : '00:00:00';

                $valores2[$g][$a]['do_s'] = isset($valores[$keys2[$i]]['do_s']) ? $valores[$keys2[$i]]['do_s'] : '';
                $valores2[$g][$a]['do_e'] = isset($valores[$keys2[$i]]['do_e']) ? $valores[$keys2[$i]]['do_e'] : '';
                $hours_tot[$g][$a][6] = isset($valores[$keys2[$i]]['do_t']) ? $valores[$keys2[$i]]['do_t'] : '00:00:00';

                $valores2[$g][$a]['t_h'] = $this->getSumHours($hours_tot[$g][$a]);

                $h_mes[$g][$a] = $valores2[$g][$a]['t_h'];



                // $valores2[$g]['mes'] = $g;

            }

            $max = count($valores2);
            $max2 = count($valores2[$max]);
            $q = $max2;
            while ($q < 4) {

                // $valores2[$max][$q]['s'] = $max2 + 1;
                $valores2[$max][$q]['lunes'] = '';
                $valores2[$max][$q]['martes'] = '';
                $valores2[$max][$q]['miercoles'] = '';
                $valores2[$max][$q]['jueves'] = '';
                $valores2[$max][$q]['viernes'] = '';
                $valores2[$max][$q]['sabado'] = '';
                $valores2[$max][$q]['domingo'] = '';
                $valores2[$max][$q]['lu_s'] = '';
                $valores2[$max][$q]['lu_e'] = '';
                $valores2[$max][$q]['ma_s'] = '';
                $valores2[$max][$q]['ma_e'] = '';
                $valores2[$max][$q]['mi_s'] = '';
                $valores2[$max][$q]['mi_e'] = '';
                $valores2[$max][$q]['ju_s'] = '';
                $valores2[$max][$q]['ju_e'] = '';
                $valores2[$max][$q]['vi_s'] = '';
                $valores2[$max][$q]['vi_e'] = '';
                $valores2[$max][$q]['sa_s'] = '';
                $valores2[$max][$q]['sa_e'] = '';
                $valores2[$max][$q]['do_s'] = '';
                $valores2[$max][$q]['do_e'] = '';
                $valores2[$max][$q]['t_h'] = '00:00';
                $q++;
            }

            // echo json_encode($h_mes[0]);
            // exit;

            require_once './../vendor/phpoffice/phpword/bootstrap.php'; //incluir la libreria

            $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(SERVERURL . 'controller/template.docx'); //seleccionar el template

            $test = array(
                [
                    ['s' => '', 'lunes' => 'Lunesasd', 'martes' => 'Martes', 'miercoles' => 'Miercoles', 'jueves' => 'Jueves', 'viernes' => 'Viernes', 'sabado' => 'Sabado', 'domingo' => 'Domingo', 't_h' => 2],
                    ['s' => '', 'lunes' => 'Lunesasd', 'martes' => 'Martes', 'miercoles' => 'Miercole123s', 'jueves' => 'Jueves', 'viernes' => 'Viernes', 'sabado' => 'Sabado', 'domingo' => 'Domingo', 't_h' => 22],
                    ['s' => '', 'lunes' => 'Lunes123123', 'martes' => 'Martes', 'miercoles' => 'Miercoles', 'jueves' => 'Jueves', 'viernes' => 'Viernes', 'sabado' => 'Sabado', 'domingo' => 'Domingo', 't_h' => 232],
                    ['s' => '', 'lunes' => 'Lunes', 'martes' => 'Martes', 'miercoles' => 'Miercoles', 'jueves' => 'Jueves', 'viernes' => 'Viernes', 'sabado' => 'Sabado', 'domingo' => 'Domingo', 't_h' => 432],
                ],
                [
                    ['s' => '', 'lunes' => 'Lunes', 'martes' => 'Martes', 'miercoles' => 'Miercoles', 'jueves' => 'Jueves', 'viernes' => 'Viernes', 'sabado' => 'Sabado', 'domingo' => 'Domingo', 't_h' => 432],
                    ['s' => '', 'lunes' => 'Lunes', 'martes' => 'Martes', 'miercoles' => 'Miercoles', 'jueves' => 'Jueves', 'viernes' => 'Viernes', 'sabado' => 'Sabado', 'domingo' => 'Domingo', 't_h' => 432],
                    ['s' => '', 'lunes' => 'Lunes', 'martes' => 'Martes', 'miercoles' => 'Miercoles', 'jueves' => 'Jueves', 'viernes' => 'Viernes', 'sabado' => 'Sabado', 'domingo' => 'Domingo', 't_h' => 432],
                    ['s' => '', 'lunes' => 'Lunes', 'martes' => 'Martes', 'miercoles' => 'Miercoles', 'jueves' => 'Jueves', 'viernes' => 'Viernes', 'sabado' => 'Sabado', 'domingo' => 'Domingo', 't_h' => 432],
                ],
                [
                    ['s' => '', 'lunes' => 'Lunes', 'martes' => 'Martes', 'miercoles' => 'Miercoles', 'jueves' => 'Jueves', 'viernes' => 'Viernes', 'sabado' => 'Sabado', 'domingo' => 'Domingo', 't_h' => 432],
                    ['s' => '', 'lunes' => 'Lunes', 'martes' => 'Martes', 'miercoles' => 'Miercoles', 'jueves' => 'Jueves', 'viernes' => 'Viernes', 'sabado' => 'Sabado', 'domingo' => 'Domingo', 't_h' => 432],
                    ['s' => '', 'lunes' => 'Lunes', 'martes' => 'Martes', 'miercoles' => 'Miercoles', 'jueves' => 'Jueves', 'viernes' => 'Viernes', 'sabado' => 'Sabado', 'domingo' => 'Domingo', 't_h' => 432],
                    ['s' => '', 'lunes' => 'Lunes', 'martes' => 'Martes', 'miercoles' => 'Miercoles', 'jueves' => 'Jueves', 'viernes' => 'Viernes', 'sabado' => 'Sabado', 'domingo' => 'Domingo', 't_h' => 432],
                ],

            );

            $templateProcessor->cloneBlock('clone', count($valores2), true, true);
            foreach ($valores2 as $key => $value) {
                // if (($key < count($valores2))) {
                $templateProcessor->setValue('mes#' . $key, $value[0]['mes']);
                $templateProcessor->setValue('t_mes#' . $key, $this->getSumHours($h_mes[$key]));
                $templateProcessor->setValue('empresa#' . $key, $empresa);
                $templateProcessor->setValue('tutor#' . $key, $tutor);
                $templateProcessor->setValue('cargo#' . $key, $cargo);
                $templateProcessor->cloneRow('s#' . $key, 4);
                // $templateProcessor->cloneRowAndSetValues('s#' . ($key), $value);
                // }
                foreach ($value as $key2 => $value2) {
                    $tot_mes = [];
                    // var_dump($key2);
                    $templateProcessor->setValue('s#' . ($key) . '#' . ($key2 + 1), '');
                    $templateProcessor->setValue('lunes#' . ($key) . '#' . ($key2 + 1), $value2['lunes']);
                    $templateProcessor->setValue('lu_s#' . ($key) . '#' . ($key2 + 1), $value2['lu_s']);
                    $templateProcessor->setValue('lu_e#' . ($key) . '#' . ($key2 + 1), $value2['lu_e']);


                    $templateProcessor->setValue('martes#' . ($key) . '#' . ($key2 + 1), $value2['martes']);
                    $templateProcessor->setValue('ma_s#' . ($key) . '#' . ($key2 + 1), $value2['ma_s']);
                    $templateProcessor->setValue('ma_e#' . ($key) . '#' . ($key2 + 1), $value2['ma_e']);

                    $templateProcessor->setValue('miercoles#' . ($key) . '#' . ($key2 + 1), $value2['miercoles']);
                    $templateProcessor->setValue('mi_s#' . ($key) . '#' . ($key2 + 1), $value2['mi_s']);
                    $templateProcessor->setValue('mi_e#' . ($key) . '#' . ($key2 + 1), $value2['mi_e']);

                    $templateProcessor->setValue('jueves#' . ($key) . '#' . ($key2 + 1), $value2['jueves']);
                    $templateProcessor->setValue('ju_s#' . ($key) . '#' . ($key2 + 1), $value2['ju_s']);
                    $templateProcessor->setValue('ju_e#' . ($key) . '#' . ($key2 + 1), $value2['ju_e']);

                    $templateProcessor->setValue('viernes#' . ($key) . '#' . ($key2 + 1), $value2['viernes']);
                    $templateProcessor->setValue('vi_s#' . ($key) . '#' . ($key2 + 1), $value2['vi_s']);
                    $templateProcessor->setValue('vi_e#' . ($key) . '#' . ($key2 + 1), $value2['vi_e']);

                    $templateProcessor->setValue('sabado#' . ($key) . '#' . ($key2 + 1), $value2['sabado']);
                    $templateProcessor->setValue('sa_s#' . ($key) . '#' . ($key2 + 1), $value2['sa_s']);
                    $templateProcessor->setValue('sa_e#' . ($key) . '#' . ($key2 + 1), $value2['sa_e']);

                    $templateProcessor->setValue('domingo#' . ($key) . '#' . ($key2 + 1), $value2['domingo']);
                    $templateProcessor->setValue('do_s#' . ($key) . '#' . ($key2 + 1), $value2['do_s']);
                    $templateProcessor->setValue('do_e#' . ($key) . '#' . ($key2 + 1), $value2['do_e']);

                    $templateProcessor->setValue('t_h#' . ($key) . '#' . ($key2 + 1), $value2['t_h']);
                }
            }


            // if ($_POST['tipoA'] == 'pdf') {
            //     //Generar docx temporal
            //     $templateProcessor->saveAs('../../../assets/doc/' . $nombre_doc);

            //     $filepath = "";
            //     $domPdfPath = realpath(SERVERURL . './vendor/dompdf/dompdf');
            //     \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
            //     \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
            //     $phpWord = \PhpOffice\PhpWord\IOFactory::load($filepath); //seleccionar el archivo a convertir
            //     //Save it
            //     $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
            //     $xmlWriter->save('result.pdf');
            // }
            // $temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
            // $templateProcessor->save($temp_file);
            // header("Content-Disposition: attachment; filename='myFile.docx'");
            // readfile($temp_file); // or echo file_get_contents($temp_file);
            // unlink($temp_file);  // remove temp file
            $today = date("YmdHis");
            $fileName = $today . ".docx";
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=" . $fileName);
            header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
            header("Content-Transfer-Encoding: binary");
            header("Expires: 0");
            $templateProcessor->saveAs('php://output');


            // $targetFile = __DIR__ . "/1.docx";
            // $templateProcessor->save($targetFile, 'Word2007');
            // $templateProcessor->saveAs("php://output");
            // readfile($fileName);
            // exit;
            // $templateProcessor->saveAs(SERVERURL . 'controller/' . $fileName);
        } else {
            echo "
            <script>
                alert('No hay datos para generar el documento');
                window.location.href='../';

            </script>
            ";
        }
    }

    public function CtrCrarReporteRegistroPasanteTotal()
    {

        // Create a new pdf document with DOMPDF

        // use Dompdf\Dompdf;

        $dompdf = new Dompdf();
        if (isset($_POST['fecha_reporte_pasante'])) {

            $dompdf->loadHtml($this->templatehtml($_POST['fecha_reporte_pasante']));
        } else {
            $dompdf->loadHtml($this->templatehtml());
        }

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream("Reporte.pdf", array("Attachment" => 1));
    }

    function weekOfMonth($date)
    {
        //Get the first day of the month.
        $firstOfMonth = strtotime(date("Y-m-01", $date));
        //Apply above formula.
        return intval(strftime("%U", $date)) - intval(strftime("%U", $firstOfMonth)) + 1;
    }

    function weekOfMonth2($date)
    {
        // estract date parts
        list($y, $m, $d) = explode('-', date('Y-m-d', strtotime($date)));

        // current week, min 1
        $w = 1;

        // for each day since the start of the month
        for ($i = 1; $i <= $d; ++$i) {
            // if that day was a sunday and is not the first day of month
            if ($i > 1 && date('w', strtotime("$y-$m-$i")) == 0) {
                // increment current week
                ++$w;
            }
        }

        // now return
        return $w;
    }

    function getSumHours($times)
    {
        $minutes = 0; //declare minutes either it gives Notice: Undefined variable
        // loop throught all the times
        foreach ($times as $time) {
            list($hour, $minute) = explode(':', $time);
            $minutes += $hour * 60;
            $minutes += $minute;
        }

        $hours = floor($minutes / 60);
        $minutes -= $hours * 60;

        // returns the time already formatted
        // return sprintf('%02d', $hours);
        return sprintf('%02d:%02d', $hours, $minutes);
    }

    // Funcion para obtener la diferencia de horas
    function getTimeDiff($dtime, $atime)
    {
        $nextDay = $dtime > $atime ? 1 : 0;
        $dep = explode(':', $dtime);
        $arr = explode(':', $atime);
        $diff = abs(mktime($dep[0], $dep[1], 0, date('n'), date('j'), date('y')) - mktime($arr[0], $arr[1], 0, date('n'), date('j') + $nextDay, date('y')));
        $hours = floor($diff / (60 * 60));
        $mins = floor(($diff - ($hours * 60 * 60)) / (60));
        $secs = floor(($diff - (($hours * 60 * 60) + ($mins * 60))));
        if (strlen($hours) < 2) {
            $hours = "0" . $hours;
        }
        if (strlen($mins) < 2) {
            $mins = "0" . $mins;
        }
        if (strlen($secs) < 2) {
            $secs = "0" . $secs;
        }
        // return $hours . ':' . $mins . ':' . $secs;
        return $hours . ':' . $mins;
    }

    function templatehtml($date = null)
    {
        $fecha = isset($date) ? $date : date("Y-m-d");
        $sql = mainModel::ejecutar_consulta_simple("SELECT * FROM asistencia a INNER JOIN personal p ON a.per_id = p.per_id WHERE asi_dia = '$fecha'");
        $row = $sql->fetchAll();
        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <style>
                body,
                button,
                input,
                optgroup,
                select,
                textarea {
                    font-family: BlinkMacSystemFont, -apple-system, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
                }

                table {
                    border-collapse: collapse;
                    border-spacing: 0;
                }

                td,
                th {
                    padding: 0;
                }

                td:not([align]),
                th:not([align]) {
                    text-align: inherit;
                }

                .table {
                    background-color: white;
                    color: #363636;
                }

                .table td,
                .table th {
                    border: 1px solid #dbdbdb;
                    border-width: 0 0 1px;
                    padding: 0.5em 0.75em;
                    vertical-align: top;
                }

                .table thead {
                    background-color: transparent;
                }

                .table thead td,
                .table thead th {
                    border-width: 0 0 2px;
                    color: #363636;
                }

                .table tfoot {
                    background-color: transparent;
                }

                .table tfoot td,
                .table tfoot th {
                    border-width: 2px 0 0;
                    color: #363636;
                }

                .table tbody {
                    background-color: transparent;
                }

                .table tbody tr:last-child td,
                .table tbody tr:last-child th {
                    border-bottom-width: 0;
                }

                .table.is-bordered td,
                .table.is-bordered th {
                    border-width: 1px;
                }

                .table.is-bordered tr:last-child td,
                .table.is-bordered tr:last-child th {
                    border-bottom-width: 1px;
                }

                .table.is-fullwidth {
                    width: 100%;
                }

                .table.is-hoverable tbody tr:not(.is-selected):hover {
                    background-color: #fafafa;
                }

                .table.is-hoverable.is-striped tbody tr:not(.is-selected):hover {
                    background-color: #fafafa;
                }

                .table.is-hoverable.is-striped tbody tr:not(.is-selected):hover:nth-child(even) {
                    background-color: whitesmoke;
                }

                .table.is-narrow td,
                .table.is-narrow th {
                    padding: 0.25em 0.5em;
                }

                .table.is-striped tbody tr:not(.is-selected):nth-child(even) {
                    background-color: #fafafa;
                }

                .table-container {
                    -webkit-overflow-scrolling: touch;
                    overflow: auto;
                    overflow-y: hidden;
                    max-width: 100%;
                }

                .table th {
                    color: #363636;
                }

                .table th:not([align]) {
                    text-align: inherit;
                }

                .is-italic {
                    font-style: italic !important;
                }
                .is-bold {
                    font-weight: bold !important;
                }
            </style>
            <title>Reporte</title>
        </head>


        <body>

            <?php
            $path = SERVERURL . 'src/assets/img/senescyt.png';
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            ?>
            <div class="columns pl-6 pr-6 pt-6">
                <div class="column">
                    <img src="<?php echo $base64 ?>" width="75%" height="54" />
                    <p class="is-italic is-bold">
                        Reporte de asistencia de los pasantes de el área de soporte al usuario
                    </p>
                </div>

            </div>

            <div class="p-5">


                <table class="table is-bordered is-fullwidth">
                    <thead>
                        <!-- fila que muestra la fecha -->
                        <tr>
                            <td><strong>FECHA: </strong></td>
                            <td colspan="4"><?php echo $fecha ?></td>
                        </tr>
                        <tr>
                            <!-- <th>Nro.</th> -->
                            <th>Nombre</th>
                            <th>Hora Entrada</th>
                            <th>Almmuerzo inicio</th>
                            <th>Almmuerzo fin</th>
                            <th>Hora Salida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($row as $key => $value) {
                        ?>
                            <tr>
                                <!-- <td><?php echo $key + 1 ?></td> -->
                                <td><?php echo $value['per_pri_nombre'] . ' ' . $value['per_seg_nombre'] . ' ' . $value['per_pri_apellido'] . ' ' . $value['per_seg_apellido']; ?> </td>
                                <td><?php echo $value['asi_hora_ingreso'] ?></td>
                                <td><?php echo $value['asi_hora_salida_a'] ?></td>
                                <td><?php echo $value['asi_hora_regreso_a'] ?></td>
                                <td><?php echo $value['asi_hora_salida'] ?></td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </body>

        </html>
        <?php
        $html = ob_get_clean();


        return $html;
    }
}


// Template processor instance creation
// $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('resources/Sample_23_TemplateBlock.docx');
