
// let awser = "";
// const red = document.getElementById('red')
var ids = document.getElementById('')
var id_atual = 0; 
var dados = Array();
var somadados = Array();
function atualizarValor(id, bool)


{
id_atual = id;
    if(bool)
    {
        let  green = document.getElementById('green'+id)
        let  red = document.getElementById('red'+id)
        green.classList = 'bi bi-check-circle'
        red.classList = 'bi bi-x'
        
        respondidas[id] = true
    }
    else
    {

        let  green = document.getElementById('green'+id)
        let  red = document.getElementById('red'+id)
        green.classList = 'bi bi-check'
        red.classList = 'bi bi-x-circle'
        respondidas[id] = false
        acao(id)


    }


}
async function getDados()
{ 
    let descricao_nao_conf = document.getElementById('descricao_nao_conf');
    if (descricao_nao_conf.value != '' && (typeof listasrc[0] != 'undefined') && (typeof listasrc[1] != 'undefined') && (typeof listasrc[2] != 'undefined'))
    {
        dados = {
            'id_pergu': id_atual,
            'descricao_NC': descricao_nao_conf.value,
            'img1': (typeof listasrc[0] === 'undefined') ? null : listasrc[0],
            'img2': (typeof listasrc[1] === 'undefined') ? null : listasrc[1],
            'img3': (typeof listasrc[2] === 'undefined') ? null : listasrc[2]
        };
    
        
    
        somadados.push(dados); 
        descricao_nao_conf.value = "";
        
        removerimgs()
        let modal = document.querySelector('.mom')
        modal.classList.remove('active');
        for (var chave in disponiveis)
        {
            disponiveis[chave] = false
        }
        
        listasrc = [] 
        dados = {}
        
        $('#btn_x'+id_atual).removeAttr('onclick');
    }
    else
    {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            }
          });
          Toast.fire({
            icon: "error",
            title: "Insira a descricao e ao menos 3 fotos"
          });
    }




}
const btn_submit = document.getElementById('btn_submit');
btn_submit.addEventListener('click', async (e ) => {
   e.preventDefault();
   var continuar_rodando = true;
   for (var chave in respondidas)
    {
        if (respondidas[chave] == null)
        {
            continuar_rodando = false 
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "Preencha todas as perguntas"
            });
            break;
            
        }
    }
    if (continuar_rodando)
    {  
        // console.log('teste');
        //pegando os dados para pasar pelo metodo GET
        // Obtém a string da URL atual
        var queryString = window.location.search;
    
        // Cria um objeto URLSearchParams com a string da URL
        var params = new URLSearchParams(queryString);
    
        // Obtém o valor de um parâmetro específico
        var parametro = params.get('id_sala');
    
       JSON.stringify(somadados);
       let data_php = await fetch('./actions/cat_data_pergunta.php?id_sala='+parametro, {
           method: 'POST',
           body: JSON.stringify(somadados) 
       });
    
    //    let response = await data_php.json();


       let response = await data_php.json();

        console.log(response);

    if(response == true){
        openModal();
    }

  
       
    }


    });
    const showModalBtn = document.getElementById('btn_submit');
    const closeModalBtn = document.querySelector('.close-btn');
    const openModalBtn = document.querySelector('.open-btn');
    const overlay = document.querySelector('.overlay-modal');
    const modal3 = document.querySelector('.modal-box');
    function openModal() {
        overlay.style.opacity = '1';
        overlay.style.pointerEvents = 'auto';
        modal3.style.opacity = '1';
        modal3.style.pointerEvents = 'auto';
    }
    function closeModal() {
        overlay.style.opacity = '0';
        overlay.style.pointerEvents = 'none';
        modal3.style.opacity = '0';
        modal3.style.pointerEvents = 'none';
    }
    // showModalBtn.addEventListener('click', openModal);
    closeModalBtn.addEventListener('click', closeModal);
    // openModalBtn.addEventListener('click', openModal);