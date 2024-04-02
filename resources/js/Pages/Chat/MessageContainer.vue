<template>
	<div class="h-full flex flex-col" style="justify-content: space-between">
		<div class="bg-gray-100 py-4 px-8 text-xl">
			{{ currentRoom.name ? currentRoom.name + ' - chat' : 'selecione uma conversa...' }}
		</div>

		<div class="w-full flex flex-col-reverse overflow-y-scroll px-2 pl-2" style="height: inherit;">
			<div v-for="( message, index ) in messages " :key=" index ">
				<message-item :message=" message "
					:class=" $page.props.auth.user.id == message.user.id ? 'ml-auto mb-2' : 'mr-auto mb-2' " />
			</div>
		</div>
	</div>
</template>

<script>
import MessageItem from './MessageItem.vue';

export default {
	components: { MessageItem },
	props: ['messages', 'currentRoom']
}
</script>