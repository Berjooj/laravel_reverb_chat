<template>
	<div class="relative h-10 mb-4">
		<div class="flex">
			<input type="text" v-model=" message " @keyup.enter=" sendMessage " placeholder="digite algo..."
				class="outline-none border focus:outline-none w-full h-12">
			<button @click=" sendMessage "
				class="bg-gray-500 hover:bg-blue-700 pl-4 pr-4 text-white">enviar</button>
		</div>
	</div>
</template>

<script>
import axios from 'axios';

export default {
	props: ['room'],
	data: function ()
	{
		return {
			message: ''
		}
	},
	methods: {
		sendMessage()
		{
			if (this.message == '')
			{
				return
			}

			axios.post('/chat/room/' + this.room.id + '/message', {
				message: this.message
			}).then(response =>
			{
				if (response.status == 201)
				{
					this.message = '';
					this.$emit('messagesent');
				}
			}).catch(error =>
			{
				console.log(error);
			})
		}
	}
}
</script>