export class Pergunta {
    // hasNaoConf, idSala, idPergunta, checklistName, salaName, pergunta, tipo
    constructor(dataPergunta) {
        this.dataPergunta = dataPergunta; //array 
    }

    getAll() {
        console.log(this.dataPergunta)
        return this.dataPergunta;
    }

}