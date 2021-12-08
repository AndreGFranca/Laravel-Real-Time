<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="loading" v-if="loading">
                    Loading...
                </div>
                <div v-if="error" class="error">
                    {{ error }}
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Nome Produto</td>
                            <td>Valor</td>                       
                        </tr>
                    </thead>
                    <tbody v-if="produtos">
                        <tr v-for="{id, CD_PRODUTO, NM_PRODUTO, VL_PRODUTO} in produtos">
                            <td>{{CD_PRODUTO || id}}</td>
                            <td>{{NM_PRODUTO}}</td>
                            <td>{{VL_PRODUTO}}</td>
                        </tr>
                    </tbody>
                </table>
                 
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';    
    export default {
        props: ['url'],
        data() {
            return {                
                loading: false,
                produtos: null,
                error: null,
            };
        },
        // created () {
   

        // },
        mounted() {                        
            this.getProdutos();
            window.Echo.channel('novoProduto')
                .listen('NewProduct',(e)=>{
                    console.log(e.data.produto);
                     this.produtos.push(e.data.produto);
                });               
        },
         methods: {
            getProdutos() {
                this.error = this.produtos = null;            
                axios
                    .get(this.url)
                    .then(response => {
                        console.log(response.data);
                        if(this.produtos != response.data){
                            this.loading = false;
                            this.produtos = response.data ;
                        }
                    }).catch(error => {
                        this.loading = false;
                        this.error = error.response.data.message || error.message;
                    });
            },
            setNewProduct(){
  
            }
        }    
        
    }
</script>

