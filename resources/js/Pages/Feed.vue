<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                FEED
            </h2>
        </template>
        <PostCreate/>
        <div class="py-12">
            <div class="w-full mx-auto sm:px-6 lg:px-8 flex flex-wrap justify-center">
                
                    <div v-for="post in posts" v-bind:key="post.id" class="p-12">
                        <div class="relative ">  
                            <!--Card 1-->
                            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white" style="min-height: 380px;min-width: 380px;">
                                <img v-if="post.path" class="object-contain" style="min-width:100%" :src="post.path" :alt="post.title">
                                <img v-else class="object-contain min-h-150" style="min-width:100%" src="https://www.coraf.org/wp-content/themes/consultix/images/no-image-found-360x250.png" alt="default">
                                <div class="px-6 py-4">
                                    <div class="font-bold text-xl mb-2">{{post.title}}</div>
                                </div>
                                <p class="text-gray-700 text-base bottom-1 right-1">
                                    Posté par : {{post.user.name}} {{ post.created_at }}<br>
                                </p>
                                <div class="text-gray-700 text-base absolute bottom-0 right-0"> 
                                
                                    <span style="">{{post.likes_count}}</span>
                                    <inertia-link v-if="post.likes.length == 0" :href="`/like/${post.id}`" as="button" method="POST" preserve-scroll>
                                        <svg class="w-6 h-6"  fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                    </inertia-link>
                                    <inertia-link v-else :href="`/dislike/${post.id}`" as="button" method="POST" preserve-scroll>
                                        <svg class="w-6 h-6" fill="red" stroke="red" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                    </inertia-link> 
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import PostCreate from '@/Pages/Create'

    export default {
        components: {
            AppLayout,
            PostCreate
        },

        props:{
            posts: Array
        }
    }
</script>
