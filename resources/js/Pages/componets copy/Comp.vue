<template>
    <content>
        <h1>Teste de componente</h1>
        <p>{{ nome}}</p>
    </content>
</template>

<script>

    export default {
        name: 'Comp',
        data() {
            return {
                nome: 'teste de nome'
            }
        }
    }
    
</script>