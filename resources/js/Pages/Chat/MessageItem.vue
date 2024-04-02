<template>
	<div
		:class=" $page.props.auth.user.id == message.user.id ? 'bg-green-100 text-gray-800 rounded-lg py-2 px-4 w-fit' : 'bg-gray-200 text-gray-800 rounded-lg py-2 px-4 w-fit' ">
		<p class="text-xs text-gray-400">{{ message.user.name }}</p>
		<div class="flex">
			<p class="mt-1">
				{{ message.message }}
			</p>
			<span class="text-xs text-gray-400 mt-3 ml-3">{{ format(message.created_at) }}</span>
		</div>
	</div>
</template>

<script>
import moment from 'moment';

export default {
	props: ['message'],
	methods: {
		format(date)
		{
			return moment(date.created_at).format('DD/MM/YYYY à\\s HH:mm')
		}
	}
}
</script>

<!-- <style>
.received-message {
	background-color: #F3F4F6;
	/* Cor de fundo da mensagem recebida */
	color: #111827;
	/* Cor do texto da mensagem */
	border-radius: 10px;
	/* Borda arredondada da mensagem */
	padding: 10px 15px;
	/* Espaçamento interno da mensagem */
	max-width: 70%;
	/* Largura máxima da mensagem */
}
</style> -->
