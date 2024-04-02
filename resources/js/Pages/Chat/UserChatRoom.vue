<template>
  <button :class=" currentRoom.id == room.id ? 'bg-gray-700 border-b border-gray-800 hover:bg-gray-600' : 'border-b border-gray-800 hover:bg-gray-600'" @click="click()">
    <div class="w-full ">
      <div class="flex items-center gap-x-4 w-full pt-4 pb-4 pl-4">
        <i
          class="text-lg fa-solid fa-user text-gray-100 border rounded-full p-2 bg-gray-500 border border-gray-500"></i>
        <div>
          <h3 class="text-base font-semibold leading-7 tracking-tight text-gray-100">{{ $page.props.auth.user.name == room.name ? '[Você] ' + room.name : room.name }}
          </h3>
        </div>
      </div>
    </div>
  </button>
</template>

<script>

export default {
  props: ['room', 'index', 'currentRoom'],
  data() {
    return {
      selected: false
    }
  },
  methods: {
    click() {
      this.$emit('roomchanged', this.room)
    }
  }
}
// More people...
</script>