<template>
    <div class="py-5">
        <div class="max-w-2xl mx-auto p-6">
            <form class="mt-8 space-y-6" @submit.prevent="postStore" novalidate>
                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                    <label for="title" class="sr-only">Title</label>
                    <input v-model="title" id="title" name="title" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Title">
                    </div>
                    <br/>
                    <div>
                    <label for="path" class="sr-only">Image</label>
                    <input @change="getFile" type="file" id="path" name="path" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" >
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Envoyer
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import ButtonVue from '@/Jetstream/Button';

    export default {
        components: {
            ButtonVue
        },
        data(){
            return{
                title: '',
                path: ''
            }
        },
        methods:{
            postStore(){
                let data = new FormData();
                data.append('title', this.title);
                data.append('path', this.path);
                this.$inertia.post('/feed', data, {preserveState: false})
            },

            getFile(event){
                this.path = event.target.files[0];
            }
        }
    }
</script>
