<?php
session_start();
include_once("../includes/menu.php");
use App\Entity\Checklist;
$checklist = array_chunk(Checklist::getDoneCheck(), 5);
// var_dump($checklist);


$arr = [];
foreach($checklist as $gp){
    $list = '';
    // var_dump($gp);
    // echo "<br><br>";
    foreach($gp as $row){
        // var_dump($row);
        // echo "<br><br>";
        $list .= '<a href="validar_checklist.php?id_realizacao='.$row['id_responder'].'" class="card">
                    <div class="card_img">
                        <img src="../assets/img/sala.jpg" alt="foto da sala">
                    </div>
                    <div class="card_info">
                        <div class="card_text">
                            <div class="card_header_title">
                                <h3>'.$row['nome_sala'].'</h3>
                            </div>
                            
                            <div class="card_header_subtitle">
                                <p>aberto às '.$row['data_abertura'].'</p>
                                <p>fechado às '.$row['data_fechamento'].'</p>
                            </div>
    
                        </div>
    
                    </div>
                </a>';
    }
    array_push($arr,$list);
}


include_once("../includes/header/header.php");
include_once("../includes/main/main_listar_checklist_concluidas.php");