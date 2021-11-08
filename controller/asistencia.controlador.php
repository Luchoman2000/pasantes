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
        // PER_ID, DIA, *HORA INGRESO*
        $persona_id = $_SESSION['p_id']; // ID de la persona
        $today = date("Y-m-d"); // Fecha actual
        $h_ingreso = date("H:i:s"); // Hora actual


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
        // PER_ID, DIA, *HORA ALMUERZO*
        $persona_id = $_SESSION['p_id']; // ID de la persona
        $today = date("Y-m-d"); // Fecha actual
        $h_almuerzo = date("H:i:s"); // Hora actual

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
        // PER_ID, DIA, *HORA ALMUERZO*
        $persona_id = $_SESSION['p_id']; // ID de la persona
        $today = date("Y-m-d"); // Fecha actual
        $h_almuerzo = date("H:i:s"); // Hora actual

        $datos = [
            "per_id" => $persona_id,
            "dia" => $today,
            "h_almuerzo_fin" => $h_almuerzo
        ];

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
        echo $res;
    }

    // Insertar salida de pasante
    public function CtrMarcarSalida()
    {
        // PER_ID, DIA, *HORA SALIDA*
        $persona_id = $_SESSION['p_id']; // ID de la persona
        $today = date("Y-m-d"); // Fecha actual
        $h_salida = date("H:i:s"); // Hora actual

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


        $persona_id = $_SESSION['p_id']; // ID de la persona
        // Obtener los registros del pasante
        $sql = mainModel::ejecutar_consulta_simple("SELECT * FROM asistencia WHERE per_id = $persona_id ORDER BY asi_id DESC");

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
                $h_salida = $row['asi_hora_salida'];



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
                if ($h_salida == "00:00:00") {
                    $h_salida = "--:--:--";
                }
                $horas[] = $total_horas;

                if ($h_almuerzo_inicio == "--:--:--" && $h_almuerzo_fin == "--:--:--" && $h_salida != "--:--:--") {


                    $tabla .= '
                    <tr>
                    <td>' . $fecha . '</td>
                    <td>' . $h_ingreso . '</td>
                    <td colspan="2" class="has-text-centered">Sin almuerzo</td>
                    <td style="display: none;"></td>
                    <td>' . $h_salida . '</td>
                    <td>' . $total_horas . '</td>
                    </tr>
                    ';
                } else {
                    $tabla .= '
                    <tr>
                    <td>' . $fecha . '</td>
                    <td>' . $h_ingreso . '</td>
                    <td>' . $h_almuerzo_inicio . '</td>
                    <td>' . $h_almuerzo_fin . '</td>
                    <td>' . $h_salida . '</td>
                    <td>' . $total_horas . '</td>
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
            if ($datos['asi_hora_salida'] == "00:00:00" || ( $datos['asi_hora_regreso_a'] != "00:00:00" || $datos['asi_hora_salida_a'] != "00:00:00") ) {
            

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
