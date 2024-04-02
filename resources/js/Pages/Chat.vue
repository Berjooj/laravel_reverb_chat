<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import MessageContainer from '@/Pages/Chat/MessageContainer.vue';
import ChatRoomSelection from '@/Pages/Chat/ChatRoomSelection.vue';
import InputMessage from '@/Pages/Chat/InputMessage.vue';
import axios from 'axios';
</script>

<template>
    <AppLayout title="Chat">
        <template #header>
            <chat-room-selection :rooms=" chatRooms " :currentRoom=" currentRoom " v-on:roomchanged="setRoom($event)" />
        </template>
        <template #content>
            <div class="flex flex-col h-full h-screen">
                <message-container :currentRoom=" currentRoom " :messages=" messages " />
                <input-message :room=" currentRoom " v-on:messagesent="getMessages()"></input-message>
            </div>
        </template>
    </AppLayout>
</template>

<script>
export default {
    components: {
        AppLayout,
        MessageContainer,
        InputMessage,
        ChatRoomSelection
    },
    data: function ()
    {
        return {
            chatRooms: [],
            currentRoom: [],
            messages: []
        }
    },
    methods: {
        getRooms()
        {
            axios.get('/chat/rooms').then(response =>
            {
                this.chatRooms = response.data;
            }).catch(error =>
            {
                console.log(error)
            })
        },
        setRoom(room)
        {
            this.currentRoom = room;
            this.getMessages();

            Echo.channel('room.' + room.id)
                .listen('MessageReceivedEvent', (e) =>
                {
                    this.getMessages();
                })
        },
        getMessages()
        {
            if (!this.currentRoom) return;

            axios.get('/chat/room/' + this.currentRoom.id + '/messages').then(response =>
            {
                this.messages = response.data;
            }).then(error =>
            {
                console.log('error', error);
            })
        },
    },
    mounted()
    {
        let recaptchaScript = document.createElement('script')
        recaptchaScript.setAttribute('src', 'https://kit.fontawesome.com/4408c6a7a3.js')
        document.head.appendChild(recaptchaScript)
    },
    created()
    {
        this.getRooms();

        Echo.channel('new_user')
                .listen('UserCreatedEvent', (e) =>
                {
                    console.log('novo evento')
                    this.getRooms();
                })
    },
}
</script>