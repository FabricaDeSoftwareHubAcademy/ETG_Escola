import { Pergunta } from './Pergunta.js';

export class Dom {     
    constructor(dataNaoConf) {
        this.dataNaoConf = dataNaoConf;
        this.objPergunta = new Pergunta(perguntasJson);
        this.dataPerguta = this.objPergunta.getAll();
    }

    showPerguntas() {
        for (var pergunta of this.dataPerguta) {
            // var perguntaMae = document.querySelector(".pergunta_nao_conf");
            // var descricaoPergunta = document.createElement("h6");
            // descricaoPergunta.innerText = pergunta["pergunta"];
            // console.log(pergunta);
            // perguntaMae.appendChild(descricaoPergunta);
            console.log(this.dataPerguta)
            if (pergunta["NaoConformidade"]) {
                this.createOneRedElement(pergunta["pergunta"], pergunta["id_pergunta"]); //checando se a pergunta tem uma nao conformidade
                continue;
            }
            this.createOneGreenElement(pergunta["pergunta"], pergunta["id_pergunta"]);
        }
    }

    createOneGreenElement(pergunta, idPergunta) {
        this.createLabelElement("label_checklist-right", pergunta, idPergunta);
    }

    createOneRedElement(pergunta, idPergunta) {
        this.createLabelElement("label_checklist-wrong", pergunta, idPergunta);
    }

    createLabelElement(labelClass, pergunta, idPergunta) {
        var mainDiv = document.createElement("div");
        mainDiv.className = "input_checklist";
        
        var labelDiv = document.createElement("div");
        labelDiv.id = "label-div";
        labelDiv.className = labelClass;
        
        
        var h1AndButtonDiv = document.createElement("div");
        h1AndButtonDiv.className = "divH1andButton";
        h1AndButtonDiv.setAttribute("id-pergunta", idPergunta)

        
        var h1Title = document.createElement("h1");
        h1Title.textContent = pergunta;
        
        var button = document.createElement("i");
        button.className = "bi bi-chevron-down";
        button.id = "right-button-label";
        
        // this.slideEffect(labelDiv, button);
        //SLIDE EFFECT
        var self_1 = this;
        function montarBotoes()
        {
            var self_2 = self_1
            motherButtons = document.createElement("div");
            motherButtons.className = "alinar-botoes-label";

            var divBack = document.createElement("div");
            divBack.className = "botao-padrao-voltar-label";

            var buttonIncorrect = document.createElement("button");
            buttonIncorrect.className = "botao-voltar-link-label";
            buttonIncorrect.textContent = "Incorreto";
            buttonIncorrect.onclick = function() {
                self_2.call(pergunta)
                var buttonConfirmNaoConf = document.querySelector(".botao-confirmar-submit");
                buttonConfirmNaoConf.onclick = function() {
                    vermelho();
                    var textAreaContent = document.querySelector(".descricao_nao_conf").value
                    var varPreview = document.querySelector(".upload-img");
                    var images = varPreview.querySelectorAll("img");
                    self_2.save(textAreaContent, images, idPergunta);
                    self_2.close();
                }
            }

            var divSubmit = document.createElement("div");
            divSubmit.className = "botao-padrao-cadastrar-label";

            var buttonSubmit = document.createElement("button");
            buttonSubmit.className = "botao-cadastrar-submit-label";
            buttonSubmit.textContent = "Correto";
            buttonSubmit.type = "button";
            buttonSubmit.onclick = function() {
                verde();
            }
            divBack.appendChild(buttonIncorrect);
            divSubmit.appendChild(buttonSubmit);
            motherButtons.appendChild(divBack);
            motherButtons.appendChild(divSubmit);
            labelDiv.appendChild(motherButtons);
        }

        function descerNormal()
        {
            montarBotoes();
            labelDiv.classList.add("active");

            if (labelDiv.classList.contains("label_checklist-wrong")) {
                labelDiv.style.backgroundColor = 'transparent';
                labelDiv.style.border = '3px solid red';
                button.className = "bi bi-chevron-down"
                labelDiv.style.height = (labelDiv.offsetHeight + 125) + "px";
            }
            else if (labelDiv.classList.contains("label_checklist-right")) {
                labelDiv.style.backgroundColor = 'transparent';
                labelDiv.style.border = '3px solid green';
                button.className = "bi bi-chevron-down"
                labelDiv.style.height = (labelDiv.offsetHeight + 125) + "px";
            }

            if (labelDiv.classList.contains("correct")) {
                labelDiv.classList.remove("correct");
            }
            if (labelDiv.classList.contains("incorrect")) {
                labelDiv.classList.remove("incorrect");
            }
            for (var i = 0; i < self_1.dataNaoConf.length; i++) {
                var Nconf = self_1.dataNaoConf[i];
                if (Nconf["idPergunta"] == idPergunta) {
                    self_1.dataNaoConf.splice(i, 1);
                    // console.log("AAAAAAAAAAAAAAAAAAAAAAAAAA")
                }
            }
            console.log(self_1.dataNaoConf);

        }

        function subirNormal()
        {
            labelDiv.style.height = (labelDiv.offsetHeight - 125) + "px";
            labelDiv.classList.remove("active");
            labelDiv.removeChild(motherButtons);

            if (labelDiv.classList.contains("correct")) {
                labelDiv.classList.remove("correct");
            }
            if (labelDiv.classList.contains("incorrect")) {
                labelDiv.classList.remove("incorrect");
            }
        }

        function verde()
        {
            //verde
            labelDiv.style.backgroundColor = 'green';
            labelDiv.classList.add("correct");
            button.className = "bi bi-arrow-clockwise";
        }

        function vermelho()
        {
            //vermelho
            labelDiv.style.backgroundColor = 'red';
            labelDiv.classList.add("incorrect");
            button.className = "bi bi-arrow-clockwise";
        }

        var motherButtons;
        labelDiv.onclick = function() {
            if (labelDiv.classList.contains("active") && labelDiv.classList.contains("correct")) 
            {
                subirNormal();
            }
            else if (labelDiv.classList.contains("active") && !labelDiv.classList.contains("correct") && !labelDiv.classList.contains("incorrect"))
            {
                subirNormal();
                console.log("subiu normal transparente");
            }
            else
            {
                descerNormal();
                console.log("desceu normal transparente");
            }
        }

        var divPreAula = document.querySelector(".list-pre-aula");

        h1AndButtonDiv.appendChild(h1Title);
        h1AndButtonDiv.appendChild(button);
        labelDiv.appendChild(h1AndButtonDiv);
        mainDiv.appendChild(labelDiv);
        divPreAula.appendChild(mainDiv);
    }

