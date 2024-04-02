<template>
	<user-info class="mt-0" />
	<div class="flex flex-col mt-8">
		<user-chat-room v-for="( room, index ) in rooms " key="index" :currentRoom=" currentRoom " :room=" room "
			:index=" index " v-on:roomchanged="$emit('roomchanged', $event)" />
	</div>
</template>

<script>
import UserInfo from './UserInfo.vue';
import UserChatRoom from './UserChatRoom.vue';

export default {
	props: ['rooms', 'currentRoom'],
	components: { UserInfo, UserChatRoom },
	data()
	{
		return {
			selected: ''
		}
	},
	created()
	{
		this.selected = this.currentRoom;
	}
}
</script>