<?php
if ($peticionAjax) {
    require_once "./../model/asistencia.modelo.php";
} else {
    require_once "./model/asistencia.modelo.php";
}

class AsistenciaControlador extends AsistenciaModelo
{

    // Insertar ingreso de pasante
    public function CtrMarcarIngreso()
    {
        $min = '3'; //minutos de perdon
        // PER_ID, DIA, *HORA INGRESO*
        $persona_id = $_SESSION['p_id']; // ID de la persona
        $today = date("Y-m-d"); // Fecha actual
        $now =  date("H:i:s");
        $h_ingreso = date("H:i:s", strtotime($now. ' - '.$min.' minute')); // Hora actual
        //$h_ingreso = strtotime($h_ingreso) - 60*3;


        $datos = [
            "per_id" => $persona_id,
            "dia" => $today,
            "h_ingreso" => $h_ingreso
        ];




        $validar = AsistenciaModelo::MdlValidarAsistencia($datos, "ingreso");
        if (!$validar) {
            $res = 2;
        } else {
            $insertar = AsistenciaModelo::MdlMarcarAsistencia($datos);
            if ($insertar->rowCount() >= 1) {
                $res = 1;
            } else {
                $res = 0;
            }
        }
        echo $res;
        // echo json_encode($alerta);

    }

    // Insertar almuerzo inicio pasante
    public function CtrMarcarAlmuerzoInicio()
    {
        $min = '2'; //minutos de perdon
        // PER_ID, DIA, *HORA INGRESO*
        $persona_id = $_SESSION['p_id']; // ID de la persona
        $today = date("Y-m-d"); // Fecha actual
        $now =  date("H:i:s");
        $h_almuerzo = date("H:i:s", strtotime($now. ' - '.$min.' minute')); // Hora actual

        $datos = [
            "per_id" => $persona_id,
            "dia" => $today,
            "h_almuerzo_inicio" => $h_almuerzo
        ];

        $validar = AsistenciaModelo::MdlValidarAsistencia($datos, "almuerzo_inicio");
        if (!$validar) {
            $res = 2;
        } else {
            $insertar = AsistenciaModelo::MdlMarcarAlmuerzoInicio($datos);
            if ($insertar->rowCount() >= 1) {
                $res = 1;
            } else {
                $res = 0;
            }
        }
        echo $res;
    }

    // Insertar almuerzo fin pasante
    public function CtrMarcarAlmuerzoFin()
    {
        $min = '5'; //minutos de perdon
        // PER_ID, DIA, *HORA INGRESO*
        $persona_id = $_SESSION['p_id']; // ID de la persona
        $today = date("Y-m-d"); // Fecha actual
        $now =  date("H:i:s");
        $h_almuerzo = date("H:i:s", strtotime($now. ' - '.$min.' minute')); // Hora actual

        $datos = [
            "per_id" => $persona_id,
            "dia" => $today,
            "h_almuerzo_fin" => $h_almuerzo
        ];
        $validar_a = AsistenciaModelo::MdlValidarAsistencia($datos, "validar_almuerzo_fin");
        if (!$validar_a) {
            $res = 3;
        } else {
            $validar = AsistenciaModelo::MdlValidarAsistencia($datos, "almuerzo_fin");
            if (!$validar) {
                $res = 2;
            } else {
                $insertar = AsistenciaModelo::MdlMarcarAlmuerzoFin($datos);
                if ($insertar->rowCount() >= 1) {
                    $res = 1;
                } else {
                    $res = 0;
                }
            }
        }
        echo $res;
    }

    // Insertar salida de pasante
    public function CtrMarcarSalida()
    {
        $min = '0'; //minutos de perdon
        // PER_ID, DIA, *HORA INGRESO*
        $persona_id = $_SESSION['p_id']; // ID de la persona
        $today = date("Y-m-d"); // Fecha actual
        $now =  date("H:i:s");
        $h_salida = date("H:i:s", strtotime($now. ' - '.$min.' minute')); // Hora actual

        $datos = [
            "per_id" => $persona_id,
            "dia" => $today,
            "h_salida" => $h_salida
        ];

        if (!isset($_POST['no_almuerzo'])) {
            if (!AsistenciaModelo::MdlValidarAsistencia($datos, "validar_almuerzo")) {
                $res = 3;
            } else {

                $validar = AsistenciaModelo::MdlValidarAsistencia($datos, "salida");

                if (!$validar) {
                    $res = 2;
                } else {
                    $insertar = AsistenciaModelo::MdlMarcarSalida($datos);
                    if ($insertar->rowCount() >= 1) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                }
            }
        } else {
            $reset_almuerzo = AsistenciaModelo::MdlResetAlmuerzo($datos);
            if ($reset_almuerzo->rowCount() >= 0) {
                $validar = AsistenciaModelo::MdlValidarAsistencia($datos, "salida");

                if (!$validar) {
                    $res = 2;
                } else {
                    $insertar = AsistenciaModelo::MdlMarcarSalida($datos);
                    if ($insertar->rowCount() >= 1) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                }
            } else {
                $res = 'Error';
            }
        }

        echo $res;
    }

