

const api_search_autocomplete = new Vue({
    el: '#api_search_autocomplete',
    data: {
        palabraabuscar: '',
        resultados: []

    },    
    methods: {
        autoComplete() { 
           
           this.resultados = [];
           if (this.palabraabuscar.length> 2) {
             
             axios.get('/api/autocomplete',
             {params:{palabraabuscar: this.palabraabuscar}})
                .then(response => {
                this.resultados = response.data;    
                console.log(response.data);
             });

           } 

        },
       
    },
    mounted(){
          console.log('datos cargados');
    }

});