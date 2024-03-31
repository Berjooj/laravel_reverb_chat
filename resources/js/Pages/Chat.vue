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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <chat-room-selection v-if=" currentRoom.id " :rooms=" chatRooms " :currentRoom=" currentRoom "
                    v-on:roomchanged="setRoom($event)" />
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <message-container :messages=" messages " />
                    <input-message :room=" currentRoom " v-on:messagesent="getMessages()"></input-message>
                </div>
            </div>
        </div>
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
                this.setRoom(response.data[0]);
            }).catch(error =>
            {
                console.log(error)
            })
        },
        setRoom(room)
        {
            this.currentRoom = room;
            this.getMessages();

            Echo.channel('room.' + this.currentRoom.id)
                .listen('MessageReceivedEvent', (e) => {
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
                console.log(error);
            })
        }
    },
    created()
    {
        this.getRooms();
    },
}
</script>