    // Mostrar horas de ingreso y salida
    public function CtrMostrarAsistenciaPasante()
    {


        $persona_id = $_SESSION['p_id'];
        $hor_id = ($_SESSION['hor_id'] != null) ? $_SESSION['hor_id'] : 1;

        // @$persona_id = $_SESSION['p_id']; // ID de la persona
        // Obtener los registros del pasante
        $sql = mainModel::ejecutar_consulta_simple("SELECT * FROM asistencia WHERE per_id = $persona_id ORDER BY asi_id DESC");
        $hor = mainModel::ejecutar_consulta_simple("SELECT * FROM horario WHERE hor_id = '$hor_id'");
        $hors = $hor->fetch();
        // var_dump($hors);
        //Variable total de horas
        $horas = array();

        $tabla = "";
        $tabla .= '<table id="example" class="table stripe row-border order-column nowrap" style="width:100%; box-sizing: inherit;">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Ingreso</th>
                <th>Almuerzo inicio</th>
                <th>Almuerzo fin</th>
                <th>Salida</th>
                <th>Horas</th>
            </tr>
        </thead>
        <tbody>';
        if ($sql->rowCount() >= 1) {

            $datos = $sql->fetchAll();
            foreach ($datos as $row) {

                // vars
                $fecha = $row['asi_dia'];
                $h_ingreso = $row['asi_hora_ingreso'];
                $h_almuerzo_inicio = $row['asi_hora_salida_a'];
                $h_almuerzo_fin = $row['asi_hora_regreso_a'];
                // $h_salida = $row['asi_hora_salida'];
                $h_salida = ($row['asi_hora_salida'] == "00:00:00") ? $row['asi_hora_ingreso'] : $row['asi_hora_salida'];



                
                $a_marc = ($h_almuerzo_inicio != '00:00:00' && $h_almuerzo_fin != '00:00:00') ? true : false;
                $s_marc = ($h_salida != '00:00:00') ? true : false;

                //Diferencia entre horas entrada y salida
                $diff = $this->getTimeDiff($h_ingreso, $h_salida);

                //Diferencia entre horas almuerzo inicio y almuerzo fin
                $diff_a = $this->getTimeDiff($h_almuerzo_inicio, $h_almuerzo_fin);
                
                $diff_b = $this->getTimeDiff($h_ingreso,$h_almuerzo_inicio);

                $diff_b_al = $this->getSumHours([$diff_a, $h_ingreso]);


                if ($h_almuerzo_inicio != '00:00:00' || $h_almuerzo_fin != '00:00:00') {
                    
                
                //Total de horas trabajadas
                if($h_almuerzo_inicio != '00:00:00' && $h_almuerzo_fin == '00:00:00' && $h_salida == $h_ingreso){
                    
                    $total_horas = $this->getTimeDiff($h_ingreso,  $h_almuerzo_inicio);

                }elseif($a_marc && $h_salida == $h_ingreso){

                    $total_horas = $this->getTimeDiff($diff_b_al, $h_almuerzo_inicio);

                }elseif ($a_marc && $s_marc) {
                    $total_horas = $this->getTimeDiff($diff_a, $diff);
                }
            }else{
                    $total_horas = $this->getTimeDiff($diff_a, $diff);
                }
                // $total_horas = $this->getTimeDiff(($a_marc && !$s_marc) ? $h_almuerzo_inicio : $diff_a,  $diff);

                if ($hor_id != 1) {

                    $h_i = new DateTime($h_ingreso);
                    $h_a_i = new DateTime($h_almuerzo_inicio);
                    $h_a_f = new DateTime($h_almuerzo_fin);
                    $h_s = new DateTime($h_salida);

                    $hor_ingreso = new DateTime($hors['hor_entrada']);
                    $hor_salida_a = new DateTime($hors['hor_salida_a']);
                    $hor_regreso_a = new DateTime($hors['hor_regreso_a']);
                    $hor_salida = new DateTime($hors['hor_salida']);
                    // $datetime2 = new DateTime($h_almuerzo_end);

                    // $interval = $h_a_i->diff($h_a_f);
                    // $v_hora =  $interval->format('%R%H:%i') . ' ';
                    //Hora adelantada o retrasada
                    $hor_dif_ingreso = $h_i->diff($hor_ingreso);
                    $hor_dif_ingreso_n = $hor_dif_ingreso->format('%R%H:%I');

                    $hor_dif_salida = $hor_salida->diff($h_s);
                    $hor_dif_salida_n = $hor_dif_salida->format('%R%H:%I');
                } else {
                    $hor_dif_ingreso_n = "";
                    $hor_dif_salida_n = "";
                }

                if ($h_almuerzo_inicio == "00:00:00") {
                    $h_almuerzo_inicio = "--:--:--";
                }
                if ($h_almuerzo_fin == "00:00:00") {
                    $h_almuerzo_fin = "--:--:--";
                }
                if ($h_salida == $h_ingreso) {
                    $h_salida = "00:00:00";
                }
                $horas[] = $total_horas;

                if ($h_almuerzo_inicio == "--:--:--" && $h_almuerzo_fin == "--:--:--" && $h_salida != "00:00:00") {


                    $tabla .= '
                    <tr>
                    <td style="vertical-align: middle;">' . $fecha . '</td>
                    <td style="vertical-align: middle;">' . $h_ingreso . ' <span class="h_diff is-small tag">' . $hor_dif_ingreso_n . '</span></td>
                    <td style="vertical-align: middle;" colspan="2" class="has-text-centered">Sin almuerzo</td>
                    <td style="display: none;"></td>
                    <td style="vertical-align: middle;">' . $h_salida . ' <span class="h_diff is-small tag">' . $hor_dif_salida_n . '</span></td>
                    <td style="vertical-align: middle;">' . $total_horas . '</td>
                    </tr>
                    ';
                } else {
                    $tabla .= '
                    <tr>
                    <td style="vertical-align: middle;">' . $fecha . '</td>
                    <td style="vertical-align: middle;">' . $h_ingreso . '  <span class="h_diff is-small tag">' . $hor_dif_ingreso_n . '</span></td>
                    <td style="vertical-align: middle;">' . $h_almuerzo_inicio . '</td>
                    <td style="vertical-align: middle;">' . $h_almuerzo_fin . '</td>
                    <td style="vertical-align: middle;">' . $h_salida . ' <span class="h_diff is-small tag">' . $hor_dif_salida_n . '</span></td>
                    <td style="vertical-align: middle;">' . $total_horas . '</td>
                    </tr>
                    ';
                }
            }
        } else {
            $tabla .= '
            <tr>
                <td colspan="6">No hay registros</td>
            </tr>
            ';
        }

        $tabla .= '</tbody>
        </table>
        <input class="total_horas" value="' . $this->getSumHours($horas) . '" hidden></input>
        
        ';
        echo $tabla;
    }

