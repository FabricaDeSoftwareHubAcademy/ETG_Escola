<?php
error_reporting(0);
// Verifica se o usuário está logado
if (!isset($_SESSION['id_user'])) {
    header('Location: ../');
}
ob_start();
require __DIR__ . "/../vendor/autoload.php";
include_once ("../includes/menu.php");
require ("../includes/header/header.php");

use App\Entity\Usuario;

$objUsuario = new Usuario();
$logado = false;
$erro = false;

$dados = $objUsuario->getDadosById($_SESSION['id_user']);
$perfil = ($objUsuario->getDadosPerfil($_SESSION['id_user']))[0];

// Verificações de permissão
$ifperfil = $perfil['gerenciar_perfis'] == '1';
$ifuser = $perfil['gerenciar_usuarios'] == '1';
$ifgensala = $perfil['gerenciar_salas'] == '1';
$ifgencheck = $perfil['gerenciar_checklist'] == '1';
$ifgenperg = $perfil['gerenciar_perguntas'] == '1';
$ifgennot = $perfil['gerenciar_notificacoes'] == '1';
$ifgenrec = $perfil['gerenciar_recados'] == '1';
$ifreacheck = $perfil['realizar_checklist'] == '1';
$ifreaac = $perfil['realizar_acao_corretiva'] == '1';
$ifrel = $perfil['relatorios'] == '1';
?>

<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<link rel="stylesheet" href="../assets/css/menu/menu.css">
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>
<script>

    function darkModeProject(color) {
        // #1c1c1c ou #fff

        if(color == '#1c1c1c'){
            document.querySelector('#img-logo').style.filter = 'contrast(0) grayscale(1)'
        }else{
            
            document.querySelector('#img-logo').style.filter = 'unset'
        }


        document.querySelector('.container-menu').style.backgroundColor = color
        document.querySelector('.btnOpenmodal-menu').style.backgroundColor = color

        var rowsUsersSubMenu = document.querySelectorAll('.iten-submenu3')
        rowsUsersSubMenu.forEach((e) => {

            e.style.backgroundColor = color

        })

        rowsUsersSubMenu = document.querySelectorAll('.iten-submenu2')
        rowsUsersSubMenu.forEach((e) => {

            e.style.backgroundColor = color

        })

        rowsUsersSubMenu = document.querySelectorAll('.iten-submenu')
        rowsUsersSubMenu.forEach((e) => {

            e.style.backgroundColor = color

        })
        rowsUsersSubMenu = document.querySelectorAll('.iten-submenu4')
        rowsUsersSubMenu.forEach((e) => {

            e.style.backgroundColor = color

        })

        var inputs = document.querySelectorAll('input');
        var inputs_perm = ['text','email','password','number']
        inputs.forEach((input) => {
            
            if(inputs_perm.includes(input.type)){
                if(color == "#fff"){
                    input.style.color = '#1c1c1c'; 
                }else{    
                    input.style.color = '#fff'; 
                }

            }
        });

        var tilesh1s = document.querySelectorAll('.title_cadastrar_usuario_page')
        tilesh1s.forEach((e) => {
            if(color == "#fff"){    
                e.style.color = '#1c1c1c'; 
            }else{    
                e.style.color = '#fff'; 
            }
        })
        var pencilIcon = document.querySelectorAll('.darkModeEdit')
        pencilIcon.forEach((e) => {
            if(color == "#fff"){    
                e.style.color = '#1c1c1c'; 
            }else{    
                e.style.color = '#fff'; 
            }
        })

        var darkModeEditReverseBackground = document.querySelectorAll('.darkModeEditReverseBackground')
        darkModeEditReverseBackground.forEach((e) => {
            if(color == "#fff"){    
                e.style.backgroundColor = '#fff'; 
            }else{    
                e.style.backgroundColor = '#000'; 
            }
        })

        var lineBottomCadPerg = document.querySelectorAll('.darkModeEditLineBottom')
        lineBottomCadPerg.forEach((e) => {
            if(color == "#fff"){    
                e.style.borderBottom = '2px solid #1c1c1c';
            }else{    
                e.style.borderBottom = '2px solid #fff';
            }
        })
        var btn_img_cadastrar_sala = document.querySelectorAll('.btn_img_cadastrar_sala')
        btn_img_cadastrar_sala.forEach((e) => {
            if(color == "#fff"){    
                e.style.border = '2px solid #1c1c1c';
                e.style.color = '#1c1c1c';
            }else{    
                e.style.border = '2px solid #fff';
                e.style.color = '#fff';
            }
        })

        var card_view_sala_dark = document.querySelectorAll('.card_view_sala_dark')
        card_view_sala_dark.forEach((e) => {
            if(color == "#fff"){    
                e.style.backgroundColor = '#fff';
                e.style.color = '#1c1c1c';
            }else{    
                e.style.backgroundColor = '#1c1c1c';
                e.style.color = '#fff';
            }
        })

    }

    function addDarkmodeWidget() {




        const options = {
            bottom: '64px', // default: '32px'
            right: '32px', // default: '32px'
            left: 'unset', // default: 'unset'
            time: '0.5s', // default: '0.3s'
            mixColor: '#fff', // default: '#fff'
            backgroundColor: '#fff',  // default: '#fff'
            buttonColorDark: '#100f2c',  // default: '#100f2c'
            buttonColorLight: '#fff', // default: '#fff'
            saveInCookies: true, // default: true,
            label: '🌓', // default: ''
            autoMatchOsTheme: false // default: true
        }


        const obDarkmode = new Darkmode(options);
        obDarkmode.showWidget()

        // console.log(obDarkmode.isActivated())

        if (obDarkmode.isActivated()) {
            // FICANDO ESCURO 
            darkModeProject('#1c1c1c') 
        } else {
            // FICANDO CLARO 
            darkModeProject('#fff')

        }

        document.querySelector('.darkmode-toggle').addEventListener('click', (e) => {

            if (obDarkmode.isActivated()) {
                // FICANDO ESCURO 
                darkModeProject('#1c1c1c')


            } else {
                // FICANDO CLARO 
                darkModeProject('#fff')

            }

        })



    }


    window.addEventListener('load', addDarkmodeWidget);




