

const api_search_autocomplete = new Vue({
    el: '#api_search_autocomplete',
    data: {
        palabra_a_buscar: '',
        resultados: []
       
    },   
    methods: {
        autoComplete() { 

            this.resultados=[];

            if (this.palabra_a_buscar.length >2) {
                axios.get('/api/autocomplete',
                  {params:{ palabraabuscar:this.palabra_a_buscar }}
                 ).then(response => {
                    this.resultados = response.data;
                    console.log(response.data);
               });
            }



        },

/*        select(resultado) { 
            this.palabra_a_buscar=resultado.nombre;
            this.$nextTick( ()=> {
                this.SubmitForm();
            });           
        },
*/
        async select(resultado) { 
            this.palabra_a_buscar=resultado.nombre;
            await this.$nextTick();            
            this.SubmitForm();
            //$nextTick sirve para esperar que luego que se actualice el Dom se ejecute una funcion.                       
        },


        SubmitForm() { 
            console.log('Estoy ejecutando el submitform');
            this.$refs.SubmitButtonSearch.click();
            

        },


        
    },
    mounted(){
        console.log('Datos cargados correctamente');        
        
    }

});