    // Mostrar el Home del pasante
    public function CtrMostrarInicioPasante()
    {
        $persona_id = $_SESSION['p_id']; // ID de la persona
        //fecha actual
        $today = date("Y-m-d");
        $sql = mainModel::ejecutar_consulta_simple("SELECT * FROM asistencia WHERE per_id = $persona_id and asi_dia = '$today'");
        $card = "";

        // if ($sql->rowCount() == 0) {
        //     $insertar = AsistenciaModelo::MdlInsertarFechaPasante($persona_id);
        //     if ($insertar->rowCount() >= 1) {
        //         // refresh page
        //         if (headers_sent()) {
        //             echo "<script type='text/javascript'>window.top.location='".SERVERURL."/home';</script>"; exit;
        //         }else{
        //             header('Location: '.SERVERURL.'home');
        //         }
        //     }
        // }
        // var_dump($datos);


        $datos = $sql->fetch();
        $card .= '
        <div class="list-item box">
            <div class="columns is-mobile">
                <div class="column">
                    <div class="list-item-content is-small">
                        <div class="list-item-title title is-5">Ingreso</div>
                    ';
        // Condicion en ingreso
        if (@$datos['asi_hora_ingreso'] == "00:00:00" || $sql->rowCount() == 0) {
            $card .= '
                        <div id="des_m_entrada" class="list-item-description has-text-grey">Sin marcar</div>
                    </div>
                </div>
                <div class="column">
                    <div class="list-item-controls is-small">
                        <div class="buttons is-right">
                            <button type="submit" id="m_entrada" class="m_entrada button is-success is-light">
                                <span class="icon is-small">
                                    <i class="fa fa-edit"></i>
                                </span>
                                <span id="text_m_entrada">Marcar</span>
                ';
        } elseif (@$datos['asi_hora_ingreso'] != "00:00:00") {
            $card .= '
                        <div id="des_m_entrada" class="list-item-description has-text-grey">Marcado a la hora: ' . @$datos['asi_hora_ingreso'] . '</div>
                    </div>
                </div>
                <div class="column">
                    <div class="list-item-controls is-small">
                        <div class="buttons is-right">
                            <button type="submit" id="m_entrada" class="m_entrada button is-light" disabled=""><span>✔ Marcado</span>
                ';
        }

        $card .= '
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        ';

        // Si el ingreso esta marcado
        if (@isset($datos['asi_hora_ingreso']) && @$datos['asi_hora_ingreso'] != "00:00:00") {


            // Condicion en almuerzo inicio
            $card_alumuerzo_inicio = "";
            $card_alumuerzo_fin = "";

            // Si la salida esta marcada el almuerzo no se muestra
            if ($datos['asi_hora_salida'] == "00:00:00" || ($datos['asi_hora_regreso_a'] != "00:00:00" || $datos['asi_hora_salida_a'] != "00:00:00")) {


                $card_alumuerzo_inicio .= "<div class='box' id='almuerzo' style='display: none;'>";
                $card_alumuerzo_inicio .= '
                <div class="list-item box">
                <div class="columns is-mobile">
                    <div class="column">
                        <div class="list-item-content is-small">
                            <div class="list-item-title title is-5">Almuerzo inicio</div>
                        ';

                if (@$datos['asi_hora_salida_a'] == "00:00:00") {
                    $card_alumuerzo_inicio .= '
                            <div id="des_m_almuerzo_inicio" class="list-item-description has-text-grey">Sin marcar</div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="list-item-controls is-small">
                            <div class="buttons is-right">
                                <button type="submit" id="m_almuerzo_inicio" class="button is-success is-light">
                                    <span class="icon is-small">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                    <span id="text_m_almuerzo_inicio">Marcar</span>
                            
                    ';
                } elseif (@$datos['asi_hora_salida_a'] != "00:00:00") {
                    $card_alumuerzo_inicio .= '
                            <div id="des_m_almuerzo_inicio" class="list-item-description has-text-grey">Marcado a la hora: ' . @$datos['asi_hora_salida_a'] . '</div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="list-item-controls is-small">
                            <div class="buttons is-right">
                                <button type="submit" id="m_almuerzo_inicio" class="button is-light" disabled=""><span>✔ Marcado</span>
                    ';
                }
                $card_alumuerzo_inicio .= '
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                ';

                // Condicion en almuerzo fin

                $card_alumuerzo_fin .= '
                <div class="list-item box">
                <div class="columns is-mobile">
                    <div class="column">
                        <div class="list-item-content is-small">
                            <div class="list-item-title title is-5">Almuerzo fin</div>
                        ';
                if (@$datos['asi_hora_regreso_a'] == "00:00:00") {
                    $card_alumuerzo_fin .= '
                            <div id="des_m_almuerzo_fin" class="list-item-description has-text-grey">Sin marcar</div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="list-item-controls is-small">
                            <div class="buttons is-right">
                                <button type="submit" id="m_almuerzo_fin" class="button is-success is-light">
                                    <span class="icon is-small">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                    <span >Marcar</span>
                                    ';
                } elseif (@$datos['asi_hora_regreso_a'] != "00:00:00") {
                    $card_alumuerzo_fin .= '
                            <div id="des_m_almuerzo_inicio" class="list-item-description has-text-grey">Marcado a la hora: ' . @$datos['asi_hora_regreso_a'] . '</div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="list-item-controls is-small">
                            <div class="buttons is-right">
                                <button type="submit" id="m_almuerzo_inicio" class="button is-light" disabled=""><span>✔ Marcado</span>
                                       
                                    ';
                }
                $card_alumuerzo_fin .= '
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                ';
            } else if ($datos['asi_hora_salida'] != "00:00:00" && $datos['asi_hora_regreso_a'] == "00:00:00" && $datos['asi_hora_salida_a'] == "00:00:00") {
                // var_dump(@$datos['asi_hora_salida']);
                $card_alumuerzo_fin .= '<div class="box"><span class="title has-text-warning is-4">Sin almuerzo</span></div>';
            }
            // Condicion en salida
            $card_salida = "";
            $card_salida .= '
            <div class="list-item box">
                <div class="columns is-mobile">
                    <div class="column">
                        <div class="list-item-content is-small">
                            <div class="list-item-title title is-5">Salida</div>
                        ';
            if (@$datos['asi_hora_salida'] == "00:00:00") {
                $card_salida .= '
                            <div id="des_m_salida" class="list-item-description has-text-grey">Sin marcar</div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="list-item-controls is-small">
                            <div class="buttons is-right">
                                <button id="m_salida" class="button is-success is-light">
                                    <span class="icon is-small">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                    <span>Marcar</span>
                ';
            } else if (@$datos['asi_hora_salida'] != "00:00:00") {
                $card_salida .= '
                            <div id="des_m_salida" class="list-item-description has-text-grey">Marcado a la hora: ' . @$datos['asi_hora_salida'] . '</div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="list-item-controls is-small">
                            <div class="buttons is-right">
                                <button id="m_salida" class="button is-light" disabled=""><span>✔ Marcado</span>
                           
                ';
            }
            $card_salida .= '
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
            $card .= $card_alumuerzo_inicio . $card_alumuerzo_fin . $card_salida;
        }
        echo $card;
        // echo "<script>console.log(" . json_encode($card) . ")</script>";
    }