</script>

<body>

    <div class="cabecalho-menu">

        <div class="container-menu">
            <a class="toggleBox-menu">
                <span class="icon-menu"></span>
            </a>

            <ul class="navItems-menu">

                <li class="parte-perfil">
                    <a href="../pages/editar_usuario.php" id="teste" class="link-menu">
                        <img src="../assets/imgs/users/<?= $dados[0]["foto"] ?>" class="icon-perfil" style="--i:2"
                            alt="...">

                        <?php
                        $nome = $dados[0]["nome"];

                        if (strlen($nome) > 5 && $nome === strtoupper($nome)) {
                            echo "<h5 class='titulo-nome' id='nome' style='font-size: 9px;'>" . substr($nome, 0, 10) . "</h5>";
                        } else {
                            echo "<h5 class='titulo-nome' id='nome' style='font-size:13px;'>" . substr($nome, 0, 10) . "</h5>";
                        }
                        ?>

                    </a>
                </li>

                <li class="li-menu">
                    <a href="../pages/listar_recados.php" class="link-menu">
                        <i id="icon-casa" class="bi bi-house-door" style="--i:1"></i>
                        <h5 class="titulo-info" id="titulo-home" style="--i:1">Home</h5>
                    </a>
                </li>


                <li class="link_submenu2">
                    <?php
                    echo '
                            <li class="li-menu">
                                <a href="#" class="link-menu">
                                    <i id="icon-pessoa" class="bi bi-person" style="--i:2"></i>
                                    <h5 class="titulo-info" style="--i:2">Usuários</h5>          
                                </a>
                            
                                <ul class="submenu2" id="submenu-icon-pessoa">
                                 
                                ' .
                        ($ifperfil ? '<li class="iten-submenu2"><a href="../pages/cadastrar_perfil.php" id="fonte-submenu2">Cadastrar Perfil</a></li>' : '') .
                        ($ifuser ? '<li class="iten-submenu2"><a href="../pages/cadastrar_usuario.php" id="fonte-submenu2">Cadastrar Usuário</a></li>' : '') .
                        ($ifperfil ? '<li class="iten-submenu2"><a href="../pages/listar_perfis.php" id="fonte-submenu2">Gerenciar Perfis</a></li>' : '') .
                        ($ifuser ? '<li class="iten-submenu2"><a href="../pages/visualizar_usuario.php" id="fonte-submenu2">Gerenciar Usuários</a></li>' : '')
                        . '

                                <li class="iten-submenu2"><a href="../pages/editar_usuario.php" id="fonte-submenu2">Minha Conta</a></li>
                                <li class="iten-submenu2"><a href="../pages/listar_notificacoes.php" id="fonte-submenu2">Notificações</a></li>
                                </ul>
                        </li>';
                    ?>
                </li>


                <li class="link_submenu3">
                    <?php
                    

                    if ($ifgencheck || $ifreaac) {
                        echo '
                        <li class="li-menu">
                            <a href="#" class="link-menu">
                                <i id="btnsubmenu3" class="bi bi-clipboard2-check" onclick="openSubmenu3()"></i>   
                                <h5 class="titulo-info" id="titulo-home">Check-List</h5>                 
                            </a>
                            <ul class="sub-menu3">
                                ' . 
                            ($ifgencheck ? '<li class="iten-submenu3"><a href="cadastrar_checklist.php" id="fonte-submenu3">Cadastrar Check-List</a></li>' : '') .
                            ($ifreaac ? '<li class="iten-submenu3"><a href="listar_checklist_concluidas.php" id="fonte-submenu3">Validar Check-List</a></li>' : '') .
                            ($ifgencheck ? '<li class="iten-submenu3"><a href="gerenciar_checklist.php" id="fonte-submenu3">Vizualizar Check-List</a></li>' : '')

                            . '</ul>
                        </li>';
                    }
                    ?>
                </li>


                <li class="li-menu">
                    <a href="listar_salas.php" class="link-menu">
                        <i id="icon-vizualizar" class="bi bi-person-video3" style="--i:4"></i>
                        <h5 class="titulo-info" id="titulo-not" style="--i:4">Salas</h5>
                    </a>
                </li>


                <li class="link_submenu">
                    <?php
                    if ($ifgensala || $ifgencheck || $ifgenperg || $ifgennot || $ifuser || $ifperfil) {
                        echo '
                            <li class="li-menu">   
                            <a href="#" class="link-menu">
                            <i class="bi bi-list-check" id="btnsubmenu" onclick="openSubmenu()" style="--i:5"></i>
                            <h5 class="titulo-info" id="titulo-cad" style="--i:5">Cadastros</h5>
                            </a>
                            
                                <ul class="sub-menu">
                                ' .
                            ($ifgencheck ? '<li class="iten-submenu"><a href="../pages/cadastrar_checklist.php" id="fonte-submenu">Cadastrar Checklist</a></li>' : '') .
                            ($ifgennot ? '<li class="iten-submenu"><a href="../pages/cadastrar_notificacao.php" id="fonte-submenu">Cadastrar  Notificações</a></li>' : '') .
                            ($ifgenperg ? '<li class="iten-submenu"><a href="../pages/cadastrar_pergunta.php" id="fonte-submenu">Cadastrar  Perguntas</a></li>' : '') .
                            ($ifperfil ? '<li class="iten-submenu"><a href="../pages/cadastrar_perfil.php" id="fonte-submenu2">Cadastrar  Perfil</a></li>' : '') .
                            ($ifgensala ? '<li class="iten-submenu"><a href="../pages/cadastrar_sala.php" id="fonte-submenu">Cadastrar  Salas</a></li>' : '') .
                            ($ifuser ? '<li class="iten-submenu"><a href="../pages/cadastrar_usuario.php" id="fonte-submenu2">Cadastrar  Usuário</a></li>' : '')
                            . '
                                </ul>
                                </li> ';
                    }
                    ?>
                </li>


                <li class="link_submenu4">
                    <?php
                    if ($ifrel) {
                        echo '
                            <li class="li-menu">   
                            <a href="#" class="link-menu">
                            <i class="bi bi-graph-up" id="btnsubmenu4" onclick="openSubmenu4()" style="--i:6"></i>
                            <h5 class="titulo-info" id="titulo-cad" style="--i:6">Relatório</h5>
                            </a>
                            
                            <ul class="sub-menu4">
                            <li class="iten-submenu4"><a href="../pages/listar_relatorio.php" id="fonte-submenu">Informações administrativas</a></li>
                            
                            <li class="iten-submenu4"><a href="../pages/relatorio_user.php" id="fonte-submenu">Relatorio usuarios</a></li>
                            
                            </ul>
                            </li> ';
                    }
                    ?>
                </li>


                <li class="li-menu">
                    <a href="../pages/sobre.php" class="link-menu">
                        <i id="icon-notificacao" class="bi bi-info-circle" style="--i:3"></i>
                        <h5 class="titulo-info" id="titulo-noti" style="--i:3">Sobre nós</h5>
                    </a>
                </li>


                <li class="saida">
                    <button class="btnOpenmodal-menu" >
                        <a href="actions/sair.php" class="link-menu">
                            <i class="bi bi-box-arrow-left" style="--i:7"></i>
                            <h5 class="titulo-info" id="titulo-sair" style="--i:7">Sair</h5>
                        </a>
                    </button>
                </li>

                <div class="modal-container-menu">
                    <div class="modal-menu">

                        <h3 class="text-popmenu">
                            Tem Certeza que Deseja Sair?
                        </h3>
                        <div class="btns-menu">
                            <button class="btnOk-menu" onclick="closeModal(0)"> NÃO</button>
                            <button class="btnClose-menu" onclick="closeModal(1)"> SIM</button>
                        </div>
                    </div>
                </div>
            </ul>

        </div>


        <div class="container-logo">
            <div class="logo">
                <ul class="cabecalho_logo"><img src="../assets/imgs/logos/senacFec_colored.png" alt="Carregando"
                        id="img-logo"></ul>
            </div>

            <div class="fitas" id='fitas_menu'>
                <ul class="sub-fita">
                    <div id="bloc1"></div>
                </ul>
                <ul class="sub-fita">
                    <div id="bloc2"></div>
                </ul>
            </div>
        </div>


    </div>

