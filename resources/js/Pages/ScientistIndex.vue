<template>
<content>
    <MenuPrincipal />
    
    <Link href="/sci-new">
        <button type="button" class="m-3 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
            Novo
        </button>
    </Link>

    <Title :title="title + 'de Cientistas'" />

        <!-- <h1 class="flekx justify-center mx-auto"><b>Lista de nomes ({{ paginacao.last_page }} paginas)</b></h1> -->

    <div class="container flex justify-center mx-auto">

        <div class="flex flex-col">
            <div class="w-full">
                <div class="border-b border-gray-200 shadow my-5">
                    <table class="divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    ID
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Nome
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Sobrenome
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Teorias
                                </th>                                
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Edit
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300">
                            <tr v-for="(sci,index) in scientists" :key="index" class="whitespace-nowrap">                      
                                <td class="px-6 py-2 text-sm text-gray-500">
                                    {{ sci.id }}
                                </td>
                                <td class="px-6 py-2 text-sm text-gray-500">
                                    {{ sci.firstname }}
                                </td>
                                <td :key="index" class="px-6 py-2 text-sm text-gray-500">
                                    {{ sci.lastname }}
                                </td> 
                                <td class="px-6 py-2 text-sm text-gray-500">
                                    <Link :href="`/sci-new/${sci.id}`">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </Link>
                                    <ul>
                                        <li v-for="(theory,index) in sci.theories" :key="index">
                                            {{ theory.title }}
                                        </li>
                                    </ul>
                                </td>                                                                                         
                                <td class="px-6 py-2">
                                    <Link :href="`/sci-new/${sci.id}`">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </Link>
                                </td>
                                <td class="px-6 py-2">
                                    <Link :href="`/sci-delete/${sci.id}`">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container flex justify-center mx-auto mt-5 my-10">
        <nav aria-label="Page navigation example w-full">
            <ul class="inline-flex -space-x-px">

                <li v-if="paginacao.first_page_url">
                    <Link :href="`/sciIndex/1`" class="py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Primeira</Link>
                </li>                

                <div v-for="(link, index) in paginacao.links" :key="index">
                    <li>
                        <Link :href="`/sciIndex/${link.num}`" class="py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ link.label }}</Link>
                    </li>
                </div>

                <li v-if="paginacao.last_page_url">
                    <Link :href="`/sciIndex/${paginacao.last_page}`" class="py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Ultima</Link>
                </li>
            </ul>
        </nav>        
    </div>

<Comp/>

</content>
</template>

<script>
    import InertiaTable       from 'inertia-table';
    import Comp               from './componets/Comp.vue';
    import MenuPrincipal      from './componets/MenuPrincipal.vue';
    import Title              from './componets/Title.vue';


    export default{
        components: {
            InertiaTable,
            Comp,
            MenuPrincipal,
            Title
        },        
        props: {
            title: String,
            scientists: [], 
            paginacao:  []
        },

        methods:{
            setPaginationArray: function() {
                if(this.paginacao) {
                    let activePage = 0;
                    for(let i=0; i < this.paginacao.links.length; i++) {
                        this.paginacao.links[i].num = this.paginacao.links[i].label ;
                        if(this.paginacao.links[i].active) {
                            activePage = this.paginacao.links[i].num;
                        }
                    }

                    if(this.paginacao.prev_page_url) {
                        this.paginacao.links[0].label = 'Previous';
                        this.paginacao.links[0].num   = Number(activePage) - 1;                      
                    } else {
                        this.paginacao.links.splice(0, 1);
                    }      

                    if(this.paginacao.next_page_url) {
                        this.paginacao.links[this.paginacao.links.length-1].label = 'Next';
                        this.paginacao.links[this.paginacao.links.length-1].num  = Number(activePage) + 1;
                    } else {
                        this.paginacao.links.splice(this.paginacao.links.length-1, 1);
                    }                     
                }

            }
        },
        mounted(){
            this.setPaginationArray()
        } 
        
    }
    
</script>

<style>

</style>