    //Mostrar calendario para FullCalendar
    public function CtrMostrarCalendario()
    {
        $id_pasante = (isset($_POST['id_p'])) ?  mainModel::decryption($_POST['id_p']) : $_SESSION['p_id'];

        $query = "SELECT * FROM asistencia WHERE per_id = '$id_pasante'";
        $sql = mainModel::ejecutar_consulta_simple($query);
        $datos = $sql->fetchAll();
        $card = array();
        $today = date("Y-m-d");
        foreach ($datos as $key => $value) {
            // $card[$key]['id'] = $value['asi_id'];
            // $card[$key]['title'] = 'Valor de ' . $value['asi_id'];

            //Si se conmpleto el dias de asistencia
            if ($value['asi_hora_salida'] != "00:00:00" && $value['asi_hora_ingreso'] != "00:00:00") {
                $card[$key]['id'] = $value['asi_id'];
                $card[$key]['h_ingreso'] = $value['asi_hora_ingreso'];
                $card[$key]['h_salida'] = $value['asi_hora_salida'];

                $card[$key]['title'] = 'Completo';
                $card[$key]['dia'] = $value['asi_dia'];
                $card[$key]['start'] = $value['asi_dia'] . ' ' . $value['asi_hora_ingreso'];
                $card[$key]['end'] = $value['asi_dia'] . ' ' . $value['asi_hora_salida'];
                $card[$key]['color'] = '#00d1b2';
            } elseif ($today == $value['asi_dia'] && $value['asi_hora_ingreso'] != "00:00:00" && $value['asi_hora_salida'] == "00:00:00") {
                $card[$key]['id'] = $value['asi_id'];
                $card[$key]['h_ingreso'] = $value['asi_hora_ingreso'];
                $card[$key]['h_salida'] = $value['asi_hora_salida'];

                $card[$key]['title'] = 'Pendiente';
                $card[$key]['dia'] = $value['asi_dia'];
                $card[$key]['start'] = $value['asi_dia'] . ' ' . $value['asi_hora_ingreso'];
                $card[$key]['end'] = $value['asi_dia'] . ' ' . $value['asi_hora_salida'];
                $card[$key]['color'] = '#ff7675';
            } else {
                // $value['asi_hora_salida'] = $value['asi_hora_ingreso'];
                $card[$key]['id'] = $value['asi_id'];
                $card[$key]['title'] = 'Incompleto';
                $card[$key]['dia'] = $value['asi_dia'];

                $card[$key]['h_ingreso'] = $value['asi_hora_ingreso'];
                $card[$key]['h_salida'] = $value['asi_hora_salida'];
                $card[$key]['start'] = $value['asi_dia'] . ' ' . $value['asi_hora_ingreso'];
                $card[$key]['end'] = $value['asi_dia'] . ' ' . $value['asi_hora_salida'];
                $card[$key]['color'] = '#ff0000';
            }
            // $card[$key]['start'] = $value['asi_dia'] . ' ' . $value['asi_hora_ingreso'];
            // $card[$key]['end'] = $value['asi_dia'] . ' ' . $value['asi_hora_salida'];
            // $card[$key]['color'] = '#00d1b2';
        }
        echo json_encode($card);
    }

    public function CtrGetDatesById($id)
    {
        $id = mainModel::decryption($id);
        $query = "SELECT * FROM asistencia WHERE per_id = '$id' ORDER BY asi_dia DESC";
        $sql = mainModel::ejecutar_consulta_simple($query);
        $datos = $sql->fetchAll();
        $fechas = "";
        foreach ($datos as $key => $value) {

            $fechas .= '\'' . $value['asi_dia'] . '\',';
        }
        echo $fechas;
    }

    // =ADMIN=