</body>



<script>

    // Declaração de variáveis e eventos
    var toggleClick = document.querySelector(".toggleBox-menu");
    var container = document.querySelector(".container-menu");
    var modal = document.querySelector('.modal-container-menu');
    var submenu = document.querySelector('.sub-menu');
    var btn_submenu = document.getElementById('btnsubmenu');
    var submenu3 = document.querySelector('.sub-menu3');
    var btn_submenu3 = document.getElementById('btnsubmenu3');
    var submenu4 = document.querySelector('.sub-menu4');
    var btn_submenu4 = document.getElementById('btnsubmenu4');

    toggleClick.addEventListener("click", toggleMenu);
    document.addEventListener("click", clickOutside);

    function toggleMenu() {
        toggleClick.classList.toggle("active");
        container.classList.toggle("active");
        submenu.classList.remove('active');
        btn_submenu.setAttribute('onclick', 'openSubmenu()');
        closeModal();
    }

    function openModal() {
        modal.classList.add('active');
    }

    function closeModal(valor) {
        if (valor == 1) {
            window.location.href = "./actions/sair.php";
        }
        modal.classList.remove('active');
    }

    function openSubmenu() {
        submenu.classList.add('active');
        btn_submenu.setAttribute('onclick', 'closeSubmenu()');
    }


    function closeSubmenu() {
        submenu.classList.remove('active');
        btn_submenu.setAttribute('onclick', 'openSubmenu()');
    }

    function openSubmenu3() {
        submenu3.classList.add('active');
        btn_submenu3.setAttribute('onclick', 'closeSubmenu3()');
    }

    function closeSubmenu3() {
        submenu3.classList.remove('active');
        btn_submenu3.setAttribute('onclick', 'openSubmenu3()');
    }

    function openSubmenu4() {
        submenu4.classList.add('active');
        btn_submenu4.setAttribute('onclick', 'closeSubmenu4()');
    }

    function closeSubmenu4() {
        submenu4.classList.remove('active');
        btn_submenu4.setAttribute('onclick', 'openSubmenu4()');
    }

    function clickOutside(event) {
        // Fechar o submenu quando clicar fora dele
        if (!submenu.contains(event.target) && !btn_submenu.contains(event.target)) {
            closeSubmenu();
        }

        if (!submenu3.contains(event.target) && !btn_submenu3.contains(event.target)) {
            closeSubmenu3();
        }

        if (!submenu4.contains(event.target) && !btn_submenu4.contains(event.target)) {
            closeSubmenu4();
        }
        // Fechar a modal quando clicar fora dela
        if (!modal.contains(event.target) && event.target !== document.querySelector('button[onclick="openModal()"]')) {
            closeModal(0);
        }

        // Fechar o menu quando clicar fora dele
        if (!container.contains(event.target) && !toggleClick.contains(event.target)) {
            toggleClick.classList.remove("active");
            container.classList.remove("active");
            submenu.classList.remove('active');
            btn_submenu.setAttribute('onclick', 'openSubmenu()');
            closeModal();
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        const submenuIconPessoa = document.getElementById("submenu-icon-pessoa");
        const tituloUser = document.querySelector(".titulo-user"); // Seleciona o elemento com a classe titulo-user


        function toggleSubmenu(submenu) {
            submenu.classList.toggle("active");
        }

        document.getElementById("icon-pessoa").addEventListener("click", function (event) {
            event.preventDefault();
            toggleSubmenu(submenuIconPessoa);
        });


        document.addEventListener("click", function (event) {
            if (!submenuIconPessoa.contains(event.target) && !document.getElementById("icon-pessoa").contains(event.target)) {
                submenuIconPessoa.classList.remove("active");
            }

        });

        document.addEventListener("DOMContentLoaded", function () {
            const submenuIconPessoa = document.getElementById("submenu-icon-pessoa")
        });
    });







</script>

 