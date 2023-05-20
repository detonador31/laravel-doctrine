<template>
    <div>
        <h1 class="flex justify-center mx-auto"><b>{{title}}</b></h1>
    </div>
</template>

<script>

    export default {
        name: 'Title',
        props: {
            title: String
        }
    }
    
</script>