    buildButtons() {
        self = this;
        var divBotoes = document.querySelector(".botoes");

        var cancelButton = document.createElement("button");
        cancelButton.className = "botao-cancelar-submit";
        cancelButton.textContent = "Cancelar";
        
        cancelButton.onclick = function() {
            self.close();
        }

        var confirmButton = document.createElement("button");
        confirmButton.className = "botao-confirmar-submit";
        confirmButton.textContent = "Confirmar";
        // confirmButton.onclick = function() {
        //     labelDiv = document.querySelector("#label-div");
        //     labelDiv.classList.add("incorrect");
            //vermelho
            // labelDiv.style.backgroundColor = 'red';
            // labelDiv.classList.add("incorrect");
            // buttonBIBI.className = "bi bi-arrow-clockwise";

        //     var textAreaContent = document.querySelector(".descricao_nao_conf").value
        //     var varPreview = document.querySelector(".upload-img");
        //     var images = varPreview.querySelectorAll("img");
        //     self.save(textAreaContent, images);
        //     self.close();
        // }

        divBotoes.appendChild(cancelButton);
        divBotoes.appendChild(confirmButton);

    }

    call(pergunta) {
        var perguntaMae = document.querySelector(".pergunta_nao_conf");
        var descricaoPergunta = document.createElement("h6");
        descricaoPergunta.innerText = pergunta;
        perguntaMae.appendChild(descricaoPergunta);
        this.onclickToUploadArea();
        this.buildButtons();
        var modal = document.querySelector(".mom");
        modal.style.display = "block";
    }

    close() {
        var varPreview = document.querySelector(".upload-img");
        varPreview.innerHTML = "";
        var textAreaContent = document.querySelector(".descricao_nao_conf");
        textAreaContent.value = "";
        var divBotoes = document.querySelector(".botoes");
        divBotoes.innerHTML = "";
        var modal = document.querySelector(".mom");
        modal.style.display = "none";
        var childs = document.querySelector(".pergunta_nao_conf").childNodes; 
        for (var i = childs.length - 1; i >= 0; i--) {
            document.querySelector(".pergunta_nao_conf").removeChild(childs[i]);
        }
        }

    save(textAreaContent, images, idPergunta) {
        var data = [];
        var imagesToPHP = [];
    
        // ARMAZENANDO AS IMAGENS
        for (let i = 0; i < images.length; i++) {
            var src = images[i].getAttribute("src");
            imagesToPHP[i] = src;
        }
    
        data["idPergunta"] = idPergunta;
        data["textAreaContent"] = textAreaContent;
        data["imagesToPHP"] = imagesToPHP;

        this.dataNaoConf.push(data);
        console.log(this.dataNaoConf)

    }

    onclickToUploadArea() {
        var uploadImage = document.querySelector(".upload-img")

        var inputFile = document.createElement("input");

        inputFile.setAttribute("type", "file");

        inputFile.setAttribute("id", "input-file");

        inputFile.setAttribute("accept", "image/*");

        inputFile.setAttribute("multiple", "");

        inputFile.style.display = "none";

        uploadImage.appendChild(inputFile);

        var uploadArea = document.querySelector(".upload-area")
        var inputUploadImage = document.querySelector("#input-file")
        uploadArea.onclick = function() {
            inputUploadImage.click();
        }
        inputUploadImage.addEventListener("change", this.loadImagesToPreview);
    }

    loadImagesToPreview(event) {
        const MULTIPLE_FILES = event.target.files;

        const MAX_IMAGES = 3;
        const IMAGES_TO_PROCESS = Math.min(MAX_IMAGES, MULTIPLE_FILES.length);
    
        for (let i = 0; i < IMAGES_TO_PROCESS; i++) {
            const FILE = MULTIPLE_FILES[i];
    
            if (!FILE.type.startsWith("image/")) {
                continue;
            }
    
            const IMG = document.createElement("img");
            IMG.className = "beluga";
            
            
            IMG.src = URL.createObjectURL(FILE);
            
            var container_img = document.createElement("div");
    
            const BUTTON_DELETE_IMAGE = document.createElement("button");
    
            BUTTON_DELETE_IMAGE.textContent = "EXCLUIR";
            BUTTON_DELETE_IMAGE.addEventListener("click", function() {
                var varPreview = document.querySelector(".upload-img");
                while(varPreview.firstChild) {
                    varPreview.removeChild(varPreview.firstChild);
                }
            });
    
            container_img.appendChild(IMG);
            container_img.appendChild(BUTTON_DELETE_IMAGE);
    
            var varPreview = document.querySelector(".upload-img");
            varPreview.appendChild(container_img);
        }
    }


}   


