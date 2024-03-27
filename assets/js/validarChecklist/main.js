import { Dom } from './Dom.js';

 var preenchidas = [];
// console.log(preenchidas);
for (let i = 0; i < perguntasJson.length; i++) {
    if (perguntasJson[i]["NaoConformidade"] == true) {
        let id_pergunta =  0
        preenchidas[i] = {"id_pergunta": id_pergunta,
        "preenchido": true}
    } else {
        let id_pergunta =  perguntasJson[i]["id_pergunta"]
        preenchidas[i] = {"id_pergunta": id_pergunta,
        "preenchido": false}
    }

}
var NaoConformidades = [];
const DOM = new Dom(NaoConformidades, preenchidas);

DOM.showPerguntas();


var buttonSubmit = document.querySelector("#botao-cadastrar-submit");
buttonSubmit.addEventListener("click", async function(event) {
    event.preventDefault();
    //pegando o id_realizacao do get
    // console.log(preenchidas);
    let aprovado = true;
    for (let i = 0; i < preenchidas.length; i++) {
        if (preenchidas[i]["preenchido"] == false) {
            aprovado = false;
            break;
        }
    }

    // console.log(aprovado);
    if (aprovado) {
        var url = new URLSearchParams(window.location.search)
        var id_realizacao = url.get("id_realizacao")
    
        if (NaoConformidades.length == 0) {
            // console.log("tudo certo por aqui");
            modalStatus("Sucesso", "success", () => {window.location.href = "actions/action_cadastrar_acao_corretiva.php?id_realizacao="+id_realizacao + "&tudo_correto=" + true + "&id_sala=" + id_sala});
            
        } else {
            sessionStorage.clear()
            
            
            let luizNaoCadastra = await fetch('./actions/action_cadastrar_nao_conformidade_logistica.php?id_docente='+id_docente_resp+'&id_sala='+id_sala,{
                method:"POST",
                body: JSON.stringify(NaoConformidades)
            });
            let res = await luizNaoCadastra.json()
            
            
            console.log(res) 

            sessionStorage.setItem('NaoConformidades', JSON.stringify(NaoConformidades));
            sessionStorage.setItem('id_realizacao', id_realizacao);
            sessionStorage.setItem('id_sala', id_sala);
            modalStatus("Sucesso", "success", () => {window.location.href = "acao_corretiva.php";});
        }
    } else {
        modalStatus("Preencha todos os campos", "error")
    }

})