    // Mostrar el Home del Administrador
    public function CtrMostrarInicioAdmin()
    {
        $today = date("Y-m-d");
        $sql = mainModel::ejecutar_consulta_simple('SELECT a.*, CONCAT(p.per_pri_nombre, " ", p.per_seg_nombre, " ", p.per_pri_apellido, " ", p.per_seg_apellido) AS nombre FROM asistencia AS a
        INNER JOIN personal AS p
        ON a.per_id = p.per_id
        WHERE a.asi_dia = "' . $today . '"
        ');
        // $sql = 'SELECT a.*, CONCAT(p.per_pri_nombre, " ", p.per_seg_nombre, " ", p.per_pri_apellido, " ", p.per_seg_apellido) AS nombre FROM asistencia AS a
        // INNER JOIN personal AS p
        // ON a.per_id = p.per_id
        // WHERE a.asi_dia = "'.$today.'"
        // ';
        $list = "";
        if ($sql->rowCount() >= 1) {



            $datos = $sql->fetchAll();
            foreach ($datos as $row) {
                $name = mb_strtolower($row['nombre']);
                $list .= '
                <div class="list-item" id="' . mainModel::encryption($row['asi_id']) . '">
                    <div class="list-item-content">
                            <div class="list-item-title is-size-3 mb-1">' . ucwords($name) . '</div>
                            <div class="list-item-description">
                ';
                if ($row['asi_hora_ingreso'] != "00:00:00") {
                    $list .= '
                                <div class="tag is-info is-medium h_entrada">' . $row['asi_hora_ingreso'] . '</div>
                   ';
                }
                if ($row['asi_hora_salida_a'] != "00:00:00") {
                    $list .= '
                                <div class="tag is-info is-medium h_almuerzo_start">' . $row['asi_hora_salida_a'] . '</div>
                   ';
                    if ($row['asi_hora_regreso_a'] != "00:00:00") {
                        $list .= '
                                <div class="tag is-info is-medium h_almuerzo_end">' . $row['asi_hora_regreso_a'] . '</div>
                    ';
                    }
                } elseif (($row['asi_hora_salida_a'] == "00:00:00" || $row['asi_hora_regreso_a'] == "00:00:00") && $row['asi_hora_salida'] != "00:00:00") {
                    $list .= '
                                <div class="tag is-info is-medium">Sin almuerzo</div>
                    ';
                }
                if ($row['asi_hora_salida'] != "00:00:00") {
                    $list .= '
                                <div class="tag is-info is-medium h_salida">' . $row['asi_hora_salida'] . '</div>
                    ';
                }
                $list .= '
                            </div>
                        </div>
                    <div class="list-item-controls">
                        <div class="buttons">
                            <button id="' . mainModel::encryption($row['per_id']) . '"  data-tooltip="Registros" class="button is-dark is-inverted verRegistro">
                                <span class="icon">
                                    <i class="fa fa-list"></i>
                                </span>
                            </button>

                            <button id="editar_registro" data-tooltip="Editar" class="button is-dark is-inverted modal-button" data-target="edit_hora" data-toggle="modal">
                                <span class="icon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                            </button>
                            
                            <button id="borrar_registro" data-tooltip="Eliminar" class="button is-dark is-inverted">
                                <span class="icon">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <input type="hidden" id="id_asistencia" value="' . mainModel::encryption($row['asi_id']) . '">
                <input type="hidden" id="id_personal" value="' . $row['per_id'] . '">
                ';
            }
        } else {
            $list .= '
                <div class="title is-4 mb-2 has-text-warning-dark">
                    Nadie ha marcado su asistencia aún 😪
                </div>
            ';
        }
        echo $list;
    }

    // Para editar el registro de un pasante
    public function CtrEditarRegistro()
    {
        $id_asistencia = mainModel::decryption($_POST['asiId_u']);
        $h_ingreso = $_POST['h_entrada_u'];
        $h_almuerzo_start = $_POST['h_almuerzo_start_u'];
        $h_almuerzo_end = $_POST['h_almuerzo_end_u'];
        $h_salida = $_POST['h_salida_u'];
        $today = date("Y-m-d");

        $datetime1 = new DateTime($h_almuerzo_start);
        $datetime2 = new DateTime($h_almuerzo_end);

        $interval = $datetime1->diff($datetime2);
        $v_hora =  $interval->format('%R%H:%i:%s') . ' ';

        // validar que las horas ingresadas sean secuenciales
        if (
            // ((strtotime($h_ingreso) > strtotime($h_almuerzo_start)) 
            // || (((strtotime($h_almuerzo_end) > strtotime($h_salida))) && ($h_almuerzo_start != '00:00:00' || $h_almuerzo_end != '00:00:00')))
            // || ((strtotime($h_ingreso) > strtotime($h_salida)) && $h_salida != '00:00:00')
            ((strtotime($h_ingreso) > strtotime($h_almuerzo_start)) && $h_almuerzo_start != '00:00:00')
            || ((strtotime($h_almuerzo_end) > strtotime($h_salida)) && $h_salida != '00:00:00')
            || ((strtotime($h_ingreso) > strtotime($h_salida)) && $h_salida != '00:00:00')
            || ((strtotime($h_almuerzo_start) > strtotime($h_almuerzo_end)) && $h_almuerzo_end != '00:00:00')
            || ((strtotime($h_almuerzo_start) > strtotime($h_salida)) && $h_salida != '00:00:00')


        ) {
            $res =  'error_s';
        } else {

            if (strpos($v_hora, '-') && ($h_almuerzo_start != '00:00:00' && $h_almuerzo_end != '00:00:00')) {
                $res = 'error_h';
            } elseif ($h_almuerzo_start == '00:00:00' && $h_almuerzo_end != '00:00:00') {
                $res = 'error_a';
            } else {

                if (($h_almuerzo_start == '00:00:00' || $h_almuerzo_end == '00:00:00') && $h_salida != '00:00:00') {
                    $h_almuerzo_start = '00:00:00';
                    $h_almuerzo_end = '00:00:00';
                }

                $datos = [
                    "asi_id" => $id_asistencia,
                    "asi_hora_ingreso" => $h_ingreso,
                    "asi_hora_salida_a" => $h_almuerzo_start,
                    "asi_hora_regreso_a" => $h_almuerzo_end,
                    "asi_hora_salida" => $h_salida,
                    "asi_dia" => $today
                ];

                $sql = AsistenciaModelo::mdlEditarRegistro($datos);
                // var_dump($sql);
                // var_dump($sql->errorInfo());
                if ($sql->rowCount() >= 1) {
                    $res = 'ok';
                    //Auditoria
                    $datos_a = [
                        "responsable" => $_SESSION['nombre'] . " " . $_SESSION['apellido'],
                        "accion" => "Editar",
                        "descripcion" => "Editó un registro de asistencia",
                        "valorantes" => $id_asistencia,
                        "valordespues" => "",
                    ];
                    mainModel::insertar_auditoria($datos_a);
                } else {
                    $res = 'error';
                }
            }
        }
        echo $res;
    }

    // Para motrar pasantes que no han marcado su asistencia del dia
    public function CtrMostrarPasantesSinRegistro()
    {
        $today = date("Y-m-d");

        $pasantes = mainModel::ejecutar_consulta_simple('SELECT p.per_estado, p.per_id,CONCAT(p.per_pri_nombre, " ", p.per_seg_nombre, " ", p.per_pri_apellido, " ", p.per_seg_apellido) AS nombre FROM personal AS p
        INNER	JOIN usuario AS u
        ON p.per_id = u.per_id
        INNER JOIN rol AS r
        ON u.rol_id = r.rol_id
        WHERE r.rol_nombre = "PASANTE" AND p.per_estado = "1"');



        $pasantes_con_registro = mainModel::ejecutar_consulta_simple('SELECT p.per_estado, p.per_id,CONCAT(p.per_pri_nombre, " ", p.per_seg_nombre, " ", p.per_pri_apellido, " ", p.per_seg_apellido) AS nombre FROM personal AS p
        INNER	JOIN usuario AS u
        ON p.per_id = u.per_id
        INNER JOIN rol AS r
        ON u.rol_id = r.rol_id
        INNER JOIN asistencia AS a
        ON a.per_id = p.per_id
        WHERE r.rol_nombre = "PASANTE" AND p.per_estado = "1" AND a.asi_dia = "' . $today . '"');

        $pasantes_sin_registro_id = [];
        $pasantes_sin_registro_nombre = [];

        $p = $pasantes->fetchAll();
        $pr = $pasantes_con_registro->fetchAll();
        $id = array();
        $id_2 = array();
        $nombre = array();
        $nombre_2 = array();
        // $a = each($p);
        foreach ($p as $key => $value) {
            // $r['per_id'] = $value['per_id'];
            // $r['nombre'] = $value['nombre'];
            $id[] = $value['per_id'];
            $nombre[] = $value['nombre'];

            // $r[] = "{$value['per_id']} => {$value['nombre']}";
        }
        foreach ($pr as $key => $value) {
            // $r2['per_id'] = $value['per_id'];
            // $r2['nombre'] = $value['nombre'];
            $id_2[] = $value['per_id'];
            $nombre_2[] = $value['nombre'];
            // $r2[] = "{$value['per_id']} => {$value['nombre']}";
        }
        // var_dump($r);
        // echo '<br>';
        // var_dump($r2);
        // echo '<br>';
        // var_dump(array_diff($r, $r2));
        $pasantes_sin_registro_id = array_diff($id, $id_2);
        $pasantes_sin_registro_nombre = array_diff($nombre, $nombre_2);
        // var_dump($pasantes_sin_registro_id);
        // echo '<br>';
        // var_dump($pasantes_sin_registro_nombre);


        //Unir los arrays
        // echo '<br>';
        foreach ($pasantes_sin_registro_id as $key => $value) {
            $pasantes_sin_registro[] = array(
                'per_id' => $value,
                'nombre' => $pasantes_sin_registro_nombre[$key]
            );
        }
        // var_dump($pasantes_sin_registro);


        // var_dump(array_diff($r, $r2));
        // var_dump($pasantes_sin_registro);

        // foreach ($pasantes as $key => $value) {
        //     $existe = false;
        //     foreach ($pasantes_con_registro as $key2 => $value2) {
        //         if ($value['per_id'] == $value2['per_id']) {
        //             $existe = true;
        //         }
        //     }
        //     if (!$existe) {
        //         $pasantes_sin_registro[] = $value;
        //     }
        // }

        // var_dump($pasantes_con_registro->fetchAll());
        // echo '<br>';
        // var_dump($pasantes->fetchAll());
        // echo '<br>';

        // var_dump(array_diff($pasantes->fetchAll(), $pasantes_con_registro->fetchAll()));
        $tabla = '<table id="pasantes" class="table dataTable stripe row-border order-column" style="width:100%">';
        $tabla .= ' 
        <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
        ';
        if (isset($pasantes_sin_registro)) {
            foreach ($pasantes_sin_registro as $key => $value) {
                $name = mb_strtolower($value['nombre']);

                $tabla .= '
            
            <tr>
              <td style="vertical-align: middle;">' . ucwords($name) . '</td>
              <td>
                
                <button id="nueva_asistencia" class="button is-success is-outlined is-small">
                  <span class="icon is-small">
                    <i class="fa fa-plus"></i>
                  </span>
                  <span>MARCAR</span>
                  <input type="hidden" id="' . mainModel::encryption($value['per_id']) . '">
                </button>
                
              </td>

            </tr>
            
          
        
            ';
                // $tabla .= '<tr>
                // <td>' . $value . '</td>
                // <td>
                // <button class="btn btn-success btn-sm" onclick="agregarRegistro(' . $key . ')">Agregar</button>
                // </td>
                // </tr>';
            }
        } else {
            $tabla .= '
        <tr>
          <td colspan="2" class="has-text-centered">Todos han marcado &#128515</td>
          <td style="display: none;"></td>
        </tr>
        ';
        }
        $tabla .= '</tbody>
        </table>';
        echo $tabla;

        // var_dump($pasantes_sin_registro);

    }

    // Para borrar un registro de un pasante
    public function CtrEliminarRegistro()
    {
        $id_asistencia = mainModel::decryption($_POST['id']);
        $today = date("Y-m-d");
        $sql = mainModel::ejecutar_consulta_simple("DELETE FROM asistencia WHERE asi_id = '$id_asistencia'");
        if ($sql->rowCount() >= 1) {
            $res = "ok";
            //Auditoria
            $datos_a = [
                "responsable" => $_SESSION['nombre'] . " " . $_SESSION['apellido'],
                "accion" => "Eliminar",
                "descripcion" => "Eliminó un registro de asistencia",
                "valorantes" => $id_asistencia,
                "valordespues" => "",
            ];
            mainModel::insertar_auditoria($datos_a);
        } else {
            $res = "error";
        }
        echo $res;
    }

    // Para crear un registro de un pasante
    public function CtrCrearRegistro()
    {
        $id_pasante = mainModel::decryption($_POST['per_id_C']);
        $today = date("Y-m-d");
        //Hora actual
        $hora_actual = date("H:i:s");

        $sql = mainModel::ejecutar_consulta_simple("INSERT INTO asistencia (asi_dia,asi_hora_ingreso, per_id) VALUES ('$today','$hora_actual','$id_pasante')");
        if ($sql->rowCount() >= 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        echo $res;
    }

    // Mostrar horas de ingreso y salida
    public function CtrMostrarAsistenciaPasanteTotal()
    {


        // $persona_id = $_SESSION['p_id']; // ID de la persona
        // Obtener los registros del pasante
        $sql = mainModel::ejecutar_consulta_simple("SELECT a.*, p.per_id,p.per_estado,   CONCAT(p.per_pri_nombre, ' ', p.per_pri_apellido) as nombre FROM asistencia a INNER JOIN personal p ON a.per_id = p.per_id WHERE p.per_estado = 1 ORDER BY asi_id DESC");

        //Variable total de horas
        $horas = array();

        $tabla = "";
        $tabla .= '<table id="totalAsistencia" class="table stripe row-border order-column nowrap" style="width:100%; box-sizing: inherit;">
        <thead>
            <tr>
                <th>Pasante</th>
                <th>Fecha</th>
                <th>Ingreso</th>
                <th>Almuerzo inicio</th>
                <th>Almuerzo fin</th>
                <th>Salida</th>
                <th>Horas</th>
                <th style="text-align: center;">Acción</th>
            </tr>
        </thead>
        <tbody>';
        if ($sql->rowCount() >= 1) {

            $datos = $sql->fetchAll();
            foreach ($datos as $row) {

                // vars
                $fecha = $row['asi_dia'];
                $h_ingreso = $row['asi_hora_ingreso'];
                $h_almuerzo_inicio = $row['asi_hora_salida_a'];
                $h_almuerzo_fin = $row['asi_hora_regreso_a'];
                $h_salida = ($row['asi_hora_salida'] == "00:00:00") ? $row['asi_hora_ingreso'] : $row['asi_hora_salida'];
                $nombre = mb_strtolower($row['nombre']);


                //Diferencia entre horas entrada y salida
                $diff = $this->getTimeDiff($h_ingreso, $h_salida);

                //Diferencia entre horas almuerzo inicio y almuerzo fin
                $diff_a = $this->getTimeDiff($h_almuerzo_inicio, $h_almuerzo_fin);

                //Total de horas trabajadas
                $total_horas = $this->getTimeDiff($diff_a, $diff);



                if ($h_almuerzo_inicio == "00:00:00") {
                    $h_almuerzo_inicio = "--:--:--";
                }
                if ($h_almuerzo_fin == "00:00:00") {
                    $h_almuerzo_fin = "--:--:--";
                }
                if ($h_salida == $h_ingreso) {
                    $h_salida = "00:00:00";
                }
                $horas[] = $total_horas;

                if ($h_almuerzo_inicio == "--:--:--" && $h_almuerzo_fin == "--:--:--" && $h_salida != "00:00:00") {


                    $tabla .= '
                    <tr>
                    <td style="vertical-align: middle;">' . ucwords($nombre) . '</td>
                    <td style="vertical-align: middle;">' . $fecha . '</td>
                    <td style="vertical-align: middle;">' . $h_ingreso . '</td>
                    <td colspan="2" class="has-text-centered">Sin almuerzo</td>
                    <td style="display: none;"></td>
                    <td style="vertical-align: middle;">' . $h_salida . '</td>
                    <td style="vertical-align: middle;">' . $total_horas . '</td>
                    <td style="vertical-align: middle;">
                        
                        <button style="height: fit-content;" id="' . mainModel::encryption($row['per_id']) . '" class="button is-info is-outlined verRegistro" data-tooltip="Lista">
                            <span class="icon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </button>
                        <button style="height: fit-content;" id="' . mainModel::encryption($row['asi_id']) . '" class="button is-danger is-outlined eliminarRegistro" data-tooltip="Eliminar" >
                            <span class="icon">
                                <i class="fa fa-trash"></i>
                            </span>
                        </button>
                    </td>
                    </tr>
                    ';
                } else {
                    $tabla .= '
                    <tr>
                    <td style="vertical-align: middle;">' . ucwords($nombre) . '</td>
                    <td style="vertical-align: middle;">' . $fecha . '</td>
                    <td style="vertical-align: middle;">' . $h_ingreso . '</td>
                    <td style="vertical-align: middle;">' . $h_almuerzo_inicio . '</td>
                    <td style="vertical-align: middle;">' . $h_almuerzo_fin . '</td>
                    <td style="vertical-align: middle;">' . $h_salida . '</td>
                    <td style="vertical-align: middle;">' . $total_horas . '</td>
                    <td style="vertical-align: middle;">
                        <button style="height: fit-content;" id="' . mainModel::encryption($row['per_id']) . '" class="button is-info is-outlined verRegistro" data-tooltip="Lista">
                            <span class="icon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </button>
                        <button style="height: fit-content;" id="' . mainModel::encryption($row['asi_id']) . '" class="button is-danger is-outlined eliminarRegistro" data-tooltip="Eliminar" >
                            <span class="icon">
                                <i class="fa fa-trash"></i>
                            </span>
                        </button>
                    </td>
                    </tr>
                    ';
                }
            }
        } else {
            $tabla .= '
            <tr>
                <td colspan="6">No hay registros</td>
            </tr>
            ';
        }

        $tabla .= '</tbody>
        </table>
        <input class="total_horas" value="' . $this->getSumHours($horas) . '" hidden></input>
        
        ';
        echo $tabla;
    }

    // Mostrar horas de ingreso y salida
    public function CtrMostrarAsistenciaPasanteAdmin($h_id = null)
    {

        $ruta = explode("/", $_GET["views"]);
        if (isset($ruta[1])) {
            $persona_id = mainModel::decryption($ruta[1]);
        }
        // @$persona_id = $_SESSION['p_id']; // ID de la persona
        // Obtener los registros del pasante
        if (is_numeric($persona_id) && isset($h_id)) {

            $hor_id = $h_id;
            $sql = mainModel::ejecutar_consulta_simple("SELECT * FROM asistencia WHERE per_id = $persona_id ORDER BY asi_id DESC");
            $hor = mainModel::ejecutar_consulta_simple("SELECT * FROM horario WHERE hor_id = '$hor_id'");
            $hors = $hor->fetch();
            //Variable total de horas
            $horas = array();
            $tabla = "";
            $tabla .= '<table id="example" class="table stripe row-border order-column nowrap" style="width:100%; box-sizing: inherit;">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Ingreso</th>
                    <th>Almuerzo inicio</th>
                    <th>Almuerzo fin</th>
                    <th>Salida</th>
                    <th>Horas</th>
                    <th style="text-align: center;">Acción</th>
                </tr>
            </thead>
            <tbody>';
            // echo $sql->errorInfo()[2];
            if ($sql->errorCode() == "00000") {
                if ($sql->rowCount() >= 1) {

                    $datos = $sql->fetchAll();
                    foreach ($datos as $row) {

                        // vars
                        $fecha = $row['asi_dia'];
                        $h_ingreso = $row['asi_hora_ingreso'];
                        $h_almuerzo_inicio = $row['asi_hora_salida_a'];
                        $h_almuerzo_fin = $row['asi_hora_regreso_a'];
                        // $h_salida = $row['asi_hora_salida'];
                        $h_salida = ($row['asi_hora_salida'] == "00:00:00") ? $row['asi_hora_ingreso'] : $row['asi_hora_salida'];


                        $a_marc = ($h_almuerzo_inicio != '00:00:00' && $h_almuerzo_fin != '00:00:00') ? true : false;
                        $s_marc = ($h_salida != '00:00:00') ? true : false;

                        //Diferencia entre horas entrada y salida
                        $diff = $this->getTimeDiff($h_ingreso, $h_salida);

                        //Diferencia entre horas almuerzo inicio y almuerzo fin
                        $diff_a = $this->getTimeDiff($h_almuerzo_inicio, $h_almuerzo_fin);
                        
                        $diff_b = $this->getTimeDiff($h_ingreso,$h_almuerzo_inicio);

                        $diff_b_al = $this->getSumHours([$diff_a, $h_ingreso]);



                        if ($h_almuerzo_inicio != '00:00:00' || $h_almuerzo_fin != '00:00:00') {
                            
                        
                        //Total de horas trabajadas
                        if($h_almuerzo_inicio != '00:00:00' && $h_almuerzo_fin == '00:00:00' && $h_salida == $h_ingreso){
                            
                            $total_horas = $this->getTimeDiff($h_ingreso,  $h_almuerzo_inicio);

                        }elseif($a_marc && $h_salida == $h_ingreso){

                            $total_horas = $this->getTimeDiff($diff_b_al, $h_almuerzo_inicio);

                        }elseif ($a_marc && $s_marc) {
                            $total_horas = $this->getTimeDiff($diff_a, $diff);
                        }
                    }else{
                            $total_horas = $this->getTimeDiff($diff_a, $diff);
                        }
                        // $total_horas = $this->getTimeDiff(($a_marc && !$s_marc) ? $h_almuerzo_inicio : $diff_a,  $diff);

                        if ($hor_id != 1) {

                            $h_i = new DateTime($h_ingreso);
                            $h_a_i = new DateTime($h_almuerzo_inicio);
                            $h_a_f = new DateTime($h_almuerzo_fin);
                            $h_s = new DateTime($h_salida);

                            $hor_ingreso = new DateTime($hors['hor_entrada']);
                            $hor_salida_a = new DateTime($hors['hor_salida_a']);
                            $hor_regreso_a = new DateTime($hors['hor_regreso_a']);
                            $hor_salida = new DateTime($hors['hor_salida']);
                            // $datetime2 = new DateTime($h_almuerzo_end);

                            // $interval = $h_a_i->diff($h_a_f);
                            // $v_hora =  $interval->format('%R%H:%i') . ' ';
                            //Hora adelantada o retrasada
                            $hor_dif_ingreso = $h_i->diff($hor_ingreso);
                            $hor_dif_ingreso_n = $hor_dif_ingreso->format('%R%H:%I');

                            $hor_dif_salida = $hor_salida->diff($h_s);
                            $hor_dif_salida_n = $hor_dif_salida->format('%R%H:%I');
                        } else {
                            $hor_dif_ingreso_n = "";
                            $hor_dif_salida_n = "";
                        }

                        if ($h_almuerzo_inicio == "00:00:00") {
                            $h_almuerzo_inicio = "--:--:--";
                        }
                        if ($h_almuerzo_fin == "00:00:00") {
                            $h_almuerzo_fin = "--:--:--";
                        }
                        if ($h_salida == $h_ingreso) {
                            $h_salida = "00:00:00";
                        }
                        $horas[] = $total_horas;

                        if ($h_almuerzo_inicio == "--:--:--" && $h_almuerzo_fin == "--:--:--" && $h_salida != "00:00:00") {


                            $tabla .= '
                        <tr>
                        <td style="vertical-align: middle;">' . $fecha . '</td>
                        <td style="vertical-align: middle;">' . $h_ingreso . ' <span class="h_diff is-small tag">' . $hor_dif_ingreso_n . '</span></td>
                        <td style="vertical-align: middle;" colspan="2" class="has-text-centered">Sin almuerzo</td>
                        <td style="display: none;"></td>
                        <td style="vertical-align: middle;">' . $h_salida . ' <span class="h_diff is-small tag">' . $hor_dif_salida_n . '</span></td>
                        <td style="vertical-align: middle;">' . $total_horas . '</td>
                        <td style="vertical-align: middle; text-align: center;">
                            <button style="height: fit-content;" id="' . mainModel::encryption($row['asi_id']) . '" class="button is-success is-outlined editarRegistro modal-button" data-tooltip="Editar" data-target="edit_hora" data-toggle="modal">
                                <span class="icon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                            </button>
                            <button style="height: fit-content;" id="' . mainModel::encryption($row['asi_id']) . '" class="button is-danger is-outlined eliminarRegistro" data-tooltip="Eliminar" >
                                <span class="icon">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </button>
                        </tr>
                        ';
                        } else {
                            $tabla .= '
                        <tr>
                        <td style="vertical-align: middle;">' . $fecha . '</td>
                        <td style="vertical-align: middle;">' . $h_ingreso . '  <span class="h_diff is-small tag">' . $hor_dif_ingreso_n . '</span></td>
                        <td style="vertical-align: middle;">' . $h_almuerzo_inicio . '</td>
                        <td style="vertical-align: middle;">' . $h_almuerzo_fin . '</td>
                        <td style="vertical-align: middle;">' . $h_salida . ' <span class="h_diff is-small tag">' . $hor_dif_salida_n . '</span></td>
                        <td style="vertical-align: middle;">' . $total_horas . '</td>
                        <td style="vertical-align: middle; text-align: center;">
                        
                            <button style="height: fit-content;" id="' . mainModel::encryption($row['asi_id']) . '" class="button is-success is-outlined modal-button editarRegistro" data-tooltip="Editar" data-target="edit_hora" data-toggle="modal">
                                <span class="icon">
                                    <i class="fa fa-pencil"></i>
                                </span>
                            </button>
                            <button style="height: fit-content;" id="' . mainModel::encryption($row['asi_id']) . '" class="button is-danger is-outlined eliminarRegistro" data-tooltip="Eliminar" >
                                <span class="icon">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </button>

                        </tr>
                        ';
                        }
                    }
                } else {
                    $tabla .= '
                <tr>
                    <td colspan="6">No hay registros</td>
                </tr>
                ';
                }
            } else {
                $tabla .= '<tr>
                <td colspan="6">No hay registros</td>
            </tr>';
            }
            $tabla .= '</tbody>
            </table>
            <input class="total_horas" value="' . $this->getSumHours($horas) . '" hidden></input>
            
            ';
        } else {
            $tabla = '<tr>
            <td colspan="6">No hay registros</td>
            </tr>';
        }
        echo $tabla;
    }


    //Obtener nombre del pasante
    public function CtrGetNombrePasante($id)
    {
        $id = mainModel::decryption($id);
        if (is_numeric($id)) {


            $sql = mainModel::conectar()->prepare("SELECT CONCAT(per_pri_nombre, ' ', per_seg_nombre, ' ', per_pri_apellido, ' ', per_seg_apellido) as nombre FROM personal WHERE per_id = ?");
            $sql->execute(array($id));
            $row = $sql->fetch();
            @$nombre = mb_strtolower($row['nombre']);

            return ucwords($nombre);
        } else {
            return "NO NAME";
        }
    }

    // Otener id del pasante
    public function CtrGetIdUsuario($id)
    {
        $id_n = mainModel::decryption($id);
        if (is_numeric($id_n)) {
            $sql = mainModel::conectar()->prepare("SELECT per_id, usu_id FROM usuario WHERE per_id = ?");
            $sql->execute(array($id_n));
            $row = $sql->fetch();
            @$id_na = $row['usu_id'];

            return mainModel::encryption($id_na);
        } else {
            return "NO NAME";
        }
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
        return sprintf('%02d:%02d', $hours, $minutes);
    }
}
